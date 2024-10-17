<?php
namespace GoodSystem\TestPackage\Tests\Feature;
//use Tests\TestCase;
class FourPhaseTest extends  \Orchestra\Testbench\TestCase
{
    public function testAddsandRetrieveAnElement()
    {
        // arrange
        $sut = new ArrayObject();

        // act
        $sut->offsetSet('key', 'value');
        $retrieved = $sut['key'];

        // assert
        $this->assertEquals('value', $retrieved);

        // teardown: not necessary, and won't be included in the other tests
        // object structures are automatically discarded and you should
        // worry to tear down only external resources like connections
        unset($sut);

    }

    public function testImplementsCountable()
    {
        // arrange
        $sut = new ArrayObject(array(1, 2, 3));

        // Constructor Test: no act phase

        // assert
        $this->assertEquals(3, count($sut));
    }

    /**
     * @expectedException PHPUnit_Framework_Error_Notice
     */
    public function testRemovesAnElement()
    {
        // arrange
        $sut = new ArrayObject(array('value', 'otherValue'));

        // act
        $sut->offsetUnset(0);
        $sut[0];

        // assert is declared with the annotation
        // the same goes for mock expectations: assert is implicit
    }
}