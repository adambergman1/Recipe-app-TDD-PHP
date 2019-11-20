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
            $recipe = $this->recipeView->getRecipe();
            $this->recipeCollection->addRecipe($recipe);
            // header("location: ./");
        }

        if (!$this->recipeCollection->isRecipeSessionEmpty()) {
            foreach ($_SESSION["recipes"] as $recipe) {
                $this->recipeCollection->addRecipe($recipe);
            }
        }

        return $this->mainView->render($this->recipeView, $this->recipeCollection);
    }
}
