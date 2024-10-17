<?php
namespace GoodSystem\TestPackage\Tests\Feature;
//use GoodSystem\TestPackage\PressBaseServiceProvider;

//use Asanta\Press\Tests\BaseTest;
//use Asanta\Press\Tests\TestCase;
use GoodSystem\TestPackage\Mpesa;
use GoodSystem\TestPackage\MyClass;
//Test authentication to mpesa sand box
//use GoodSystem\TestPackage\Tests\RouteTest as TestCase;
class AuthTokenTest extends  \Orchestra\Testbench\TestCase
{
    public function test_it_can_get_auth_token()
    {
        $mpesa=new Mpesa();
        $response = $mpesa->generateToken();
        $this->assertTrue($response);
    }
    
}