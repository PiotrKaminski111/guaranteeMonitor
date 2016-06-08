<?php
// src/AppBundle/Entity/Device.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="device")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity("serialNumber")
 */
class Device
{
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /** @ORM\Column(type="string") */
    protected $serialNumber;
    
    /** @ORM\Column(type="string") */
    protected $name;

    /** @ORM\Column(type="datetime") */
    protected $guaranteeEnd;
    
    
    public function __construct()
    {
        
    }

    
}
