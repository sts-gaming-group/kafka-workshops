<?php

namespace App\Command;

use App\Producer\ExampleDto;
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
        $this->client->produce(new ExampleDto(1));
        $this->client->flush();

        return Command::SUCCESS;
    }

}