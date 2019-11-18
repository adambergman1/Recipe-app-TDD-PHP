<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');

require_once("view/AddRecipeView.php");
require_once("model/RecipeFactory.php");

$view = new AddRecipeView(new RecipeFactory());
$view->generateOutput();

// $view->addRecipe();
