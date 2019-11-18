<?php

require_once(__DIR__ . '/../view/MainView.php');

class MainController
{
    private $factory;
    private $mainView;
    private $recipeView;

    public function __construct()
    {
        $this->factory = new RecipeFactory();
        $this->mainView = new MainView();
        $this->recipeView = new AddRecipeView($this->factory);
    }

    public function run()
    {
        return $this->mainView->render($this->recipeView);
    }
}
