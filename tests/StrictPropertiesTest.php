<?php

use IMSoP\Strict\Exceptions\PropertyAccessException;

class StrictPropertiesTestSampleClass
{
    use \IMSoP\Strict\Properties;

    public $publicProperty;
    private $privateProperty;

    public function setPrivateProperty($value) {
        $this->privateProperty = $value;
    }

    public function getPrivateProperty() {
        return $this->privateProperty;
    }
}

class StrictPropertiesTest extends PHPUnit_Framework_TestCase
{
    public function testPublicDeclaredProperty() {
        $foo = new StrictPropertiesTestSampleClass;

        // This should not error, and should set the property as normal
        $foo->publicProperty = 'test';
        $this->assertEquals($foo->publicProperty, 'test');
    }

    public function testUnsetDeclaredProperty() {
        $foo = new StrictPropertiesTestSampleClass;

        unset($foo->publicProperty);

        // Unset has the power to "undeclare" properties, so writing to it will now fail
        $this->expectException(PropertyAccessException::class);
        $this->expectExceptionMessage(
            "Cannot assign undeclared property 'publicProperty' of class StrictPropertiesTestSampleClass"
        );

        $foo->publicProperty = 'test';
    }

    public function testSetUndeclaredProperty() {
        $foo = new StrictPropertiesTestSampleClass;

        $this->expectException(PropertyAccessException::class);
        $this->expectExceptionMessage(
            "Cannot assign undeclared property 'noSuchProperty' of class StrictPropertiesTestSampleClass"
        );

        $foo->noSuchProperty = 'test';
    }

    public function testGetUndeclaredProperty() {
        $foo = new StrictPropertiesTestSampleClass;

        $this->expectException(PropertyAccessException::class);
        $this->expectExceptionMessage(
            "Cannot read undeclared property 'noSuchProperty' of class StrictPropertiesTestSampleClass"
        );

        $test = $foo->noSuchProperty;
    }

    public function testUnsetUndeclaredProperty() {
        $foo = new StrictPropertiesTestSampleClass;

        $this->expectException(PropertyAccessException::class);
        $this->expectExceptionMessage(
            "Cannot unset undeclared property 'noSuchProperty' of class StrictPropertiesTestSampleClass"
        );

        unset($foo->noSuchProperty);
    }

    public function testPrivatePropertyPublicScope() {
        $foo = new StrictPropertiesTestSampleClass;

        // I guess ideally we'd get the PHP error here
        $this->expectException(PropertyAccessException::class);
        $this->expectExceptionMessage(
            "Cannot assign undeclared property 'privateProperty' of class StrictPropertiesTestSampleClass"
        );

        $foo->privateProperty = 'test';
    }

    public function testPrivatePropertyPrivateScope() {
        $foo = new StrictPropertiesTestSampleClass;

        // This should not error, and should set the property as normal
        $foo->setPrivateProperty('test');
        $this->assertEquals($foo->getPrivateProperty(), 'test');
    }
}
