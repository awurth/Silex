<?php

namespace Tests\App\Controller;

use Silex\WebTestCase;

class CoreControllerTest extends WebTestCase
{
    public function testHome()
    {
        $client = $this->createClient();
        $client->request('GET', '/');

        $this->assertTrue($client->getResponse()->isOk());
        $this->assertContains('<h1 class="ui header">Home</h1>', $client->getResponse()->getContent());
    }

    /**
     * {@inheritdoc}
     */
    public function createApplication()
    {
        return require __DIR__ . '/../../app.php';
    }
}
