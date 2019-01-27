<?php
/**
 * Created by PhpStorm.
 * User: aminejerbouh
 * Date: 15/01/2019
 * Time: 16:06
 */

namespace App\Manager\User;


use App\Entity\User;
use App\Repository\UserRepository;

final class UserManager
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUserById($id): ?User
    {
        return $this->userRepository->find($id);
    }

    public function getAllUsers(): ?array
    {
        return $this->userRepository->findAll();
    }

}