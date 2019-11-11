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

    /** @test */
    public function shouldBeAbleToHold10Instructions()
    {
        $this->sut->addInstruction($this->instruction);
        $this->sut->addInstruction(new Instruction("Peal Potatoes"));
        $this->sut->addInstruction(new Instruction("Chop onions"));
        $this->sut->addInstruction(new Instruction("Fry the fish"));
        $this->sut->addInstruction(new Instruction("Rost onions"));
        $this->sut->addInstruction(new Instruction("Chop salad"));
        $this->sut->addInstruction(new Instruction("Heat garlic"));
        $this->sut->addInstruction(new Instruction("Melt butter"));
        $this->sut->addInstruction(new Instruction("Put potatoes in oven"));
        $this->sut->addInstruction(new Instruction("Cook rice"));

        $actual = count($this->sut->getInstructions());

        $expected = 10;

        $this->assertEquals($actual, $expected);
    }
}
