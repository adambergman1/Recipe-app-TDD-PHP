<?php

use PHPUnit\Framework\TestCase;

class InstructionTest extends TestCase
{
    /** @test */
    function shouldAcceptInstruction()
    {
        $input = 'Turn on the oven at 200 degrees';
        $sut = new Instruction($input);
        $actual = $sut->getInstruction();

        $expected = 'Turn on the oven at 200 degrees';

        $this->assertEquals($actual, $expected);
    }

    /** @test */
    function shouldThrowExceptionOnEmptyInstruction()
    {
        $this->expectException(Exception::class);

        $input = '';
        new Instruction($input);
    }
}
