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

    // Get all recipe titles

    // Filtrera tags
    /** @test */
    public function shouldFilterRecipesByTag()
    {
        $recipeMock = $this->createMock(Recipe::class);
        $recipeMock->method('getTagName')
            ->willReturn('Lunch');

        $recipeMock2 = $this->createMock(Recipe::class);
        $recipeMock2->method('getTagName')
            ->willReturn('Dinner');

        $this->sut->addRecipe($recipeMock);
        $this->sut->addRecipe($recipeMock2);

        $input = "Lunch";

        $actual = $this->sut->filterByTag($input);

        $this->assertContains($recipeMock, $actual);
        $this->assertNotContains($recipeMock2, $actual);
    }
}
