<?php

namespace App\Tests;

use Symfony\Component\Panther\PantherTestCase;

class E2eTest extends PantherTestCase
{
    public function testMyApp()
    {
        $client = static::createPantherClient(); // Your app is automatically started using the built-in web server
        $crawler = $client->request('GET', '/mypage');

        $this->assertContains('My Title', $crawler->filter('title')->html()); // You can use any PHPUnit assertion
    }
}