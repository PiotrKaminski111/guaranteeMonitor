<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DeviceControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertContains('Device management', $crawler->filter('h1')->text());
    }
    
    
    public function testAddDevice()
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', '/add-device');
        $form    = $crawler->selectButton('Save')->form();
        
        $form['device[serialNumber]']        = '12345abcde';
        $form['device[name]']                = 'testName';
        $form['device[guaranteeEnd][month]'] = '12';
        $form['device[guaranteeEnd][day]']   = '12';
        $form['device[guaranteeEnd][year]']  = '2016';
        
        $extract = $crawler->filter('input[name="device[_token]"]')->extract(array('value'));
        
        $form['device[_token]'] = $extract[0];

        $crawler = $client->submit($form);
        
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }
    
    
    public function testEditDevice()
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', '/edit-device/1');
        $form    = $crawler->selectButton('Save')->form();
        
         $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
