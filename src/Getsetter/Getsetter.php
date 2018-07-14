<?php

/**
 * This file is part of the Getsetter package.
 *
 * Author: Gianpiero Addis <gianpiero.addis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Getsetter;

trait Getsetter
{
    /**
     * Get or set a property in the class with a call to getProperty or setProperty.
     *
     * @param string $method
     * @param array $arguments
     * @return mixed
     */
    public function __call($method, $arguments)
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
            throw new \BadMethodCallException("The method {$method} does not exist.");
        }
    }

    /**
     * Get the value of the property called.
     *
     * @param string $property
     * @return mixed
     */
    public function __get($property)
    {
        return $this->$property;
    }

    /**
     * Set the value provided in property.
     *
     * @param string $property
     * @param mixed $value
     */
    public function __set($property, $value)
    {
        $this->$property = $value;
    }
}
