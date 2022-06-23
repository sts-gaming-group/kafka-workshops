<?php

namespace App\Producer;

use StsGamingGroup\KafkaBundle\Client\Contract\ProducerInterface;
use StsGamingGroup\KafkaBundle\Client\Producer\Message;

class ExampleProducer implements ProducerInterface
{
    public function produce($data): Message
    {
        return new Message(json_encode($data));
    }

    public function supports($data): bool
    {
       return $data instanceof ExampleDto;
    }

}