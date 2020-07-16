<?php


namespace App\Services;


use App\Interfaces\User\CreateUserInterface;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\MLearnIntegrationServiceInterface;
use App\Services\Interfaces\UserServiceInterface;

class UserService implements UserServiceInterface
{
    private $repository;
    private $integrationService;

    public function __construct(UserRepositoryInterface $repository, MLearnIntegrationServiceInterface $integrationService)
    {
        $this->repository = $repository;
        $this->integrationService = $integrationService;
    }

    public function createUser(CreateUserInterface $createUser): User
    {
        $user = new User();
        $user->create($createUser);
        $this->repository->saveUser($user);
        $externalUserId = $this->integrationService->createUser($user, $createUser->getOriginalPassword());
        $user->addExternalId($externalUserId);
        $this->repository->saveUser($user);
        return $user;
    }

    public function upgradeUser(User $user): void
    {
        $user->upgradeAccess();
        $this->integrationService->upgradeUserAccess($user);
        $this->repository->saveUser($user);
    }

    public function downgradeUser(User $user): void
    {
        $user->downgradeAccess();
        $this->integrationService->downgradeUserAccess($user);
        $this->repository->saveUser($user);
    }
}
