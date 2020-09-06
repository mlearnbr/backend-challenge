<?php

namespace App\Http\Controllers;

use App\Events\AccessLevelUpdated;
use App\Events\UserCreated;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('users.list', [
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $access_levels = [
            'free',
            'premium'
        ];
        return response()->view('users.new', [
            'access_levels' => $access_levels
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'msisdn' => 'required|unique:users|regex:/\+55[0-9]{11}/',
                'name' => 'required',
                'access_level' => 'required',
                'password' => 'required|confirmed'
            ]);

            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);

            event(new UserCreated($user));

            $request->session()->flash('success', "O usuário {$user->name} foi cadastrado com sucesso!");
        } catch (\Exception $e) {
            $request->session()->flash('error', 'Houve um problema em sua solicitação. ' . $e->getMessage());
        } finally {
            return redirect()->route('users.index');
        }
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleAccessLevel(Request $request, User $user)
    {
        $upgrade = false;
        if ($user->access_level === 'free') {
            $user->upgrade();
            $upgrade = true;
        } else {
            $user->downgrade();
        }
        event(new AccessLevelUpdated($user, $upgrade));
        $request->session()->flash('success', "O nível de acesso do usuário {$user->name} foi alterado com sucesso");
        return redirect()->route('users.index');
    }

}
