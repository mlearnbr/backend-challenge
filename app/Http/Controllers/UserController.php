<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Repositories\MLearnRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Throwable;

class UserController extends Controller
{
    private $mlearnRepository;

    public function __construct(MLearnRepositoryInterface $mLearnRepository)
    {
        $this->mlearnRepository = $mLearnRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index', [
            'users' => User::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create', [
            'access_levels' => config('enums.access_levels'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validated();
            $user = User::create($validatedData);

            $user->save();

            $this->mlearnRepository->createUser($user);

            DB::commit();

            return redirect()->route('users.index')->with('success', "Usuário criado com sucesso!");
        } catch (Throwable $e) {
            DB::rollBack();

            $response = redirect()->back()
                ->withInput()
                ->with('error', "Falha ao criar usuário. Corrija os dados e tente novamente.");

            if ($e instanceof ValidationException) {
                $response->withErrors($e->errors());
            }

            return $response;
        }
    }

    /**
     * Upgrade user.
     */
    public function upgrade(Request $request, User $user)
    {
        $this->mlearnRepository->upgradeUser($user);
        return redirect()->route('users.index')->with('success', 'Nível de acesso alterado para ' . config('enums.access_levels')[$user->access_level]);
    }

    /**
     * Downgrade user.
     */
    public function downgrade(Request $request, User $user)
    {
        $this->mlearnRepository->downgradeUser($user);
        return redirect()->route('users.index')->with('success', 'Nível de acesso alterado para ' . config('enums.access_levels')[$user->access_level]);
    }
}
