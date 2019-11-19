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
            ->setMethods([
                'userWantsToAddRecipe',
                'renderAddRecipe',
                'generateAddRecipeBtnForm',
                'userWantsToSubmitRecipe',
                'addRecipeValues'
            ])
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
    function shouldCallOnAddRecipeValuesWhenUserWantsToSubmitRecipe()
    {
        $this->recipeViewMock->method('userWantsToSubmitRecipe')->willReturn(true);
        $this->recipeViewMock->expects($this->once())->method('addRecipeValues');

        $this->sut->run();
    }

    /** @test */
    function shouldCallOnAddRecipeWhenUserWantsToAddRecipe()
    {
        $collectionMock = $this->getMockBuilder(RecipeCollection::class)
            ->setMethods(['addRecipe'])
            ->getMock();

        $this->recipeViewMock->method('userWantsToSubmitRecipe')->willReturn(true);
        $collectionMock->expects($this->once())->method('addRecipe');

        $this->sut->run();
    }
}
