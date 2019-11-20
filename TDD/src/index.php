<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');

require_once 'view/MainView.php';
require_once 'view/AddRecipeView.php';

require_once 'model/RecipeFactory.php';
require_once 'model/Exceptions.php';
require_once 'model/RecipeCollection.php';

require_once 'model/Amount.php';
require_once 'model/Recipe.php';
require_once 'model/Ingredient.php';
require_once 'model/Measurement.php';
require_once 'model/Instruction.php';
require_once 'model/InstructionsCollection.php';

require_once 'controller/MainController.php';

// session_start();

$factory = new RecipeFactory();
$mainView = new MainView();
$recipeView = new AddRecipeView($factory);
$recipeCollection = new RecipeCollection();

$app = new MainController($mainView, $recipeView, $recipeCollection);
echo $app->run();
