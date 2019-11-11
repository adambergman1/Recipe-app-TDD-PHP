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

    /** @test */
    function shouldThrowExceptionOnInstructionLongerThan500Characters()
    {
        $this->expectException(InstructionContainsTooManyCharactersException::class);

        $input = str_pad('Instruction starts here...', 501);
        new Instruction($input);
    }

    /** @test */
    function shouldHaveFalseBooleanOnInstantiation()
    {
        $sut = new Instruction('My instruction');
        $actual = $sut->getIsCompleted();

        $this->assertFalse($actual);
    }
}
