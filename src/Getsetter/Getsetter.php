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
     * @param array $value
     * @return mixed
     */
    public function __call($method, $value)
    {
        $prefix = substr($method, 0, 3);
        $property = lcfirst(substr($method, 3));

        if (!property_exists($this, $property)) {
            throw new \BadMethodCallException("The property {$property} does not exist in this object.");
        }

        if ($prefix === "get") {
            return $this->_get($property);
        } elseif ($prefix === "set") {
            return $this->_set($property, $value);
        } else {
            throw new \BadMethodCallException(
                sprintf('Call to undefined method %s::%s()', get_class($this), $method)
            );
        }
    }

    /**
     * Get the value from the property.
     *
     * @param string $property
     * @return void
     */
    protected function _get($property)
    {
        return $this->$property;
    }

    /**
     * Assign the value to the property.
     *
     * @param string $property
     * @param array $value
     */
    protected function _set($property, $value)
    {
        if (count($value) > 1) {
            throw new \BadMethodCallException("Cannot assign multiple values to a property.");
        }

        if (isset($value[0])) {
            $this->$property = $value[0];
        }
    }
}
