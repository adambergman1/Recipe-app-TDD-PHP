<?php

use PHPUnit\Framework\TestCase;

class RecipeFactoryTest extends TestCase
{
    protected $sut;

    public function setUp(): void
    {
        $this->sut = new RecipeFactory();
    }

    /** @test */
    public function shouldInstanciateInstruction()
    {
        $actual = $this->sut->instanciateInstruction("My first instruction");

        $this->assertInstanceOf(Instruction::class, $actual);
    }

    /** @test */
    public function shouldInstanciateRecipe()
    {
        $actual = $this->sut->instanciateRecipe("Recipe");

        $this->assertInstanceOf(Recipe::class, $actual);
    }

    /** @test */
    public function shouldInstanciateAmount()
    {
        $actual = $this->sut->instanciateAmount(2.5);

        $this->assertInstanceOf(Amount::class, $actual);
    }

    /** @test */
    public function shouldInstanciateMeasurement()
    {
        $actual = $this->sut->instanciateMeasurement("dl");

        $this->assertInstanceOf(Measurement::class, $actual);
    }

    /** @test */
    public function shouldInstanciateIngredient()
    {
        $actual = $this->sut->instanciateIngredient("My ingredient");

        $this->assertInstanceOf(Ingredient::class, $actual);
    }

    /** @test */
    public function shouldInstanciateInstructionsCollection()
    {
        $actual = $this->sut->instanciateInstructionsCollection();

        $this->assertInstanceOf(InstructionsCollection::class, $actual);
    }
}
