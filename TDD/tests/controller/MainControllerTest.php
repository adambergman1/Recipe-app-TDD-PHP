<?php

class MainControllerTest extends PHPUnit\Framework\TestCase
{
    /** @test */
    function shouldCallOnMainViewRender()
    {
        $recipeViewMock = $this->getMockBuilder(AddRecipeView::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mainViewMock = $this->getMockBuilder(MainView::class)
            ->setMethods(['render'])
            ->getMock();

        $app = new MainController($mainViewMock, $recipeViewMock);

        $mainViewMock->expects($this->once())->method('render');
        $app->run();
    }

    /** @test */
    function shouldCallOnRenderAddRecipeWhenUserWantsToAddRecipe()
    {
        $mainViewMock = $this->getMockBuilder(MainView::class)
            ->getMock();

        $recipeViewMock = $this->getMockBuilder(AddRecipeView::class)
            ->disableOriginalConstructor()
            ->setMethods(['userWantsToAddRecipe', 'renderAddRecipe'])
            ->getMock();

        $recipeViewMock->method('userWantsToAddRecipe')->willReturn(true);
        $recipeViewMock->expects($this->once())->method('renderAddRecipe');

        $controller = new MainController($mainViewMock, $recipeViewMock);

        $controller->run();
    }
}
