<?php

class AddRecipeView
{
    protected static $addRecipe = __CLASS__  . 'addRecipe';

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
        $title = $this->getTitle();
        return new Recipe($title);
    }

    private function getTitle()
    {
        if (isset($_GET["title"]) && !empty($_GET["title"])) {
            return $_GET["title"];
        } else {
            throw new RecipeTitleMissingException();
        }
    }

    public function addAuthor(): string
    {
        if (isset($_GET["author"]) && !empty($_GET["author"])) {
            return $_GET["author"];
        } else {
            throw new AuthorMissingException();
        }
    }

    public function addServings(): int
    {
        return $_GET["servings"];
    }
}
