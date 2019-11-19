<?php

class MainView
{
  private $recipes;

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
    return $collection;
  }
}
