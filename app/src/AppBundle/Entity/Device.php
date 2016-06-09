<?php
// src/AppBundle/Entity/Device.php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

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
    
    /** 
     * @ORM\Column(type="string")
     * @Assert\Regex(
     *     pattern="/^[A-Za-z0-9]{10}$/",
     *     message="Serial number must contain exact 10 alphanumeric chars"
     * )
     */    
    protected $serialNumber;
    
    /** @ORM\Column(type="string") */
    protected $name;

    /** @ORM\Column(type="datetime") */
    protected $guaranteeEnd;
    
    /**@ORM\Column(type="boolean") */
    protected $sended;
    
    public function __construct()
    {
        
    }

    

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set serialNumber
     *
     * @param string $serialNumber
     *
     * @return Device
     */
    public function setSerialNumber($serialNumber)
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }

    /**
     * Get serialNumber
     *
     * @return string
     */
    public function getSerialNumber()
    {
        return $this->serialNumber;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Device
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set guaranteeEnd
     *
     * @param \DateTime $guaranteeEnd
     *
     * @return Device
     */
    public function setGuaranteeEnd($guaranteeEnd)
    {
        $this->guaranteeEnd = $guaranteeEnd;

        return $this;
    }

    /**
     * Get guaranteeEnd
     *
     * @return \DateTime
     */
    public function getGuaranteeEnd()
    {
        return $this->guaranteeEnd;
    }
}
