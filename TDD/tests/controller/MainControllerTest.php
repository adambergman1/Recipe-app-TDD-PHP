<?php

class MainControllerTest extends PHPUnit\Framework\TestCase
{
    /** @test */
    function shouldReturnMainViewRender()
    {
        $app = new MainController();
        $actual = $app->run();

        $this->assertStringContainsString('DOCTYPE html', $actual);
    }

    /** @test */
    function shouldCallOnRenderAddRecipeWhenUserWantsToAddRecipe()
    {
        $controller = new MainController();

        $recipeViewMock = $this->getMockBuilder(AddRecipeView::class)
            ->disableOriginalConstructor()
            ->setMethods(['userWantsToAddRecipe', 'renderAddRecipe'])
            ->getMock();

        $recipeViewMock->method('userWantsToAddRecipe')->willReturn(true);
        $recipeViewMock->expects($this->once()->method('renderAddRecipe'));

        $controller->run();
    }
}
