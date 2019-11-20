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
        $recipeMock = $this->getRecipeStub();

        $this->sut->addRecipe($recipeMock);
        $recipes = $this->sut->getRecipes();
        $actual = $recipes[0];

        $this->assertInstanceOf(Recipe::class, $actual);
    }

    /** @test */
    public function shouldFilterRecipesByTag()
    {
        $recipeMock = $this->getRecipeStub();
        $recipeMock->method('getTagName')
            ->willReturn('Lunch');

        $recipeMock2 = $this->getRecipeStub();
        $recipeMock2->method('getTagName')
            ->willReturn('Dinner');

        $this->sut->addRecipe($recipeMock);
        $this->sut->addRecipe($recipeMock2);

        $input = "Lunch";

        $actual = $this->sut->filterByTag($input);

        $this->assertContains($recipeMock, $actual);
        $this->assertNotContains($recipeMock2, $actual);
    }

    /** @test */
    public function shouldReturnAllRecipeTitles()
    {
        $recipeMock = $this->getRecipeStub();
        $recipeMock->method('getTitle')
            ->willReturn('First recipe');

        $recipeMock2 = $this->getRecipeStub();
        $recipeMock2->method('getTitle')
            ->willReturn('Second recipe');

        $this->sut->addRecipe($recipeMock);
        $this->sut->addRecipe($recipeMock2);

        $actual = $this->sut->getAllRecipeTitles();
        $expected = ["First recipe", "Second recipe"];

        $this->assertEquals($actual, $expected);
    }

    /** @test */
    public function shouldReturnTrueWhenRecipesSessionIsEmpty()
    {
        $_SESSION["recipes"] = null;

        $actual = $this->sut->isRecipeSessionEmpty();

        $this->assertTrue($actual);
    }

    private function getRecipeStub()
    {
        return $this->createMock(Recipe::class);
    }
}
