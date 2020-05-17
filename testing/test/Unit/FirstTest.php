<?php

namespace Test\Unit;

use PHPUnit\Framework\TestCase;
use App\Calculator;

class FirstTest extends TestCase
{
    /**
     * @test
     */
    public function Sum()
    {
        $c = new Calculator();
        $this->assertEquals(5, $c->sum(3,2));
        $this->assertInstanceOf(Calculator::class, $c);
    }

    public function testToComplete()
    {
        $this->markTestIncomplete();
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSkipped()
    {
        if(true) {
            $this->markTestSkipped('Test omitido: validando comportamiento');
        }
    }
}