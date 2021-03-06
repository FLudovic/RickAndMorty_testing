<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use PHPUnit\Framework\TestCase;
// Import models to test them
use App\Model\RickAndMortyModel;
use App\Service\CreateRickAndMorty;
// Get http response
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Contracts\HttpClient\ResponseInterface;

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
    // Check CRUD
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
            "price" => "8", // Get price randomized
            "quantity" => "30", // Get quantity randomized
            "image" => "https://rickandmortyapi.com/api/character/avatar/5.jpeg"
        ]);
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();

        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);

        $this->assertEquals($responseData, [
            "id" => 21,
            "name" => "Jerry Smith",
            "price" => $responseData["price"], // Get price randomized
            "quantity" => $responseData["quantity"], // Get quantity randomized
            "image" => "https://rickandmortyapi.com/api/character/avatar/5.jpeg"
        ]);
    }

    public function testDeleteProduct()
    {
        $client = static::createClient();
        $client->jsonRequest('DELETE', '/api/products/21');
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();

        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);

        $this->assertEquals($responseData, ['delete' => 'ok']);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Check Basket CRUD
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function testAddProductToCart()
    {
        $client = static::createClient();
        $client->jsonRequest('POST', '/api/cart/5', [
            "id" => 5,
            "name" => "Jerry Smith",
            "price" => "8", // Get price randomized
            "quantity" => "30", // Get quantity randomized
            "image" => "https://rickandmortyapi.com/api/character/avatar/5.jpeg"
        ]);
        $response = $client->getResponse();
        $this->assertResponseIsSuccessful();

        $this->assertJson($response->getContent());
        $responseData = json_decode($response->getContent(), true);
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