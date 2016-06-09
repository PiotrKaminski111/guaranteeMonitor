<?php
// src/AppBundle/Utils/SlackMessageGenerator.php

namespace AppBundle\Utils;

class SlackMessageGenerator 
{
    const SLACK_WEBHOOK_ENDPOINT = 'https://hooks.slack.com/services/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';
 
    const CONFIRM_MESSAGE = 'ok';
     
    public static function sendMessage($message)
    {
        $data = 'payload=' . json_encode(array(         
                  'channel'    => '#general',
                  'text'       => $message,
                  'icon_emoji' => ':smile:'
              ));

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, self::SLACK_WEBHOOK_ENDPOINT);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        return curl_exec($ch);
        
    }
     
}

