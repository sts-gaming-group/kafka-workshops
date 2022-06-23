<?php

namespace App\Dto;

class RegistrationEventData
{
    public function __construct(
        private readonly int $id,
        private readonly string $username,
        private readonly \DateTime $registeredAt,
        private readonly int $age
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getRegisteredAt(): \DateTime
    {
        return $this->registeredAt;
    }

    public function getAge(): int
    {
        return $this->age;
    }
}