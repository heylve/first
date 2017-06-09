<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


namespace AppBundle\Utils;

use AppBundle\Entity\Lucky\CalendarDay;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class CalendarBdActions extends Controller  {
//extends Controller{
    
    public function upsert_to_db($data)
    {
        $var=$data;
        foreach ($data as $key => $value){
            $day= $key;
            $mood = $value;
            $this->create_day($day,$mood);
            
            
            
    
    }

    }//end upsert
    
    public function create_day($date2,$mood)
    {
        $cal_day = new CalendarDay();
        $cal_day->setUser(1);
        $date =  new \DateTime("now");
        $cal_day->setDay($date);
        $cal_day->setMood(1);
      
        $em = $this->getDoctrine()->getManager();
        $em->persist($day);
        $em->flush();
    }
    
    
}//end class