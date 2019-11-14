<?php

class AddRecipeView
{
    private static $addRecipe = __CLASS__  . 'addRecipe';

    public function generateOutput(): void
    {
        $ret = $this->generateAddRecipeBtnForm();

        echo $ret;
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
}
