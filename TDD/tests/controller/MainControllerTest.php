<?php

class MainControllerTest extends PHPUnit\Framework\TestCase
{
    protected $recipeViewMock;
    protected $mainViewMock;
    protected $sut;

    function setUp(): void
    {
        $this->recipeViewMock = $this->getMockBuilder(AddRecipeView::class)
            ->disableOriginalConstructor()
            ->setMethods(['userWantsToAddRecipe', 'renderAddRecipe'])
            ->getMock();

        $this->mainViewMock = $this->getMockBuilder(MainView::class)
            ->setMethods(['render'])
            ->getMock();

        $this->sut = new MainController($this->mainViewMock, $this->recipeViewMock);
    }

    /** @test */
    function shouldCallOnMainViewRender()
    {
        $this->mainViewMock->expects($this->once())->method('render');
        $this->sut->run();
    }

    /** @test */
    function shouldCallOnRenderAddRecipeWhenUserWantsToAddRecipe()
    {
        $this->recipeViewMock->method('userWantsToAddRecipe')->willReturn(true);
        $this->recipeViewMock->expects($this->once())->method('renderAddRecipe');

        $this->sut->run();
    }
}
