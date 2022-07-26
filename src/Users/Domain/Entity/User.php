<?php

namespace App\Users\Domain\Entity;

use App\Shared\Domain\Service\UlidService;

class User
{
    private string $ulid;
    private string $email;
    private string $password;

    /**
     * @param string $email
     * @param string $password
     */
    public function __construct(string $email, string $password)
    {
        $this->ulid = UlidService::generate();
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getUlid(): string
    {
        return $this->ulid;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
