<?php

namespace App\Http\Controllers;

use Config;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{

    private $apiRequest;
    private $mLearn;

    public function __construct()
    {
        $this->mLearn = config('mlearn');

        $this->apiRequest = Http::withOptions([
            'verify' => false,
        ])->withHeaders([
            'Authorization' => $this->mLearn['token'],
            'service-id' => $this->mLearn['service_id'],
            'app-users-group-id' => $this->mLearn['group_id']
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $user = User::create($data);

        $user = User::orderby('created_at', 'desc')->first();

        $response = $this->apiRequest->post(
            'https://api2.mlearn.mobi/integrator/' . $this->mLearn['service_id'] . '/users',
            [
                'msisdn' => $user->msisdn,
                'name' => $user->name,
                'access_level' => $user->access_level,
                'password' => $user->password,
                'external_id' => $user->id
            ]
        );

        if ($response->successful()) {
            flash('Usuário criado com sucesso!')->success();
            return redirect()->route('users.index');
        }
        flash('Erro ao criar usuário, contate administrador')->error();
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $userApi = $this->apiRequest->get(
            'https://api2.mlearn.mobi/integrator/' . $this->mLearn['service_id'] . '/users?external_id=' . $user->id
        );

        $userApi = json_decode($userApi->getBody());

        $response = $this->apiRequest->put(
            'https://api2.mlearn.mobi/integrator/' . $this->mLearn['service_id'] . '/users/' . $userApi->data->id,
            [
                'msisdn'       => $request->input('msisdn'),
                'name'         => $request->input('name'),
                'access_level' => $request->input('access_level'),
                'password'     => $request->input('password'),
                'external_id'  => $user->id
            ]
        );

        if ($response->successful()) {

            $user->msisdn = $request->input('msisdn');
            $user->name = $request->input('name');
            $user->access_level = $request->input('access_level');
            $user->password = $request->input('password');
            $user->save();
            flash('Usuário atualizado com sucesso!')->success();
            return redirect()->route('users.index');
        }
        flash('Erro ao atualizar usuário, contate administrador')->error();
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $userApi = $this->apiRequest->get(
            'https://api2.mlearn.mobi/integrator/' . $this->mLearn['service_id'] . '/users?external_id=' . $user->id
        );

        $userApi = json_decode($userApi);

        $response = $this->apiRequest->delete(
            'https://api2.mlearn.mobi/integrator/' . $this->mLearn['service_id'] . '/users/' . $userApi->data->id
        );
        if ($response->successful()) {
            $user->delete();
            flash('Usuário excluido com sucesso!')->success();
            return redirect()->route('users.index');
        }
        flash('Problema ao excluir usuário, contate administrador')->error();
        return redirect()->route('users.index');
    }

    public function toggleUserPlan(Request $request)
    {
        $id = $request->input('id');
        $user = User::find($id);
        $userApi = $this->apiRequest->get(
            'https://api2.mlearn.mobi/integrator/' . $this->mLearn['service_id'] . '/users?external_id=' . $user->id
        );

        $userApi = json_decode($userApi->getBody());
        if ($userApi->data->access_level === 'free') {
            $response = $this->apiRequest->put(
                'https://api2.mlearn.mobi/integrator/' . $this->mLearn['service_id'] . '/users/' . $userApi->data->id . '/upgrade'
            );
            $user->access_level = 'premium';
            $user->save();
            flash('Upgrade realizado com sucesso!')->success();
            return redirect()->route('users.index');
        }

        $response = $this->apiRequest->put(
            'https://api2.mlearn.mobi/integrator/' . $this->mLearn['service_id'] . '/users/' . $userApi->data->id . '/downgrade'
        );
        $user->access_level = 'free';

        $user->save();
        flash('Downgrade realizado com sucesso!')->success();
        return redirect()->route('users.index');
    }
}
