<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

    
    /**
    * @Route("/", name="homepage")
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
            $entityManager = $this->getDoctrine()->getManager();
            $filledEntity  = $form->getData();
            $filledEntity->setSended(false);
            $entityManager->persist($filledEntity);
            $entityManager->flush();
                
            return new Response('New device added!');
            
        }

        return $this->render('AppBundle:Default/form.html.twig', [
            'form' => $form->createView(),
            'label' => 'Add device',
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
            'label' => 'Edit device',
            'wrapperClass' => 'device'
        ]);
        
    }
    
   
}
