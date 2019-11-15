<?php

class AddRecipeView
{
    protected static $addRecipe = __CLASS__  . 'addRecipe';
    private $factory;

    public function __construct($factory)
    {
        $this->factory = $factory;
    }

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
        return $this->factory->instanciateRecipe($title);
        // return new Recipe($title);
    }

    private function getTitle(): string
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
        if (isset($_GET["servings"]) && !empty($_GET["servings"])) {
            return $_GET["servings"];
        } else {
            throw new ServingsMissingException();
        }
    }

    public function addTag(): string
    {
        if (isset($_GET["tag"]) && !empty($_GET["tag"])) {
            return $_GET["tag"];
        } else {
            throw new TagMissingException();
        }
    }

    public function addIngredient(): Ingredient
    {
        $name = $this->getIngredientName();
        $amount = $this->getIngredientAmount();
        $measure = $this->getMeasurement();

        // return new Ingredient($name, $amount, $measure);
        return $this->factory->instanciateIngredient($name, $amount, $measure);
    }

    private function getIngredientName(): string
    {
        if (isset($_GET["ingredient-name1"]) && !empty($_GET["ingredient-name1"])) {
            return $_GET["ingredient-name1"];
        } else {
            throw new IngredientNameMissingException();
        }
    }

    private function getIngredientAmount(): Amount
    {
        if (isset($_GET["ingredient-amount1"]) && !empty($_GET["ingredient-amount1"])) {
            $amount = (float) $_GET["ingredient-amount1"];
            return $this->factory->instanciateAmount($amount);
            // return new Amount($amount);
        } else {
            throw new IngredientAmountMissingException();
        }
    }

    private function getMeasurement(): Measurement
    {
        if (isset($_GET["measurement"]) && !empty($_GET["measurement"])) {
            $measure = $_GET["measurement"];
            return $this->factory->instanciateMeasurement($measure);
            // return new Measurement($measure);
        } else {
            throw new IngredientMeasurementMissingException();
        }
    }

    public function addInstruction()
    {
        if (isset($_GET["instruction1"]) && !empty($_GET["instruction1"])) {
            $instruction = $_GET["instruction1"];
            // return new Instruction($instruction);
            return $this->factory->instanciateInstruction($instruction);
        } else {
            throw new InstructionMissingException();
        }
    }
}
