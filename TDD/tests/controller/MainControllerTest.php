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
                'getRecipe'
            ])
            ->getMock();

        $this->mainViewMock = $this->getMockBuilder(MainView::class)
            ->setMethods(['render'])
            ->getMock();

        $this->collectionMock = $this->getMockBuilder(RecipeCollection::class)
            ->setMethods(['addRecipe', 'isRecipeSessionEmpty'])
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
    function shouldCallOngetRecipeWhenUserWantsToSubmitRecipe()
    {
        $this->recipeViewMock->method('userWantsToSubmitRecipe')->willReturn(true);
        $this->recipeViewMock->expects($this->once())->method('getRecipe');

        $this->sut->run();
    }

    /** @test */
    function shouldCallOnAddRecipeWhenUserWantsToAddRecipe()
    {
        $this->recipeViewMock->method('userWantsToSubmitRecipe')->willReturn(true);

        $recipe = $this->createMock(Recipe::class);

        $this->recipeViewMock->method('getRecipe')->willReturn($recipe);
        $this->collectionMock->expects($this->once())->method('addRecipe')->with($this->identicalTo($recipe));

        $this->sut->run();
    }

    /** @test */
    function shouldAddRecipesFromSession()
    {
        $this->collectionMock->method('isRecipeSessionEmpty')->willReturn(false);

        $this->collectionMock->expects($this->once())->method('addRecipe');

        $this->sut->run();
    }
}
