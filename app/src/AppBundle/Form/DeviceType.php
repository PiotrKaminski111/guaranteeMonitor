<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DeviceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('serialNumber', null, array(
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add('name', null, array(
                    'attr' => array('class' => 'form-control'),
                )
            )
            ->add('guaranteeEnd', DateTimeType::class, array(
                    'placeholder' => 'Select a value',
                    //'attr' => array('class' => 'form-control'),
                )
            )
            ->add('save', SubmitType::class, array('label' => 'Save'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Device'
        ));
    }
}
