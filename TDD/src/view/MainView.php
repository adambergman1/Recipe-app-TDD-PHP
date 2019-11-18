<?php

class MainView
{
    public function generateMainTitle()
    {
        return '<h1>My Cook Book</h1>';
    }

    public function render()
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
            </div>
           </body>
        </html>
      ';
    }
}
