<?php
// src/AppBundle/Api/SlackMessengerApi.php

namespace AppBundle\Api;


class SlackMessengerApi
{
    const CONFIRM_MESSAGE = 'ok';
    
    protected $endpoint;
    

    public function __construct($endpoint)
    {
        $this->endpoint = $endpoint;
    }
    
    
    private function _getEndpoint()
    {
        return $this->endpoint;
    }
    
     
    public function sendMessage($message)
    {
        $data = 'payload=' . json_encode(array(         
                  'channel'    => '#general',
                  'text'       => $message,
                  'icon_emoji' => ':smile:'
              ));

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->_getEndpoint());
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        return curl_exec($ch);
        
    }
     
}

