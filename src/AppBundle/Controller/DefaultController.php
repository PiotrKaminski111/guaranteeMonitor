<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{

    
     /**
     * @Route("/")
     */
    public function indexAction(Request $request)
    {        
        $em      = $this->getDoctrine()->getManager();
        $devices = $em->getRepository('AppBundle:Device')->findAll();

       return $this->render('AppBundle:Default/device-management.html.twig', [
                'devices' => $devices
        ]);
            
    }
    
    
    /**
    * @Route("/add-device", name="add_device")
    */
    public function addDeviceAction(Request $request)
    {
        $deviceEntity = new \AppBundle\Entity\Device();
                
        $form = $this->createForm(
                '\AppBundle\Form\DeviceType', 
                $deviceEntity
        );
        
        $form->handleRequest($request);        

        if ($form->isSubmitted() && $form->isValid()) {     
            $entityManager = $this->getDoctrine()->getEntityManager();
            $filledEntity  = $form->getData();
            
            $entityManager->persist($filledEntity);
            $entityManager->flush();
            
            $deviceEntity = new \AppBundle\Entity\Device();
                
            $form = $this->createForm(
                    '\AppBundle\Form\MaterialType', 
                    $deviceEntity
            );
            
            return $this->render('AppBundle:Default/form.html.twig', [
                'form' => $form->createView(),
                'label' => 'Dodaj Urządzenie',
                'wrapperClass' => 'add-device'
            ]);
        }

        return $this->render('AppBundle:Default/form.html.twig', [
            'form' => $form->createView(),
            'label' => 'Dodaj Urządzenie',
            'wrapperClass' => 'add-device'
        ]);
        
    }
    
    
    /**
     * @Route("/edit-device/{id}", name="edit_device")
     * @ParamConverter("device", class="AppBundle:Device")
     * @Template()
     */
    public function editDeviceAction(\AppBundle\Entity\Device $device, Request $request)
    {
        $form = $this->createForm(
                '\AppBundle\Form\DeviceType', 
                $device
        );
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getEntityManager();       
            $entityManager->flush();
        }   
        
        return $this->render('AppBundle:Default/form.html.twig', [
            'form' => $form->createView(),
            'label' => 'Edycja Urządzenia',
            'wrapperClass' => 'device'
        ]);
        
    }
    
   
}
