<?php

use PHPUnit\Framework\TestCase;

class InstructionCollectionTest extends TestCase
{
    protected $instruction;
    protected $sut;

    public function setUp(): void
    {
        $this->instruction = $this->createMock(Instruction::class);
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
        $this->sut->addInstruction($this->getInstructionMockWithRandomTitle());
        $this->sut->addInstruction($this->getInstructionMockWithRandomTitle());
        $this->sut->addInstruction($this->getInstructionMockWithRandomTitle());
        $this->sut->addInstruction($this->getInstructionMockWithRandomTitle());
        $this->sut->addInstruction($this->getInstructionMockWithRandomTitle());
        $this->sut->addInstruction($this->getInstructionMockWithRandomTitle());
        $this->sut->addInstruction($this->getInstructionMockWithRandomTitle());
        $this->sut->addInstruction($this->getInstructionMockWithRandomTitle());
        $this->sut->addInstruction($this->getInstructionMockWithRandomTitle());

        $actual = count($this->sut->getInstructions());

        $expected = 10;

        $this->assertEquals($actual, $expected);
    }

    private function getInstructionMockWithRandomTitle()
    {
        $randomWord = str_shuffle("This is an instruction that should be unique since it is random");
        $mock = $this->getMockBuilder(Instruction::class)
            ->setConstructorArgs([$randomWord])
            ->setMethods(["getInstruction"])
            ->getMock();

        $mock->method("getInstruction")
            ->willReturn($randomWord);

        return $mock;
    }

    /** @test */
    public function collectionShouldNotHoldMoreThan50Instructions()
    {
        $this->expectException(TooManyInstructionsException::class);

        $maxInstructions = 51;
        for ($i = 0; $i <= $maxInstructions; $i++) {
            $this->sut->addInstruction($this->getInstructionMockWithRandomTitle());
        }
    }

    /** @test */
    public function shouldThrowExpectionOnSameInstruction()
    {
        $this->expectException(InstructionDuplicationException::class);

        $this->sut->addInstruction($this->instruction);
        $this->sut->addInstruction($this->instruction);
    }
}
