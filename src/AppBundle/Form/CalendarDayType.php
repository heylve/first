<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
class CalendarDayType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $builder
//            ->add('task')
//            ->add('dueDate', null, array('widget' => 'single_text'))
//            ->add('save', SubmitType::class)
//        ;
        
        $builder 
            ->add('user', IntegerType::class)
            ->add('day', DateType::class)
            ->add('mood', IntegerType::class)    
            ->add('save', SubmitType::class, array('label' => 'Create Day'))
            ->getForm();
        
    }
}

