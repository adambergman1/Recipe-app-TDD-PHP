<?php

class MainControllerTest extends PHPUnit\Framework\TestCase
{
    protected $recipeViewMock;
    protected $mainViewMock;
    protected $collectionMock;

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

        $this->collectionMock = $this->getMockBuilder(RecipeCollection::class)
            ->setMethods(['addRecipe'])
            ->getMock();

        $this->sut = new MainController($this->mainViewMock, $this->recipeViewMock, $this->collectionMock);
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
        $this->recipeViewMock->method('userWantsToSubmitRecipe')->willReturn(true);
        $this->collectionMock->expects($this->once())->method('addRecipe');

        $this->sut->run();
    }
}
