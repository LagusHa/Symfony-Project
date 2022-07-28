<?php

namespace App\Users\Application\Query\FindUserByEmail;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Users\Application\DTO\UserDTO;
use App\Users\Domain\Repository\UserRepositoryInterface;

class FindUserByEmailQueryHandler implements QueryHandlerInterface
{
    public function __construct(private readonly UserRepositoryInterface $userRepository)
    {
    }

    /**
     * @param FindUserByEmailQuery $query
     * @return UserDTO|null
     */
    public function __invoke(FindUserByEmailQuery $query): UserDto|null
    {
        $user = $this->userRepository->findByEmail($query->email);

        if (!$user) {
//            return null;
            throw new \Exception('User not found');
        }

        return UserDTO::fromEntity($user);
    }
}