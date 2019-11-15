<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');

require_once("view/AddRecipeView.php");
require_once("model/RecipeFactory.php");
// ob_start();
$view = new AddRecipeView(new RecipeFactory());
$view->generateOutput();
// $content = ob_get_contents();
// ob_end_flush();

// var_dump($content);
// var_dump($view->userWantsToAddIngredient());
