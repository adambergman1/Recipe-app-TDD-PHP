<?php

use PHPUnit\Framework\TestCase;

class AddRecipeViewTest extends TestCase
{
    protected $sut;
    protected $factoryMock;

    public function setUp(): void
    {
        $this->factoryMock = $this->getMockBuilder(RecipeFactory::class)
            ->setMethods([
                'instanciateInstruction',
                'instanciateRecipe',
                'instanciateIngredient',
                'instanciateInstructionsCollection',
                'instanciateAmount',
                'instanciateMeasurement'
            ])
            ->getMock();

        $this->sut = new AddRecipeView($this->factoryMock);
    }

    /** @after */
    public function unsetGETRequest()
    {
        unset($_GET);
    }

    /** @test */
    public function shouldRespondIfUserWantsToAddRecipe()
    {
        $mock = $this->getMockBuilder(AddRecipeView::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'userWantsToAddRecipe',
            ])
            ->getMock();

        $mock->method('userWantsToAddRecipe')->willReturn(true);

        $actual = $mock->userWantsToAddRecipe();

        $this->assertTrue($actual);
    }

    /** @test */
    public function shouldRespondFalseOnEmptyPost()
    {
        $actual = $this->sut->userWantsToAddRecipe();

        $this->assertFalse($actual);
    }

    /** @test */
    public function shouldIncludeForm()
    {
        $actual = $this->sut->generateOutput();

        $this->assertStringContainsString('form method="POST', $actual);
    }

    /** @test */
    public function shouldCallOnRenderAddRecipe()
    {
        $mock = $this->getMockBuilder(AddRecipeView::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'userWantsToAddRecipe',
                'renderAddRecipe'
            ])
            ->getMock();

        $mock->method('userWantsToAddRecipe')->willReturn(true);

        $mock->expects($this->once())->method('renderAddRecipe');

        $mock->generateOutput();
    }

    /** @test */
    public function shouldNotCallOnRenderAddRecipe()
    {
        $mock = $this->getMockBuilder(AddRecipeView::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'userWantsToAddRecipe',
                'renderAddRecipe'
            ])
            ->getMock();

        $mock->method('userWantsToAddRecipe')->willReturn(false);

        $mock->expects($this->never())->method('renderAddRecipe');

        $mock->generateOutput();
    }

    /** @test */
    public function shouldRenderAddRecipeForm()
    {
        $actual = $this->sut->renderAddRecipe();

        $this->assertStringContainsString('Add recipe', $actual);
    }

    /** @test */
    public function shouldReturnRecipeWithTitleHello()
    {
        $recipe = $this->createMock(Recipe::class);
        $this->factoryMock->method('instanciateRecipe')->willReturn($recipe);

        $this->setGETRequestTo("title", "Hello");

        $actual = $this->sut->createRecipe();
        $this->assertInstanceOf(Recipe::class, $actual);
    }

    /** @test */
    public function shouldThrowExceptionTitleIsEmpty()
    {
        $this->setGETRequestTo("title");

        $this->expectException(RecipeTitleMissingException::class);
        $this->sut->createRecipe();
    }

    /** @test */
    public function shouldAddAuthor()
    {
        $this->setGETRequestTo("author", "Per Morberg");

        $actual = $this->sut->getAuthor();
        $expected = "Per Morberg";

        $this->assertEquals($actual, $expected);
    }

    /** @test */
    public function shouldThrowExceptionAuthorIsEmpty()
    {
        $this->setGETRequestTo("author");

        $this->expectException(AuthorMissingException::class);
        $this->sut->getAuthor();
    }

    /** @test */
    public function shouldAddServings()
    {
        $this->setGETRequestTo("servings", "4");

        $actual = $this->sut->getServings();
        $expected = 4;

        $this->assertEquals($actual, $expected);
    }

    /** @test */
    public function shouldThrowExceptionServingsMissing()
    {
        $this->setGETRequestTo("servings");

        $this->expectException(ServingsMissingException::class);
        $this->sut->getServings();
    }

    /** @test */
    public function shouldAddTagLunch()
    {
        $this->setGETRequestTo("tag", "Lunch");

        $actual = $this->sut->getTag();
        $expected = "Lunch";

        $this->assertEquals($actual, $expected);
    }

    /** @test */
    public function shouldThrowExceptionTagMissing()
    {
        $this->setGETRequestTo("tag");

        $this->expectException(TagMissingException::class);
        $this->sut->getTag();
    }

    /** @test */
    public function shouldAddIngredient()
    {
        $ingredient = $this->createMock(Ingredient::class);
        $this->factoryMock->method('instanciateIngredient')->willReturn($ingredient);

        $amount = $this->createMock(Amount::class);
        $this->factoryMock->method('instanciateAmount')->willReturn($amount);

        $measure = $this->createMock(Measurement::class);
        $this->factoryMock->method('instanciateMeasurement')->willReturn($measure);

        $this->setGETRequestTo("ingredient-name1", "Potatoes");
        $this->setGETRequestTo("ingredient-amount1", 2);
        $this->setGETRequestTo("ingredient-measurement1", "dl");

        $actual = $this->sut->getIngredient();

        $this->assertInstanceOf(Ingredient::class, $actual);
    }

    /** @test */
    public function shouldThrowExceptionOnEmptyIngredientName()
    {
        $this->expectException(IngredientNameMissingException::class);

        $this->setGETRequestTo("ingredient-name1");
        $this->setGETRequestTo("ingredient-amount1", 2);
        $this->setGETRequestTo("ingredient-measurement1", "dl");

        $this->sut->getIngredient();
    }

    /** @test */
    public function shouldThrowExceptionOnEmptyIngredientAmount()
    {
        $this->expectException(IngredientAmountMissingException::class);

        $this->setGETRequestTo("ingredient-name1", "Potatoes");
        $this->setGETRequestTo("ingredient-amount1");
        $this->setGETRequestTo("ingredient-measurement1", "dl");

        $this->sut->getIngredient();
    }

    /** @test */
    public function shouldThrowExceptionOnEmptyIngredientMeasurement()
    {
        $this->expectException(IngredientMeasurementMissingException::class);

        $ingredient = $this->createMock(Ingredient::class);
        $this->factoryMock->method('instanciateIngredient')->willReturn($ingredient);

        $amount = $this->createMock(Amount::class);
        $this->factoryMock->method('instanciateAmount')->willReturn($amount);

        $measure = $this->createMock(Measurement::class);
        $this->factoryMock->method('instanciateMeasurement')->willReturn($measure);


        $this->setGETRequestTo("ingredient-name1", "Potatoes");
        $this->setGETRequestTo("ingredient-amount1", 2);
        $this->setGETRequestTo("ingredient-measurement1");

        $this->sut->getIngredient();
    }

    /** @test */
    public function shouldAddInstruction()
    {
        $instruct = $this->createMock(Instruction::class);
        $this->factoryMock->method('instanciateInstruction')->willReturn($instruct);

        $this->setGETRequestTo("instruction1", "This is the first instruction");

        $actual = $this->sut->addInstruction("instruction", 1);

        $this->assertInstanceOf(Instruction::class, $actual);
    }

    /** @test */
    public function shouldThrowExceptionOnEmptyInstruction()
    {
        $this->expectException(InstructionMissingException::class);
        $this->setGETRequestTo("instruction1");

        $this->sut->addInstruction("instruction", 1);
    }

    /** @test */
    public function shouldReturnTrueWhenSubmitRecipeIsSet()
    {
        $this->setGETRequestTo("submitRecipe", "");
        $actual = $this->sut->userWantsToSubmitRecipe();
        $expected = true;

        $this->assertEquals($actual, $expected);
    }

    /** @test */
    public function shouldReturnACompleteRecipe()
    {
        $this->setRecipeValues();

        $recipe = $this->createMock(Recipe::class);
        $this->factoryMock->method('instanciateRecipe')->willReturn($recipe);

        $ingredient = $this->createMock(Ingredient::class);
        $this->factoryMock->method('instanciateIngredient')->willReturn($ingredient);

        $amount = $this->createMock(Amount::class);
        $this->factoryMock->method('instanciateAmount')->willReturn($amount);

        $measure = $this->createMock(Measurement::class);
        $this->factoryMock->method('instanciateMeasurement')->willReturn($measure);

        $instruction = $this->createMock(Instruction::class);
        $this->factoryMock->method('instanciateInstruction')->willReturn($instruction);
        $instruction->method('getInstruction')->willReturn('This is the first instruction.');

        $instructionsCollection = $this->createMock(InstructionsCollection::class);
        $instructionsCollection->method('getInstructions')->willReturn([$instruction]);
        $this->factoryMock->method('instanciateInstructionsCollection')->willReturn($instructionsCollection);

        $actual = $this->sut->getRecipe();

        $this->assertInstanceOf(Recipe::class, $actual);
    }

    /** @test */
    function shouldReturn4Instructions()
    {
        $this->setGETRequestTo("instruction1", "first instruction");
        $this->setGETRequestTo("instruction2", "second instruction");
        $this->setGETRequestTo("instruction3", 'third instruction');
        $this->setGETRequestTo("instruction4", 'fourth instruction');

        $instruction = $this->createMock(Instruction::class);
        $this->factoryMock->method('instanciateInstruction')->willReturn($instruction);

        $actual = $this->sut->getInstructions();
        $expected = 4;

        $this->assertEquals(count($actual), $expected);
    }

    /** @test */
    function shouldReturn4Ingredients()
    {
        $this->setGETRequestTo("ingredient-name1", "Potatoes");
        $this->setGETRequestTo("ingredient-amount1", "5.0");
        $this->setGETRequestTo("ingredient-measurement1", "pcs");

        $this->setGETRequestTo("ingredient-name2", "Paprika");
        $this->setGETRequestTo("ingredient-amount2", "3");
        $this->setGETRequestTo("ingredient-measurement2", "kg");

        $this->setGETRequestTo("ingredient-name3", "Onion");
        $this->setGETRequestTo("ingredient-amount3", "10");
        $this->setGETRequestTo("ingredient-measurement3", "pcs");

        $this->setGETRequestTo("ingredient-name4", "Milk");
        $this->setGETRequestTo("ingredient-amount4", "1");
        $this->setGETRequestTo("ingredient-measurement4", "dl");

        $ingredient = $this->createMock(Ingredient::class);

        $this->factoryMock->method('instanciateIngredient')->willReturn($ingredient);

        $amount = $this->createMock(Amount::class);
        $measure = $this->createMock(Measurement::class);

        $this->factoryMock->method('instanciateAmount')->willReturn($amount);
        $this->factoryMock->method('instanciateMeasurement')->willReturn($measure);

        $actual = $this->sut->getIngredients();
        $expected = 4;

        $this->assertEquals(count($actual), $expected);
    }

    private function setGETRequestTo(string $request, $value = null)
    {
        $_GET[$request] = $value;
    }

    private function setRecipeValues()
    {
        $this->setGETRequestTo("title", "My new recipe");
        $this->setGETRequestTo("author", "Wilhelm Moberg");
        $this->setGETRequestTo("servings", "2");
        $this->setGETRequestTo("tag", "breakfast");
        $this->setGETRequestTo("ingredient-name1", "Potatoes");
        $this->setGETRequestTo("ingredient-amount1", "9");
        $this->setGETRequestTo("ingredient-measurement1", "pcs");
        $this->setGETRequestTo("instruction1", "This is the first instruction...");
    }
}
