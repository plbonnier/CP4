<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OrangOutanControllerTest extends WebTestCase
{
    public function testPageH1EsSuccessful(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Notre action');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('p', 'outans');
    }
}
