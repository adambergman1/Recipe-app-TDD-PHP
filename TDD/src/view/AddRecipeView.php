<?php

class AddRecipeView
{
    private static $addRecipe = __CLASS__  . 'addRecipe';
    private $title = "";

    public function generateOutput(): void
    {
        if ($this->userWantsToAddRecipe()) {
            $this->renderAddRecipe();
        } else {
            echo $this->generateAddRecipeBtnForm();
        }
    }

    public function userWantsToAddRecipe(): bool
    {
        return isset($_POST[self::$addRecipe]);
    }

    private function generateAddRecipeBtnForm(): string
    {
        return '
        <form method="POST">
            <input type="submit" name="' . self::$addRecipe . '" value="Add Recipe!" />
        </form>
        ';
    }

    public function renderAddRecipe(): bool
    {
        return include_once("partials/addRecipeForm.php");
    }

    public function addRecipe(): Recipe
    {
        if (!empty($_GET["title"])) {
            $this->title = $_GET["title"];
        } else {
            $this->title = "none";
        }
        return new Recipe($this->title);
    }
}
