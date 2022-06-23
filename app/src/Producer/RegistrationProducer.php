<?php

namespace App\Producer;

use App\Dto\RegistrationEvent;
use StsGamingGroup\KafkaBundle\Client\Contract\PartitionAwareProducerInterface;
use StsGamingGroup\KafkaBundle\Client\Producer\Message;
use StsGamingGroup\KafkaBundle\Configuration\ResolvedConfiguration;

class RegistrationProducer implements PartitionAwareProducerInterface
{
    /**
     * @param RegistrationEvent $data
     * @return Message
     */
    public function produce($data): Message
    {
        return new Message(json_encode($data->toArray()));
    }

    public function getPartition($data, ResolvedConfiguration $configuration): int
    {
        return $data['data']['id'] % 4;
    }

    public function supports($data): bool
    {
        return $data instanceof RegistrationEvent;
    }
}