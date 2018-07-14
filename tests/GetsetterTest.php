<?php

use PHPUnit\Framework\TestCase;
use Getsetter\ExampleClass;

class GetsetterTest extends TestCase
{
    protected $baseClass;

    public function setUp()
    {
        $this->baseClass = new ExampleClass();
    }

    /** @test */
    public function it_sets_and_gets_an_existing_protected_property()
    {
        $this->baseClass->setId(5);
        $this->baseClass->setName("Test Name");
        $this->baseClass->setLastName("Test Last Name");

        $id = $this->baseClass->getId();
        $name = $this->baseClass->getName();
        $lastName = $this->baseClass->getLastName();

        $this->assertEquals(5, $id);
        $this->assertEquals("Test Name", $name);
        $this->assertEquals("Test Last Name", $lastName);
    }

    /** @test */
    public function it_gives_precedence_to_existing_getter_methods()
    {
        $this->assertEquals("Something Else", $this->baseClass->getSomethingElse());
    }

    /** @test */
    public function it_throws_an_exception_if_the_property_does_not_exist()
    {
        $this->expectException("BadMethodCallException");

        $this->baseClass->setSomeNonexistingProperty("Value");
        $this->baseClass->getSomeNonexistingProperty();
    }
}
