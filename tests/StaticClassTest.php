<?php

use IMSoP\Strict\Exceptions\ConstructionException;

class StaticClassTestSampleClass
{
    use \IMSoP\Strict\StaticClass;

    public static function foo() {
        return 42;
    }
}

class StaticClassTest extends PHPUnit_Framework_TestCase
{
    public function testStaticMethod() {
        $answer = StaticClassTestSampleClass::foo();
        $this->assertEquals($answer, 42);
    }

    public function testConstruct() {
        $this->expectException(ConstructionException::class);
        $this->expectExceptionMessage(
            'Class StaticClassTestSampleClass should only be used statically.'
        );

        $foo = new StaticClassTestSampleClass;
    }
}
