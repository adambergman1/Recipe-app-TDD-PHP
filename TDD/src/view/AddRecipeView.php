<?php

class AddRecipeView
{
    protected static $addRecipe = __CLASS__  . '::addRecipe';

    private static $title = "title";
    private static $author = "author";
    private static $servings = "servings";
    private static $tag = "tag";
    private static $ingredientName = "ingredient-name1";
    private static $ingredientAmount = "ingredient-amount1";
    private static $measurement = "measurement";
    private static $submitRecipe = "submitRecipe";

    private $factory;

    public function __construct($factory)
    {
        $this->factory = $factory;
    }

    public function generateOutput()
    {
        $response = "";
        if ($this->userWantsToAddRecipe()) {
            $response .= $this->renderAddRecipe();
        } else {
            $response .= $this->generateAddRecipeBtnForm();
        }

        return $response;
    }

    public function userWantsToAddRecipe(): bool
    {
        return isset($_POST[self::$addRecipe]);
    }

    public function generateAddRecipeBtnForm(): string
    {
        return '
        <form method="POST" class="add-recipe-btn-form">
            <input class="add-recipe-btn" type="submit" name="' . self::$addRecipe . '" value="Add Recipe!" />
        </form>
        ';
    }

    public function renderAddRecipe(): string
    {
        return file_get_contents(__DIR__ . "/partials/addRecipeForm.php");
    }

    public function createRecipe(): Recipe
    {
        $title = $this->getTitle();
        $recipe = $this->factory->instanciateRecipe($title);

        return $recipe;
    }

    public function getRecipe(): Recipe
    {
        $recipe = $this->createRecipe();
        $author = $this->getAuthor();
        $servings = $this->getServings();
        $tag = $this->getTag();
        $ingredient = $this->getIngredient();
        $recipe->setAuthor($author);
        $recipe->setServings($servings);
        $recipe->setTagName($tag);
        $recipe->addIngredient($ingredient);

        $instructions = $this->getInstructionsToRecipe();
        $recipe->addInstructions($instructions);

        return $recipe;
    }

    private function getTitle(): string
    {
        if (isset($_GET[self::$title]) && !empty($_GET[self::$title])) {
            return $_GET[self::$title];
        } else {
            throw new RecipeTitleMissingException();
        }
    }

    public function getAuthor(): string
    {
        if (isset($_GET[self::$author]) && !empty($_GET[self::$author])) {
            return $_GET[self::$author];
        } else {
            throw new AuthorMissingException();
        }
    }

    public function getServings(): int
    {
        if (isset($_GET[self::$servings]) && !empty($_GET[self::$servings])) {
            return $_GET[self::$servings];
        } else {
            throw new ServingsMissingException();
        }
    }

    public function getTag(): string
    {
        if (isset($_GET[self::$tag]) && !empty($_GET[self::$tag])) {
            return $_GET[self::$tag];
        } else {
            throw new TagMissingException();
        }
    }

    public function getIngredient(): Ingredient
    {
        $name = $this->getIngredientName();
        $amount = $this->getIngredientAmount();
        $measure = $this->getMeasurement();

        return $this->factory->instanciateIngredient($name, $amount, $measure);
    }

    private function getIngredientName(): string
    {
        if (isset($_GET[self::$ingredientName]) && !empty($_GET[self::$ingredientName])) {
            return $_GET[self::$ingredientName];
        } else {
            throw new IngredientNameMissingException();
        }
    }

    public function getInstructionsToRecipe(): InstructionsCollection
    {
        $collection = $this->factory->instanciateInstructionsCollection();
        $instructions = $this->getInstructions();

        foreach ($instructions as $instruction) {
            $collection->addInstruction($instruction);
        }

        return $collection;
    }

    public function getInstructions()
    {
        $count = $this->getInstructionRequestsCount();
        $instructions = array();

        for ($i = 1; $i <= $count; $i++) {
            $instruction = $_GET["instruction" . $i];
            $instructions[] = $this->addInstruction($instruction, $i);
        }

        return $instructions;
    }

    private function getInstructionRequestsCount()
    {
        $count = 0;
        for ($i = 1; $i < 10; $i++) {
            if (isset($_GET["instruction" . $i]) && !empty($_GET["instruction" . $i])) {
                $count++;
            }
        }
        return $count;
    }

    public function addInstruction($instruction, $index): Instruction
    {
        if (isset($_GET["instruction" . $index]) && !empty($_GET["instruction" . $index])) {
            return $this->factory->instanciateInstruction($instruction);
        } else {
            throw new InstructionMissingException();
        }
    }

    private function getIngredientAmount(): Amount
    {
        if (isset($_GET[self::$ingredientAmount]) && !empty($_GET[self::$ingredientAmount])) {
            $amount = (float) $_GET[self::$ingredientAmount];
            return $this->factory->instanciateAmount($amount);
        } else {
            throw new IngredientAmountMissingException();
        }
    }

    private function getMeasurement(): Measurement
    {
        if (isset($_GET[self::$measurement]) && !empty($_GET[self::$measurement])) {
            $measure = $_GET[self::$measurement];
            return $this->factory->instanciateMeasurement($measure);
        } else {
            throw new IngredientMeasurementMissingException();
        }
    }

    public function userWantsToSubmitRecipe(): bool
    {
        return isset($_GET[self::$submitRecipe]);
    }
}
