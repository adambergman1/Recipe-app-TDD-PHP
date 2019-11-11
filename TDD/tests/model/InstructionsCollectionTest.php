<?php

use PHPUnit\Framework\TestCase;

class InstructionCollectionTest extends TestCase
{
    protected $instruction;
    protected $sut;

    public function setUp(): void
    {
        $this->instruction = new Instruction('Set oven to 200°');
        $this->sut = new InstructionsCollection();
    }

    /** @test */
    public function shouldAddInstructionToCollection()
    {
        $this->sut->addInstruction($this->instruction);

        $actual = $this->sut->getInstructions();

        $expected = array();
        $expected[] = $this->instruction;

        $this->assertEquals($actual, $expected);
    }
}
