<?php

class RecipeCollection
{
    private $recipes = array();

    public function getNumberOfRecipes(): int
    {
        return count($this->recipes);
    }
}
