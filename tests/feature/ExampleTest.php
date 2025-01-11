<?php

//namespace GoodSystem\TestPackage\Tests\Feature;
//use GoodSystem\TestPackage\Tests\RouteTest as TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
//use \Ochestra\Testbench\TestCase;
use VeryGood\TestPackage\Tests\RouteTest;

class ExampleTest extends  RouteTest
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('installmpesapackage');

        $response->assertStatus(200);
    }
   
}
