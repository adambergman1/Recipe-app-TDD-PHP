<?php

use PHPUnit\Framework\TestCase;

class AddRecipeViewTest extends TestCase
{
    protected $sut;

    public function setUp(): void
    {
        $this->sut = new AddRecipeView();
    }

    /** @test */
    public function shouldRespondIfUserWantsToAddRecipe()
    {
        $mock = $this->getMockBuilder(AddRecipeView::class)
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
        $_GET["title"] = 'Hello';
        $actual = $this->sut->addRecipe();
        $this->assertInstanceOf(Recipe::class, $actual);
        $_GET["title"] = "";
    }

    /** @test */
    public function shouldThrowExceptionTitleIsEmpty()
    {
        $_GET["title"] = "";
        $this->expectException(RecipeTitleMissingException::class);
        $this->sut->addRecipe();
    }

    /** @test */
    public function shouldAddAuthor()
    {
        $_GET["author"] = "Per Morberg";

        $actual = $this->sut->addAuthor();
        $expected = "Per Morberg";

        $this->assertEquals($actual, $expected);

        $_GET["author"] = "";
    }

    /** @test */
    public function shouldThrowExceptionAuthorIsEmpty()
    {
        $_GET["author"] = "";
        $this->expectException(AuthorMissingException::class);
        $this->sut->addAuthor();
    }

    /** @test */
    public function shouldAddServings()
    {
        $_GET["servings"] = "4";

        $actual = $this->sut->addServings();
        $expected = 4;

        $this->assertEquals($actual, $expected);

        $_GET["servings"] = "";
    }

    /** @test */
    public function shouldThrowExceptionServingsMissing()
    {
        $_GET["servings"] = "";
        $this->expectException(ServingsMissingException::class);
        $this->sut->addServings();
    }

    /** @test */
    public function shouldAddTagLunch()
    {
        $_GET["tag"] = "Lunch";

        $actual = $this->sut->addTag();
        $expected = "Lunch";

        $this->assertEquals($actual, $expected);

        $_GET["tag"] = "";
    }

    /** @test */
    public function shouldThrowExceptionTagMissing()
    {
        $_GET["tag"] = "";
        $this->expectException(TagMissingException::class);
        $this->sut->addTag();
    }

    /** @test */
    public function shouldAddIngredient()
    {
        $_GET["ingredient-name1"] = "Potatoes";
        $_GET["ingredient-amount1"] = 2.0;
        $_GET["measurement"] = "dl";

        $actual = $this->sut->addIngredient();

        $this->assertInstanceOf(Ingredient::class, $actual);

        $_GET["ingredient-name1"] = "";
        $_GET["ingredient-amount1"] = "";
        $_GET["measurement"] = "";
    }
}
