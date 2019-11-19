<?php

class MainController
{
    private $mainView;
    private $recipeView;
    private $recipeCollection;

    public function __construct($mainView, $recipeView, $collection)
    {
        $this->mainView = $mainView;
        $this->recipeView = $recipeView;
        $this->recipeCollection = $collection;
    }

    public function run()
    {
        if ($this->recipeView->userWantsToSubmitRecipe()) {
            $recipe = $this->recipeView->addRecipeValues();
            $this->recipeCollection->addRecipe($recipe);
        }

        return $this->mainView->render($this->recipeView, $this->recipeCollection);
    }
}
