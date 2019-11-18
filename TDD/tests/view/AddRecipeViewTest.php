<?php

use PHPUnit\Framework\TestCase;

class AddRecipeViewTest extends TestCase
{
    protected $sut;
    protected $factoryMock;

    public function setUp(): void
    {
        $this->factoryMock = $this->getMockBuilder(RecipeFactory::class)
            ->setMethods(['instanciateInstruction', 'instanciateRecipe', 'instanciateIngredient'])
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
        $this->expectOutputRegex('/form method="POST"/');
        $this->sut->generateOutput();
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
    public function shouldCallOnIncludeOnce()
    {
        $actual = $this->sut->renderAddRecipe();
        $expected = true;

        $this->assertEquals($actual, $expected);
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

        $actual = $this->sut->addAuthor();
        $expected = "Per Morberg";

        $this->assertEquals($actual, $expected);
    }

    /** @test */
    public function shouldThrowExceptionAuthorIsEmpty()
    {
        $this->setGETRequestTo("author");

        $this->expectException(AuthorMissingException::class);
        $this->sut->addAuthor();
    }

    /** @test */
    public function shouldAddServings()
    {
        $this->setGETRequestTo("servings", "4");

        $actual = $this->sut->addServings();
        $expected = 4;

        $this->assertEquals($actual, $expected);
    }

    /** @test */
    public function shouldThrowExceptionServingsMissing()
    {
        $this->setGETRequestTo("servings");

        $this->expectException(ServingsMissingException::class);
        $this->sut->addServings();
    }

    /** @test */
    public function shouldAddTagLunch()
    {
        $this->setGETRequestTo("tag", "Lunch");

        $actual = $this->sut->addTag();
        $expected = "Lunch";

        $this->assertEquals($actual, $expected);
    }

    /** @test */
    public function shouldThrowExceptionTagMissing()
    {
        $this->setGETRequestTo("tag");

        $this->expectException(TagMissingException::class);
        $this->sut->addTag();
    }

    /** @test */
    public function shouldAddIngredient()
    {
        $ingredient = $this->createMock(Ingredient::class);
        $this->factoryMock->method('instanciateIngredient')->willReturn($ingredient);

        $this->setGETRequestTo("ingredient-name1", "Potatoes");
        $this->setGETRequestTo("ingredient-amount1", 2);
        $this->setGETRequestTo("measurement", "dl");

        $actual = $this->sut->addIngredient();

        $this->assertInstanceOf(Ingredient::class, $actual);
    }

    /** @test */
    public function shouldThrowExceptionOnEmptyIngredientName()
    {
        $this->expectException(IngredientNameMissingException::class);

        $this->setGETRequestTo("ingredient-name1");
        $this->setGETRequestTo("ingredient-amount1", 2);
        $this->setGETRequestTo("measurement", "dl");

        $this->sut->addIngredient();
    }

    /** @test */
    public function shouldThrowExceptionOnEmptyIngredientAmount()
    {
        $this->expectException(IngredientAmountMissingException::class);

        $this->setGETRequestTo("ingredient-name1", "Potatoes");
        $this->setGETRequestTo("ingredient-amount1");
        $this->setGETRequestTo("measurement", "dl");

        $this->sut->addIngredient();
    }

    /** @test */
    public function shouldThrowExceptionOnEmptyIngredientMeasurement()
    {
        $this->expectException(IngredientMeasurementMissingException::class);
        $this->setGETRequestTo("ingredient-name1", "Potatoes");
        $this->setGETRequestTo("ingredient-amount1", 2);
        $this->setGETRequestTo("measurement");

        $this->sut->addIngredient();
    }

    /** @test */
    public function shouldAddInstruction()
    {
        $instruct = $this->createMock(Instruction::class);
        $this->factoryMock->method('instanciateInstruction')->willReturn($instruct);


        $this->setGETRequestTo("instruction1", "This is the first instruction");

        $actual = $this->sut->addInstruction();

        $this->assertInstanceOf(Instruction::class, $actual);
    }

    /** @test */
    public function shouldThrowExceptionOnEmptyInstruction()
    {
        $this->expectException(InstructionMissingException::class);
        $this->setGETRequestTo("instruction1");

        $this->sut->addInstruction();
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

        $actual = $this->sut->addRecipeValues();

        $this->assertInstanceOf(Recipe::class, $actual);
    }

    /** @test */
    public function shouldCallOnAddRecipeValues()
    {
        $this->setRecipeValues();

        $mock = $this->getMockBuilder(AddRecipeView::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'userWantsToSubmitRecipe',
                'addRecipeValues'
            ])
            ->getMock();

        $mock->method('userWantsToSubmitRecipe')->willReturn(true);

        $mock->expects($this->once())->method('addRecipeValues');

        $mock->generateOutput();
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
        $this->setGETRequestTo("measurement", "pcs");
        $this->setGETRequestTo("instruction1", "This is the first instruction...");
    }
}
