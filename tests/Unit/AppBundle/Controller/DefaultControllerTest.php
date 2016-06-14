<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Controller\DefaultController;
use DeckOfCards\Domain\Army;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Members', $crawler->filter('#container h1')->text());
    }


}
