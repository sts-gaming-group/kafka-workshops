<?php

namespace App\Dto;

class RegistrationEvent
{
    private const EVENT_NAME = 'registration';

    private readonly string $event;

    public function __construct(
        private readonly RegistrationEventData $data
    ) {
        $this->event = self::EVENT_NAME;
    }

    public function getEvent(): string
    {
        return $this->event;
    }

    public function getData(): RegistrationEventData
    {
        return $this->data;
    }

    public function toArray()
    {
        return [
            'event' => $this->event,
            'data' => [
                'id' => $this->data->getId(),
                'username' => $this->data->getUsername(),
                'registered_at' => $this->data->getRegisteredAt()->format('Y-m-d H:i:s'),
                'age' => $this->data->getAge(),
            ]
        ];
    }
}