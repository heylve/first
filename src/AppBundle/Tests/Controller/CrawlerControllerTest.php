<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CrawlerControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Index');
    }

    public function testShow()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Show');
    }

}
