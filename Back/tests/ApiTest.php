<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
// Import models to test them
use App\Model\RickAndMortyModel;
use App\Service\CreateRickAndMorty;

class ApiTest extends WebTestCase {
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Check mock
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function testApi(): void
    {
        $client = static::createClient();
        // Request a specific page
        $client->jsonRequest('GET', '/api/');
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals(['message' => "Hello world"], $responseData);
    }

    public function testHome() {
        $client = static::createClient();
        $client->request('GET', '/');
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful(); 

        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals(['message' => "Hello"], $responseData); // Test json response
    }

    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Check routes
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function testGetAllProducts() {
        $client = static::createClient();
        $client->jsonRequest('GET', '/api/products');
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();

        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);

        $this->assertCount(20, $responseData); // Get the count of item (here we have 20)
    }

    public function testGetProduct() {
        $client = static::createClient();
        $client->jsonRequest('GET', '/api/products/5');
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();

        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);

        $this->assertEquals($responseData, [
            "id" => 5,
            "name" => "Jerry Smith",
            "price" => $responseData["price"], // Get price randomized
            "quantity" => $responseData["quantity"], // Get quantity randomized
            "image" => "https://rickandmortyapi.com/api/character/avatar/5.jpeg"
        ]);
    }

    public function testAddProduct() {
        $client = static::createClient();
        $client->jsonRequest('POST', '/api/products', [
            "id" => 5,
            "name" => "Jerry Smith",
            "price" => $responseData["price"], // Get price randomized
            "quantity" => $responseData["quantity"], // Get quantity randomized
            "image" => "https://rickandmortyapi.com/api/character/avatar/5.jpeg"
        ]);
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();

        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);

        $this->assertEquals($responseData, [
            "id" => 5,
            "name" => "Jerry Smith",
            "price" => $responseData["price"], // Get price randomized
            "quantity" => $responseData["quantity"], // Get quantity randomized
            "image" => "https://rickandmortyapi.com/api/character/avatar/5.jpeg"
        ]);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Check models
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function testName() {
        $model = new RickAndMortyModel(); // new instance
        $model->setName("Jerry Smith"); // Set
        $this->assertEquals("Jerry Smith", $model->getName()); // Get
    }

    public function testImage() {
        $model = new RickAndMortyModel(); // new instance
        $model->setImage("https://rickandmortyapi.com/api/character/avatar/5.jpeg"); // Set
        $this->assertEquals("https://rickandmortyapi.com/api/character/avatar/5.jpeg", $model->getImage()); // Get
    }

}