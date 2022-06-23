<?php

namespace App\Consumer;

use App\Dto\RegistrationEvent;
use StsGamingGroup\KafkaBundle\Client\Consumer\Exception\RecoverableMessageException;
use StsGamingGroup\KafkaBundle\Client\Consumer\Message;
use StsGamingGroup\KafkaBundle\Client\Contract\ConsumerInterface;
use StsGamingGroup\KafkaBundle\RdKafka\Context;
use StsGamingGroup\KafkaBundle\Validator\Exception\ValidationException;
use Symfony\Component\HttpClient\Exception\ServerException;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class RegistrationConsumer implements ConsumerInterface
{
    public const CONSUMER_NAME = 'registration_consumer';

    public function __construct(private readonly HttpClientInterface $httpClient)
    {
    }

    /**
     * @return mixed|void
     */
    public function consume(Message $message, Context $context)
    {
        /**
         * @var RegistrationEvent
         */
        $data = $message->getData();
        try {
            $this->httpClient->request('POST', 'https://sznapka.pl/api.php?mode=random_failures', [
                'json' => $data
            ]);
        } catch (ServerException) {
            throw new RecoverableMessageException();
        }
    }

    /**
     * @return mixed|void
     */
    public function handleException(\Exception $exception, Context $context)
    {
        if ($exception instanceof ValidationException) {
            dump($exception->getFailedReason());
        }
    }

    public function getName(): string
    {
        return self::CONSUMER_NAME;
    }
}