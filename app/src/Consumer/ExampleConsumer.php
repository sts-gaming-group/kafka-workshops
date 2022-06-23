<?php

namespace App\Consumer;

use StsGamingGroup\KafkaBundle\Client\Consumer\Message;
use StsGamingGroup\KafkaBundle\Client\Contract\ConsumerInterface;
use StsGamingGroup\KafkaBundle\RdKafka\Context;

class ExampleConsumer implements ConsumerInterface
{
    public const CONSUMER_NAME = 'example_consumer';

    public function consume(Message $message, Context $context)
    {
        $data = $message->getData();
        dump($data);
    }

    public function handleException(\Exception $exception, Context $context)
    {
        // TODO: Implement handleException() method.
    }

    public function getName(): string
    {
        return self::CONSUMER_NAME;
    }

}