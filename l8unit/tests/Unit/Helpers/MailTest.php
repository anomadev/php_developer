<?php

namespace Tests\Unit\Helpers;

use App\Helpers\Email;
use PHPUnit\Framework\TestCase;

class MailTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_email()
    {
        $result = Email::validate('cristhofer.dev@gmail.com');
        $this->assertTrue($result);

        $result = Email::validate('cristhofer.dev@@gmail.com');
        $this->assertFalse($result);
    }
}
