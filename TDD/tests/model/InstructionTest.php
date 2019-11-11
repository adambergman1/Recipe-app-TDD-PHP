<?php

use PHPUnit\Framework\TestCase;

class InstructionTest extends TestCase
{
    protected $instruction;

    protected function setUp(): void
    {
        $this->instruction = new Instruction("My instruction");
    }

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
        $actual = $this->instruction->isCompleted();

        $this->assertFalse($actual);
    }

    /** @test */
    function shouldHaveTrueBooleanOnChangedState()
    {
        $input = true;
        $this->instruction->setCompleted($input);
        $actual = $this->instruction->isCompleted();

        $this->assertTrue($actual);
    }

    /** @test */
    function shouldHaveFalseBooleanOnChangedState()
    {
        $input = true;
        $this->instruction->setCompleted($input);
        $actual = $this->instruction->isCompleted();

        $this->assertTrue($actual);

        $input = false;
        $this->instruction->setCompleted($input);
        $actual = $this->instruction->isCompleted();

        $this->assertFalse($actual);
    }
}
