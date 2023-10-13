<?php
namespace App\command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendMailCommand extends Command {
    protected static $defaultName = 'app:create-user';

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'User Creator',
            '============',
            '',
        ]);

        $output->writeln('Hello '.$input->getArgument('username'));
        return Command::SUCCESS;
    }

    public function configure()
    {
        $this->addArgument('username',InputArgument::REQUIRED,"Votre nom");

    }

}