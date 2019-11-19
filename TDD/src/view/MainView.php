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

    $output = "";
    foreach ($collection->getRecipes() as $recipe) {
      $output .= "<div class='recipe'>";
      $output .= '<div class="recipe-title">' . $recipe->getTitle() . '</div>';

      $output .= "</div>";
    }

    return $output;
  }
}
