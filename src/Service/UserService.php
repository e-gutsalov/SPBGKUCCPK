<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;

class UserService
{
    /**
     * @param UserRepository $userRepository
     */
    public function __construct(
        private readonly UserRepository $userRepository
    )
    {
    }

    /**
     * @param array $data
     * @return true[]
     */
    public function addUser(array $data): array
    {
        $user = (new User())
            ->setName($data['name'])
            ->setSurname($data['surname'])
            ->setPosition($data['position']);

        $this->userRepository->add($user);

        return ['addUser' => true];
    }
}