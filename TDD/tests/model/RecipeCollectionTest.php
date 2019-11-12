<?php

use PHPUnit\Framework\TestCase;

class RecipeCollectionTest extends TestCase
{
    protected $sut;

    public function setUp(): void
    {
        $this->sut = new RecipeCollection();
    }

    /** @test */
    public function shouldReturnNumberOfRecipes()
    {
        $actual = $this->sut->getNumberOfRecipes();
        $expected = 0;

        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function shouldAddRecipe()
    {
        $recipeMock = $this->createMock("Recipe");

        $this->sut->addRecipe($recipeMock);
        $recipes = $this->sut->getRecipes();
        $actual = $recipes[0];

        $this->assertInstanceOf(Recipe::class, $actual);
    }
}
