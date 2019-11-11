<?php

use PHPUnit\Framework\TestCase;

class RecipeTest extends TestCase
{
    protected $amount;
    protected $ingredient;
    protected $measurement;
    protected $instruction;
    protected $instructionsCollection;

    public function setUp(): void
    {
        $this->amount = $this->getMockBuilder("Amount")
            ->setConstructorArgs([2.0])
            ->setMethods(["getAmount"])
            ->getMock();

        $this->amount->method("getAmount")
            ->willReturn(2.0);

        $this->ingredient = $this->getMockBuilder("Ingredient")
            ->setConstructorArgs(["flour"])
            ->setMethods(["getIngredient"])
            ->getMock();

        $this->ingredient->method("getIngredient")
            ->willReturn("flour");

        $this->measurement = $this->getMockBuilder("Measurement")
            ->setConstructorArgs(["dl"])
            ->setMethods(["getMeasurement"])
            ->getMock();

        $this->measurement->method("getMeasurement")
            ->willReturn("dl");

        $this->instruction = $this->getMockBuilder("Instruction")
            ->setConstructorArgs(["Cook fish"])
            ->setMethods(["getInstruction", "isCompleted"])
            ->getMock();

        $this->instruction->method("getInstruction")
            ->willReturn("Cook fish");
        $this->instruction->method("isCompleted")
            ->willReturn(false);

        $this->instructionsCollection = $this->getMockBuilder("InstructionsCollection")
            ->disableOriginalClone()
            ->setMethods(["getInstructions"])
            ->getMock();

        $this->instructionsCollection->method("getInstructions")
            ->willReturn([$this->instruction]);
    }

    /** @test */
    public function test()
    {
        var_dump($this->instruction);
        foreach ($this->instructionsCollection->getInstructions() as $key) {
            echo $key->getInstruction();
            $this->assertFalse($key->isCompleted());
        }
        $this->assertTrue(true);
    }
}
