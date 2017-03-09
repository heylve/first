<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// src/AppBundle/Form/TaskType.php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Generator\UrlGenerator;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->setAction($this->generateUrl('lucky',array(),true)
//            ->setAction($this->get('router')->generate('lucky')   
//            ->setMethod('POST')
            ->add('task')
            ->add('dueDate', null, array('widget' => 'single_text'))
            ->add('save', SubmitType::class);
        
    
    }
}
