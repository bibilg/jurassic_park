<?php

require_once 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class UnitariesTest extends TestCase {

    public function test_something()
    {
        $this->assertEquals("Test", "Test");
    }
}