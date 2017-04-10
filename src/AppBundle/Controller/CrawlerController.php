<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Goutte\Client;
use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client as GuzzleClient;

class CrawlerController extends Controller
{
    /**
     * @Route("crawler/index")
     */
    public function IndexAction()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'http://www.phrack.org');
        
//        $crawler = $client->click($crawler->selectLink('Sign in')->link());
//        $form = $crawler->selectButton('Sign in')->form();
//        $crawler = $client->submit($form, array('login' => 'heylve', 'password' => 'Bepicolombopgh31'));
        $arr_node =[];
        $node_nb = $crawler->filter('body > h2 ');
//        $node_nb=$crawler->text();
        $crawler->filter('#footer')->each(function ($node) {
//         $arr_node[$node]=$node->text();
            $node_nb+=1;
});
         
            return new Response(
            '<html><body>page number: '.var_dump($node_nb).'</body></html>'
        ); 
//        return $this->render('AppBundle:Crawler:index.html.twig', array(
//            'nodes'=>$arr_node, 
//        ));
    }

    /**
     * @Route("/Show")
     */
    public function ShowAction()
    {
        return $this->render('AppBundle:Crawler:show.html.twig', array(
            // ...
        ));
    }

}
