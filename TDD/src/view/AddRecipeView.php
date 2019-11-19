<?php

class AddRecipeView
{
    protected static $addRecipe = __CLASS__  . 'addRecipe';

    private static $title = "title";
    private static $author = "author";
    private static $servings = "servings";
    private static $tag = "tag";
    private static $ingredientName = "ingredient-name1";
    private static $ingredientAmount = "ingredient-amount1";
    private static $measurement = "measurement";
    private static $instruction = "instruction1";
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
        <form method="POST">
            <input type="submit" name="' . self::$addRecipe . '" value="Add Recipe!" />
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
        $author = $this->addAuthor();
        $servings = $this->addServings();
        $tag = $this->addTag();
        $ingredient = $this->addIngredient();
        $recipe->setAuthor($author);
        $recipe->setServings($servings);
        $recipe->setTagName($tag);
        $recipe->addIngredient($ingredient);

        $instructions = $this->factory->instanciateInstructionsCollection();
        $instructions->addInstruction($this->addInstruction());

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

    public function addAuthor(): string
    {
        if (isset($_GET[self::$author]) && !empty($_GET[self::$author])) {
            return $_GET[self::$author];
        } else {
            throw new AuthorMissingException();
        }
    }

    public function addServings(): int
    {
        if (isset($_GET[self::$servings]) && !empty($_GET[self::$servings])) {
            return $_GET[self::$servings];
        } else {
            throw new ServingsMissingException();
        }
    }

    public function addTag(): string
    {
        if (isset($_GET[self::$tag]) && !empty($_GET[self::$tag])) {
            return $_GET[self::$tag];
        } else {
            throw new TagMissingException();
        }
    }

    public function addIngredient(): Ingredient
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

    public function addInstruction(): Instruction
    {
        if (isset($_GET[self::$instruction]) && !empty($_GET[self::$instruction])) {
            $instruction = $_GET[self::$instruction];
            return $this->factory->instanciateInstruction($instruction);
        } else {
            throw new InstructionMissingException();
        }
    }

    public function userWantsToSubmitRecipe(): bool
    {
        return isset($_GET[self::$submitRecipe]);
    }
}
