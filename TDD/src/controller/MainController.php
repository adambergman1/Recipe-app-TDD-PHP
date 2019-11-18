<?php

require_once(__DIR__ . '/../view/MainView.php');

class MainController
{
    private $mainView;

    public function __construct()
    {
        $this->mainView = new MainView();
    }

    public function run()
    {
        $factory = new RecipeFactory();
        $recipeView = new AddRecipeView($factory);
        return $this->mainView->render($recipeView);
    }
}
