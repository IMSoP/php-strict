<?php

namespace IMSoP\Strict;

use IMSoP\Strict\Exceptions\ConstructionException;

/**
 * "Strict Static Class": Use when a class is simply an autoloadable container for static members.
 */
trait StaticClass
{
    public final function __construct()
    {
        throw new ConstructionException('Class ' . static::class . ' should only be used statically.');
    }
}