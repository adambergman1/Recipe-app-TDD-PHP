<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');

require_once("view/MainView.php");
require_once("view/AddRecipeView.php");

require_once("model/RecipeFactory.php");

require_once("controller/MainController.php");

$app = new MainController();
echo $app->run();


// $view->addRecipe();
