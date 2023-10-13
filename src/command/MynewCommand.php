<?php
namespace App\command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MynewCommand extends Command {
    protected static $defaultName = "create_user";
    public function  configure()
    {
        $this->setDescription('add new User');
        $this->addArgument('email',InputArgument::REQUIRED,'Votre address mail');
        $this->addArgument('password',InputArgument::REQUIRED,'Votre mot de passe');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Création Utilisateur',
            '###############--',
            '-------------'
        ]);
        
        return 0;
    }
}

