<?php

class RecipeFactory
{
    public function instanciateInstruction(string $instruction)
    {
        require_once("Instruction.php");
        return new Instruction($instruction);
    }

    public function instanciateRecipe(string $title)
    {
        require_once("Recipe.php");
        return new Recipe($title);
    }

    public function instanciateIngredient(string $name, Amount $amount = null, Measurement $measure = null)
    {
        require_once("Ingredient.php");
        return new Ingredient($name, $amount, $measure);
    }

    public function instanciateAmount(float $amount)
    {
        require_once("Amount.php");
        return new Amount($amount);
    }

    public function instanciateMeasurement(string $measure)
    {
        require_once("Measurement.php");
        return new Measurement($measure);
    }

    public function instanciateInstructionsCollection()
    {
        require_once("InstructionsCollection.php");
        return new InstructionsCollection();
    }
}
