<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class FunctionsTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_email()
    {
        $result = validate_email('cristhofer.dev@gmail.com');
        $this->assertTrue($result);

        $result = validate_email('cristhofer.dev@@gmail.com');
        $this->assertFalse($result);

    }
}
