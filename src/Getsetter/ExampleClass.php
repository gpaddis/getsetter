<?php

namespace Getsetter;

class ExampleClass
{
    use Getsetter;

    protected $id;
    protected $name;
    protected $lastName;

    public function getSomethingElse()
    {
        return "Something Else";
    }
}
