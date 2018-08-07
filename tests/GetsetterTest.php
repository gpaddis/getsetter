<?php

use PHPUnit\Framework\TestCase;
use Getsetter\Getsetter;

class GetsetterTest extends TestCase
{
    use Getsetter;

    protected $id;
    protected $name;
    protected $lastName;
    protected $something;

    public function getSomething()
    {
        return "Something Else";
    }

    /** @test */
    public function it_sets_and_gets_existing_protected_properties()
    {
        $this->setId(5);
        $this->setName("Test Name");
        $this->setLastName("Test Last Name");

        $id = $this->getId();
        $name = $this->getName();
        $lastName = $this->getLastName();

        $this->assertEquals(5, $id);
        $this->assertEquals("Test Name", $name);
        $this->assertEquals("Test Last Name", $lastName);
    }

    /** @test */
    public function it_gives_precedence_to_existing_getter_methods()
    {
        $this->setSomething("Something");
        $this->assertEquals("Something Else", $this->getSomething());
    }

    /** @test */
    public function it_throws_an_exception_if_the_property_does_not_exist()
    {
        $this->expectException("BadMethodCallException");
        $this->setSomeNonExistingProperty("Value");
    }

    /** @test */
    public function it_throws_an_exception_if_the_method_does_not_exist()
    {
        $this->expectException("BadMethodCallException");
        $this->callSomeNonExistingMethod();
    }

    /** @test */
    public function it_throws_an_exception_if_the_prefix_is_not_get_or_set()
    {
        $this->expectException("BadMethodCallException");
        $this->fooId();
    }

    /** @test */
    public function it_cannot_assign_multiple_values_to_a_property()
    {
        $this->expectException("BadMethodCallException");
        $this->setId(1, 2, 3);
    }
}
