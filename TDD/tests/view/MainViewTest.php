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
}
