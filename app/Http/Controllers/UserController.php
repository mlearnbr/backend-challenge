<?php


namespace App\Http\Controllers;


use App\Http\Requests\User\CreateUserRequest;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    private $userService;
    private $userRepository;
    private $response;

    public function __construct(UserServiceInterface $service, UserRepositoryInterface $repository ,Response $response)
    {
        $this->userService = $service;
        $this->response = $response;
        $this->userRepository = $repository;
    }

    public function create(CreateUserRequest $request)
    {
        $user = $this->userService->createUser($request);
        return $this->response::json(['success' => true, 'data' => ['userId' => $user->getId()]]);
    }

    public function index()
    {
        $users = $this->userRepository->getAllUsers()->map(function (User $user) {
           return $user->toPublicArray();
        });
        return $this->response::json(['success' => true, 'data' => $users]);
    }

    public function upgradeUser(int $userId)
    {
        $user = $this->userRepository->findOrFailUser($userId);
        $this->userService->upgradeUser($user);
        return $this->response::json(['success' => true, 'data' => ['userId' => $user->getId()]]);
    }

    public function downgradeUser(int $userId)
    {
        $user = $this->userRepository->findOrFailUser($userId);
        $this->userService->downgradeUser($user);
        return $this->response::json(['success' => true, 'data' => ['userId' => $user->getId()]]);
    }
}
