<?php

class AddRecipeView
{
    private static $addRecipe = __CLASS__  . 'addRecipe';

    public function generateOutput(): void
    {
        $ret = '';
        echo $ret;
    }

    public function userWantsToAddRecipe(): bool
    {
        return isset($_POST[self::$addRecipe]);
    }
}
