<?php
namespace ws\cept\tests\unit;

use Codeception\Test\Unit;

class UnitTest extends Unit
{
    public function testTrue()
    {
        $this->assertTrue(true);
    }

    public function testFalse()
    {
        $this->assertFalse(false);
    }
}
