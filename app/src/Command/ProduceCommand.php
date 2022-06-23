<?php

namespace App\Command;

use App\Dto\RegistrationEvent;
use App\Dto\RegistrationEventData;
use Faker\Factory;
use StsGamingGroup\KafkaBundle\Client\Producer\ProducerClient;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:produce')]
class ProduceCommand extends Command
{

    public function __construct(private ProducerClient $client)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $faker = Factory::create();
        $this->client->produce(
            new RegistrationEvent(
                new RegistrationEventData(rand(1, 100000000), $faker->name(), new \DateTime(), rand(10, 30))
            )
        );
        $this->client->flush();

        return Command::SUCCESS;
    }

}