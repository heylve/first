<?php
// src/AppBundle/Controller/LuckyController.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/lucky/number/{max}", name="lucky")
     */
    public function numberAction($max=100)
    {
        
        $number = mt_rand(0, $max);
            
//        return new Response(
//            '<html><body>Lucky number: '.$number.'</body></html>'
//        );
        return $this->render('AppBundle:lucky:number.html.twig', array(
            'number' => $number,
        ));
//        return $this->render('lucky/number.html.twig', array(
//            'number' => $number,
//        ));
    }
}

