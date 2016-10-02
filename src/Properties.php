<?php

namespace IMSoP\Strict;

use IMSoP\Strict\Exceptions\PropertyAccessException;

/**
 * "Strict Properties": do not allow fields to be dynamically added to the object.
 */
trait Properties
{
    public final function __get($dynamic_field) {
        throw new PropertyAccessException("Cannot read undeclared property '$dynamic_field' of class " . static::class);
    }

    public final function __set($dynamic_field, $requested_value) {
        throw new PropertyAccessException("Cannot assign undeclared property '$dynamic_field' of class " . static::class);
    }

    public final function __unset($dynamic_field) {
        throw new PropertyAccessException("Cannot unset undeclared property '$dynamic_field' of class " . static::class);
    }
}