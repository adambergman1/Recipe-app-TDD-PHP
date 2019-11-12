<?php

class Recipe
{
    private $title;
    private $ingredients = array();
    private $instructions = array();
    private $servings;
    private $tag;
    private $validTags = array("Breakfast", "Lunch", "Dinner");

    public function __construct(string $title)
    {
        $this->title = $this->setFirstCharacterToUppercase($title);
    }

    private function setFirstCharacterToUppercase(string $title): string
    {
        return ucfirst($title);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function addIngredient(Ingredient $ingredient): void
    {
        $this->ingredients[] = $ingredient;
    }

    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    public function addInstructions(InstructionsCollection $toBeSaved)
    {
        $this->instructions = $toBeSaved;
    }

    public function getInstructions()
    {
        return $this->instructions;
    }

    public function setServings(int $toBeSaved): void
    {
        $this->servings = $toBeSaved;
    }

    public function getServings(): int
    {
        return $this->servings;
    }

    public function setTagName(string $toBeSaved): void
    {
        if (!in_array($toBeSaved, $this->validTags)) {
            throw new IncorrectTagException();
        }

        $this->tag = $toBeSaved;
    }

    public function getTagName(): string
    {
        return $this->tag;
    }
}
