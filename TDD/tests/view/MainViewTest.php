<?php

use PHPUnit\Framework\TestCase;

class MainViewTest extends TestCase
{
    private $sut;
    private $recipeViewMock;

    function setUp(): void
    {
        $this->sut = new MainView();

        $this->recipeViewMock = $this->getMockBuilder(AddRecipeView::class)
            ->disableOriginalConstructor()
            ->setMethods(['generateOutput'])
            ->getMock();
    }

    /** @test */
    function shouldGenerateMainTitle()
    {
        $actual = $this->sut->generateMainTitle();
        $expected = '<h1>My Cook Book</h1>';

        $this->assertEquals($actual, $expected);
    }

    /** @test */
    function shouldCallOnGenerateMainTitle()
    {
        $mainViewMock = $this->getMockBuilder(MainView::class)
            ->setMethods(['generateMainTitle'])
            ->getMock();

        $mainViewMock->expects($this->once())->method('generateMainTitle');

        $mainViewMock->render($this->recipeViewMock);
    }

    /** @test */
    function shouldCallOnAddRecipeMethodGenerateOutput()
    {
        $this->recipeViewMock->expects($this->once())->method('generateOutput');

        $this->sut->render($this->recipeViewMock);
    }

    /** @test */
    function shouldCallOnRenderRecipesFromRender()
    {
        $mainViewMock = $this->getMockBuilder(MainView::class)
            ->setMethods(['renderRecipes'])
            ->getMock();

        $mainViewMock->expects($this->once())->method('renderRecipes');

        $mainViewMock->render($this->recipeViewMock);
    }

    /** @test */
    function shouldReturnNoRecipesFromRenderRecipesIfCollectionNull()
    {
        $actual = $this->sut->renderRecipes(null);

        $expected = '<p>No recipes</p>';

        $this->assertEquals($actual, $expected);
    }

    /** @test */
    function shouldDisplayRecipe()
    {
        $recipeMock = $this->createMock(Recipe::class);
        $ingredientsMock = $this->createMock(Ingredient::class);
        $instructionsMock = $this->createMock(Instruction::class);
        $instructionCollectionMock = $this->createMock(InstructionsCollection::class);
        $recipeCollectionMock = $this->createMock(RecipeCollection::class);

        $ingredientsMock->method('getName')->willReturn('Potatoes');
        $ingredientsMock->method('getAmount')->willReturn(2.0);
        $ingredientsMock->method('getMeasurement')->willReturn('pcs');

        $instructionsMock->method('getInstruction')->willReturn('This is the first instruction');
        $instructionCollectionMock->method('getInstructions')->willReturn([$instructionsMock]);


        $recipeMock->method('getTitle')->willReturn('Meatloaf');
        $recipeMock->method('getAuthor')->willReturn('Per Morberg');
        $recipeMock->method('getServings')->willReturn(2);
        $recipeMock->method('getTagName')->willReturn('Dinner');
        $recipeMock->method('getIngredients')->willReturn([$ingredientsMock]);
        $recipeMock->method('getInstructions')->willReturn($instructionCollectionMock);

        $recipeCollectionMock->method('getRecipes')->willReturn([$recipeMock]);

        $actual = $this->sut->render($this->recipeViewMock, $recipeCollectionMock);

        $expectedTitle = 'Meatloaf';
        // $expectedAuthor = 'Per Morberg';

        $this->assertStringContainsString($expectedTitle, $actual);
        // $this->assertStringContainsString($expectedAuthor, $actual);
    }
}
