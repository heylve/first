<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class DefaultControllerTest extends WebTestCase
{
//    public function testIndex()
//    {
//        $client = static::createClient();
//
//        $crawler = $client->request('GET', '/');
//
//        $this->assertEquals(200, $client->getResponse()->getStatusCode());
//        $this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
//    }
    
    public function testIndex()
    {
        
          $client = static::createClient();
          $crawler = $client->request('GET', '/');
          $this->assertEquals(200, $client->getResponse()->getStatusCode());
          $this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
          $this->assertContains('Home', $crawler->filter('body > #sidebar > ul > li')->text());
    }
    
}
