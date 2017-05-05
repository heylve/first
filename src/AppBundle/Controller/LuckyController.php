<?php
// src/AppBundle/Controller/LuckyController.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Lucky\CalendarDay;
use AppBundle\Form\CalendarDayType;


class LuckyController extends Controller

{
    /**
     * @Route("/lucky/index", name="index")
     */
    public function indexAction(Request $request)
{
    $session = $request->getSession();

    // store an attribute for reuse during a later user request
    $session->set('foo', 'bar');
    $session->set('name','lucie');
    // get the attribute set by another controller in another request
    $foobar = $session->get('foo');
    $name   = $session->get('name');
    // use a default value if the attribute doesn't exist
    $filters = $session->get('filters', array());
     $this->addFlash(
            'notice',
            'Your changes were saved!'
        );
//     $response->headers->set('Content-Type', 'text/css');
//      return new Response(
//            '<html><body>name/foo in session object: '.  $name ." ".$foobar.'</body></html>'
//        );
//         // returns '{"username":"jane.doe"}' and sets the proper Content-Type header
//        return $this->json(array('username' => 'jane.doe'));
//      return $this->redirect("http://www.google.fr");
        $number =10;
        return $this->render('lucky/number.html.twig', array(
            'number' => $number,
        )); 
    
}
/**
     * @Route("/lucky/request", name="request")
     */
public function requestAction(Request $request, $firstName="lucie", $lastName="toto")
{
    $page = $request->query->get('page', 1);
    return new Response(
            '<html><body>page number: '.$page.'</body></html>'
        );

}
/**
     * @Route("/lucky/calendar/{month}/{year}", name="calendar",
     *  defaults={"year": null,"month":null,"day":1})
     */
public function calendarAction(Request $request,$month, $year,$day)
{
   
  if ($month == null  or $year == null)
  {
   $now = new \DateTime('now');
   $month = $now->format('m');
   $year = $now->format('Y');
   $day = 1;    
  }
  else{
  
    if ($month > 12) 
    {
        $month=1;
        $year=$year+1;
    }
    if ($month ==0)
    {
        $month=12;
        $year=$year-1;
    }
  }
   
$d1=strtotime("{$month} {$year}");
//   $c=date('d/m/Y',$c);
$date="{$year}-{$month}-1";
$timestamp = strtotime($date);
$first_day = date('D', $timestamp);
$first_day_2 = date('w', $timestamp);
$first_day_3 = date('l', $timestamp);

$date_params= ['date_asked' => $date, 'first_day' => $first_day ];


//return new Response(
//            '<html><body>'.var_dump($date).'Nom court: '.var_dump($first_day).var_dump($first_day_2).var_dump($first_day_3).'</body></html>'
//);
//var_dump($day);


 $form =  $this->createFormBuilder()
         ->add('save', SubmitType::class, array('label' => 'Save changes '))
         ->getForm();
 
 $form->handleRequest($request);
 if ($form->isSubmitted() && $form->isValid()) {
      return $this->redirectToRoute('index');
 }

$nb_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
     return $this->render('AppBundle:lucky:calendar.html.twig', array(
            'form' => $form->createView(),
            'month' => $month,'year' => $year,'nb_days' => $nb_days,'date_asked' => $date_params));
    

     //   $d=strtotime("10:30pm April 15 2014");
//   $c = strtotime('now + 3 months');
//   $year = date('Y', strtotime($year));
//$mon = date('m', strtotime($month));
//$day = date('d', strtotime("1"));
     
     
}


/**
     * @Route("/lucky/save_cal/", name="save_calendar")
     *  
     */
public function save_calendarAction()
{
     $cal = new CalendarDay();
    $cal->setUser(1);
//    $date = Date('Y-m-d');
//    $date = date('Y-m-d', strtotime($date));
    $date =  new \DateTime("now");
    $cal->setDay($date );
    $cal->setMood(1);
    $datetime = date_create('2017-04-25')->format('Y-m-d H:i:s');
    $datetime = date_create('2017-04-28')->format('Y-m-d' );
    $em = $this->getDoctrine()->getManager();

    // tells Doctrine you want to (eventually) save the Product (no queries yet)
    $em->persist($cal);

    // actually executes the queries (i.e. the INSERT query)
    $em->flush();
      return new Response('Saved new cal with id '.$datetime);
//    return new Response('Saved new cal with id '.$cal->getId());
    
}
   /**
     * @Route("/lucky/createday/", name="createday")
     *  
     */ 
   public function createdayAction(Request $request)
    {
        // create a task and give it some dummy data for this example
        $cal = new CalendarDay();
        $cal->setUser(1);;
        $date =  new \DateTime("now");
        $cal->setDay($date );
        $cal->setMood(1);

//        $form = $this->createFormBuilder($cal)
//            ->add('user', IntegerType::class)
//            ->add('day', DateType::class)
//            ->add('mood', IntegerType::class)    
//            ->add('save', SubmitType::class, array('label' => 'Create Day'))
//            ->getForm();
        $form = $this->createForm(CalendarDayType::class, $cal);

        
        $form->handleRequest($request);
//        if ($form->isSubmitted() && !($form->isValid()) ) {
//            return new Response('Data non valid in the form ');
//        }
         
        if ($form->isSubmitted() && $form->isValid()) {
             // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        $cal = $form->getData();

        // ... perform some action, such as saving the task to the database
        // for example, if Task is a Doctrine entity, save it!
         $em = $this->getDoctrine()->getManager();
         $em->persist($cal);
         $em->flush();

        return $this->redirectToRoute('calendar');
        }
        
        return $this->render('AppBundle:lucky:createday.html.twig', array('form' => $form->createView()));
    
//        return $this->render('lukcy/createday.html.twig', array(
//            'form' => $form->createView(),
//        ));
    }  
    /**
     * @Route("/lucky/number/{max}", name="lucky")
     */
    public function numberAction($max=100)
    {
        
        $number = mt_rand(0, $max);
//        return new Response(
//            '<html><body>Lucky number: '.$number.'</body></html>'
//        );
        $date = time();
        return $this->render('AppBundle:lucky:number.html.twig', array(
            'number' => $number,));
//        return $this->render('lucky/number.html.twig', array(
//            'number' => $number,
//        ));
    }
    
     /**
     * @Route("/lucky/form", name="form")
     */
    public function formAction()
    {
     $formulaireBuilder = $this->createFormBuilder();   
     $formulaireBuilder->add('nom',TextType::class)
		  ->add('prenom',TextType::class)
		  ->add('dateentree', DateType::class)
		  ->add('enregistrer',SubmitType::class,array('label' => 'Enregistrer agent'));
    $formResult = $formulaireBuilder->getForm();
   
    if ($formResult->isSubmitted() && $formResult->isValid()) {
         return $this->redirectToRoute('homepage');
     }
    
    return $this->render('AppBundle:lucky:formulaire.html.twig',array('formulaire_agent' => $formResult->createView()));


        
        
    }
    
}

