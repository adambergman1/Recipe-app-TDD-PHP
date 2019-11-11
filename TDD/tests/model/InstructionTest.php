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
        $this->expectException(EmptyInstructionException::class);

        $input = '';
        new Instruction($input);
    }

    /** @test */
    function shouldThrowExceptionOnInstructionShorterThanTwoWords()
    {
        $this->expectException(InstructionContainsTooFewWordsException::class);

        $input = 'Fry';
        new Instruction($input);
    }
}
