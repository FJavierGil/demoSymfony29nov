<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiLibroControllerTest extends WebTestCase
{
    protected $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testListLibros()
    {
        // Request a specific page
        $crawler = $this->client->request('GET', '/api/v1/libros/');
        self::assertResponseIsSuccessful();

        $respuesta = $this->client->getResponse()->getContent();
        self::assertJson($respuesta);
    }
}
