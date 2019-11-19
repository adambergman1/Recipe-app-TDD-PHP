<?php

class MainController
{
    private $mainView;
    private $recipeView;

    public function __construct($mainView, $recipeView)
    {
        $this->mainView = $mainView;
        $this->recipeView = $recipeView;
    }

    public function run()
    {
        if ($this->recipeView->userWantsToSubmitRecipe()) {
            $this->recipeView->addRecipeValues();
        }

        return $this->mainView->render($this->recipeView);
    }
}
