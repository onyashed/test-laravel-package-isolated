<?php
namespace GoodSystem\TestPackage\Tests\Feature;
//use PHPUnit\Framework\TestCase;
use GoodSystem\TestPackage\Tests\RouteTest as TestCase;
use GoodSystem\TestPackage\MyClass;
use GoodSystem\TestPackage\Mpesa;


//require_once 'src/bootstrap.php';
/** @test */
class MyClassTest extends TestCase
{
    public function testConcatenateStrings()
    {
        $myClass = new MyClass();
        $str1 = 'hello';
        $str2 = 'world';
        $expectedResult = 'helloworld';

        $result = $myClass->concatenateStrings($str1, $str2);
        $this->assertEquals($expectedResult, $result);

        $this->assertEquals($expectedResult, $str1.$str2);
    }
    public function testmethod2(){
        $mpesa=new MyClass();
        $response = $mpesa->generateToken();
        $this->assertTrue($response);
    }
    
}