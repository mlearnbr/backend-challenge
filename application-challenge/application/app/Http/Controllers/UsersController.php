<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\mLearn\MLearn;
use App\Repositories\UserRepository;
use App\Http\Requests\UserStoreRequest;

class UsersController extends Controller
{
    private $userRepository;
    
    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->search();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserStoreRequest $request)
    {
        $users = $this->userRepository->create($request->all());
        $mLearn = new MLearn();
        $status = $mLearn->create($users);

        if($status->successful()){
            return redirect()->route('users.index');
        }
    }

    public function upgrade(Request $request, $id)
    {
        $user = $this->userRepository->update(['access_level' => 'premium'], $id);
        $mLearn = new MLearn();
        $status = $mLearn->search($user->id)->upgrade();

        if($status->successful()){
            return redirect()->route('users.index');
        }
    }

    public function downgrade(Request $request, $id)
    {
        $user = $this->userRepository->update(['access_level' => 'free'], $id);
        $mLearn = new MLearn();
        $status = $mLearn->search($user->id)->downgrade();

        if($status->successful()){
            return redirect()->route('users.index');
        }
    }

    
}
