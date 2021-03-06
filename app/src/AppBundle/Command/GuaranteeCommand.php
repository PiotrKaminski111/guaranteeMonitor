<?php
// src/AppBundle/Command/Guarantee.php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Api\SlackMessengerApi;

class GuaranteeCommand extends ContainerAwareCommand
{
    
    const DATE_INTERVAL = 'P2D';
    
    
    protected function configure()
    {
        $this
            ->setName('guarantee:check')
            ->setDescription('Check guarantee')
        ;
    }

    
    protected function execute(InputInterface $input, OutputInterface $output)
    {   
        $em      = $this->getContainer()->get('doctrine')->getManager();
        $devices = $em->getRepository('AppBundle:Device')->findBy(array('sent' => false));
        $nowDate = new \DateTime('now');
        $intervalCheck         = new \DateInterval(self::DATE_INTERVAL);
        $slackMessageGenerator = $this->getContainer()->get('slack.messenger.api');
        
        foreach ($devices as $device) {
            $intervalBetweenDates = $nowDate->diff($device->getGuaranteeEnd());
            
            if ((int)$intervalBetweenDates->format('%r%a') === (int) $intervalCheck->format('%d')) {
                $result = $slackMessageGenerator->sendMessage(
                    'Device with serial ' . $device->getSerialNumber() . 'ends guarantee at ' . $device->getGuaranteeEnd()->format('Y-m-d')
                );

                if ($result !== SlackMessengerApi::CONFIRM_MESSAGE) {
                    $output->writeln($result);
                    return;

                } else {
                    $device->setSent(true);
                }
            }
        }
        
        $em->flush();
        $output->writeln('All devices checked');
       
    }
}