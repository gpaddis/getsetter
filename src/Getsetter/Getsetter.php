<?php

namespace Getsetter;

trait Getsetter
{
    /**
     * Get or set a protected property in the class with a call to getProperty or setProperty.
     *
     * @param string $method
     * @param array $arguments
     * @return mixed
     */
    public function __call(string $method, array $arguments)
    {
        $prefix = substr($method, 0, 3);
        $property = lcfirst(substr($method, 3));

        if (!property_exists($this, $property)) {
            throw new \BadMethodCallException("The property {$property} does not exist in this object.");
        }

        if ($prefix === "get") {
            return $this->__get($property);
        } elseif ($prefix === "set") {
            return $this->__set($property, ...$arguments);
        } else {
            throw new \BadMethodCallException("Invalid method call: {$method}.");
        }
    }

    /**
     * Get the property.
     *
     * @param string $property
     * @return mixed
     */
    public function __get(string $property)
    {
        return $this->$property;
    }

    /**
     * Set the property.
     *
     * @param string $property
     * @param mixed $value
     */
    public function __set(string $property, $value)
    {
        $this->$property = $value;
    }
}
