<?php

use PHPUnit\Framework\TestCase;

class MainViewTest extends TestCase
{
    /** @test */
    public function shouldGenerateMainTitle()
    {
        $view = new MainView();

        $actual = $view->generateMainTitle();
        $expected = '<h1>My Cook Book</h1>';

        $this->assertEquals($actual, $expected);
    }

    /** @test */
    public function shouldCallOnGenerateMainTitle()
    {
        $viewMock = $this->getMockBuilder(MainView::class)
            ->setMethods(['generateMainTitle'])
            ->getMock();

        $viewMock->expects($this->once())->method('generateMainTitle');

        $mockRecipe = $this->getMockBuilder(AddRecipeView::class)
            ->disableOriginalConstructor()
            ->setMethods(['generateOutput'])
            ->getMock();

        $viewMock->render($mockRecipe);
    }
    /** @test */

    public function shouldCallOnAddRecipeMethodGenerateOutput()
    {
        $viewMock = $this->getMockBuilder(AddRecipeView::class)
            ->disableOriginalConstructor()
            ->setMethods(['generateOutput'])
            ->getMock();

        $viewMock->expects($this->once())->method('generateOutput');
        $mainView = new MainView();

        $mainView->render($viewMock);
    }
}
