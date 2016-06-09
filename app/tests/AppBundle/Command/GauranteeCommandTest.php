<?php

namespace Tests\AppBundle\Command;

use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use AppBundle\Command\GuaranteeCommand;

class GauranteeCommandTest extends KernelTestCase
{
    
    
    public function testExecute()
    {
        $kernel = $this->createKernel();
        $kernel->boot();

        $application = new Application($kernel);
        $application->add(new GuaranteeCommand());

        $command = $application->find('guarantee:check');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array());

        $this->assertRegExp('/All devices checked/', $commandTester->getDisplay());
    }
    
    
}

