<?php

class MainView
{

    public function generateMainTitle()
    {
        return '<h1>My Cook Book</h1>';
    }

    public function render($view, $collection = null)
    {
        return '<!DOCTYPE html>
        <html lang="en">
          <head>
            <meta charset="utf-8">
            <title>Cook Book</title>
            <link rel="stylesheet" href="view/partials/style.css" type="text/css" media="all">
            <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">
          </head>
          <body>
            ' . $this->generateMainTitle() . '
            <div class="container">
            ' . $view->generateOutput() . '
            ' . $this->renderRecipes($collection) . '
            </div>
           </body>
        </html>
      ';
    }

    public function renderRecipes($collection)
    {
        if ($collection == null || empty($collection->getRecipes())) {
            return '<p>No recipes</p>';
        }

        $output = "<h2>Recipes</h2>";
        foreach ($collection->getRecipes() as $recipe) {
            $output .= "<div class='recipe'>";
            $output .= '<div class="recipe-title">' . $recipe->getTitle() . '</div>';
            $output .= '<div class="recipe-author">By ' . $recipe->getAuthor() . '</div>';
            $output .= '<div class="recipe-servings">Servings: ' . $recipe->getServings() . '</div>';
            $output .= '<div class="recipe-tag">Tag: ' . $recipe->getTagName() . '</div>';
            $output .= '<h4 class="ingredients-title">Ingredients</h4>';
            $output .= '<div class="recipe-ingredients">' . $this->renderIngredients($recipe->getIngredients()) . '</div>';
            $output .= '<h4 class="instructions-title">Instructions</h4>';
            $output .= '<div class="recipe-instructions">' . $this->renderInstructions($recipe->getInstructions()) . '</div>';
            $output .= "</div>";
        }

        return $output;
    }

    public function renderIngredients(array $ingredients)
    {
        $output = '';
        $index = 0;
        foreach ($ingredients as $ing) {
            $index++;
            $output .= '<div class="ingredient" id="ingredient-' . $index . '">';
            $output .= '<span class="ingredient-amount">' . $ing->getAmount() . '</span>';
            $output .= '<span class="ingredient-measurement">' . $ing->getMeasurement() . '</span>';
            $output .= '<span class="ingredient-name">' . $ing->getName() . '</span>';
            $output .= '</div>';
        }

        return $output;
    }

    public function renderInstructions(InstructionsCollection $instructions)
    {
        $output = '';
        $index = 0;

        foreach ($instructions->getInstructions() as $instruction) {
            $index++;
            $output .= '<div class="instruction" id="instruction-' . $index . '">';
            $output .= '<p class="instruction-text">' . $instruction->getInstruction() . '</p>';
            $output .= '</div>';
        }

        return $output;
    }
}
