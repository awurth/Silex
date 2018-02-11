<?php

namespace Tests\Controller;

use Silex\WebTestCase;

class AppControllerTest extends WebTestCase
{
    public function testHome()
    {
        $client = $this->createClient();
        $client->request('GET', '/');

        $this->assertTrue($client->getResponse()->isOk());
        $this->assertContains('<h1>Home</h1>', $client->getResponse()->getContent());
    }

    /**
     * {@inheritdoc}
     */
    public function createApplication()
    {
        return require __DIR__ . '/../app.php';
    }
}
