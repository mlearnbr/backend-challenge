<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application users.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('users.home', ['users' => $users]);
    }

    /**
     * Upgrade user access level
     *
     * @return void
     */
    public function upgrade($id)
    {
        $user = User::find($id);
        $user->update(['access_level' => 'premium']);
        return $user->getChanges() ? redirect()->back()->with('status', 'Upgrade realizado com sucesso!') : redirect()->back();
    }

    /**
     * Downgrade user access level
     *
     * @return void
     */
    public function downgrade($id)
    {
        $user = User::find($id);
        $user->update(['access_level' => 'free']);
        return $user->getChanges() ? redirect()->back()->with('status', 'Downgrade realizado com sucesso!') : redirect()->back();
    }

    /**
     * Delete user
     *
     * @return void 
     */
    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('status', 'Usuário removido com sucesso!');
    }
}
