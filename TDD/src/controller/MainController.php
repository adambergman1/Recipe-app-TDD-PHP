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
        $newRecipe = null;

        if ($this->recipeView->userWantsToSubmitRecipe()) {
            $newRecipe = $this->recipeView->getRecipe();
            $this->recipeCollection->addRecipe($newRecipe);
        }

        if (!$this->recipeCollection->isRecipeSessionEmpty()) {
            foreach ($_SESSION["recipes"] as $recipe) {
                if ($recipe != $newRecipe) {
                    $this->recipeCollection->addRecipe($recipe);
                }
            }
        }

        return $this->mainView->render($this->recipeView, $this->recipeCollection);
    }
}
