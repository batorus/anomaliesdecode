<?php

namespace AnomaliesBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class CreateUserCommand extends ContainerAwareCommand
{
//    protected function configure()
//    {
//        $this
//         // the name of the command (the part after "app/console")
//        ->setName('app:create-user')
//
//        // the short description shown while running "php app/console list"
//        ->setDescription('Creates a new user.')
//        // the full command description shown when running the command with
//        // the "--help" option
//        ->setHelp('This command allows you to create a user...');
//        $this->addArgument('username', InputArgument::REQUIRED, 'The username of the user.');
//    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
         // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output->writeln([
            'User Creator',
            '============',
            '',
        ]);
        
        $userManager = $this->getContainer()->get('logger');
     //   $userManager->create($input->getArgument('username'));
        $output->writeln('User successfully generated!');
    }
}
