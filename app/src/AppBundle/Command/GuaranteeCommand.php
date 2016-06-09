<?php
// src/AppBundle/Command/Guarantee.php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GuaranteeCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('guarantee:check')
            ->setDescription('Check guarantee')
           
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
//        $name = $input->getArgument('name');
//        if ($name) {
//            $text = 'Hello '.$name;
//        } else {
//            $text = 'Hello';
//        }
//
//        if ($input->getOption('yell')) {
//            $text = strtoupper($text);
//        }

        $output->writeln('sss');
    }
}