<?php
namespace App\Services\user;

use App\Repositories\Contracts\IUserRepository;
use App\Services\Contracts\IUserService;
use Illuminate\Support\Facades\Hash;

class UserService implements IUserService
{

    protected $userRepository;

    public function __construct
    (
        IUserRepository $userRepository
    ) {
       $this->userRepository = $userRepository;
    }

    public function list()
    {
        $data = $this->userRepository->list();
        return $data;
    }


    public function add(string $name, string $msisdn, ?string $password, string $access_level,string $external_id)
    {
        $password =   Hash::make($password);
        $data = $this->userRepository->add($name, $msisdn, $password, $access_level, $external_id);
        return $data;
    }


    public function listBy(int $id)
    {
        $data = $this->userRepository->listBy($id);
        return $data;
    }

    public function edit(int $id, string $name, string $msisdn, ?string $password, string $access_level,string $external_id)
    {
        $password =   Hash::make($password);
        $data = $this->userRepository->edit($id,$name, $msisdn, $password, $access_level, $external_id);
        return $data;
    }

    public function delete(int $id)
    {
        $data = $this->userRepository->delete($id);
        return $data;
    }

}
