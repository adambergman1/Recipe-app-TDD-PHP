<?php

use PHPUnit\Framework\TestCase;

class RecipeViewTest extends TestCase
{
    protected $sut;

    public function setUp(): void
    {
        $this->sut = new RecipeView();
    }

    /** @test */
    public function shouldGenerateHtmlTitle()
    {
        $actual =   $this->sut->generateHTMLTitle();
        $expected = "<h2>Add recipe</h2>";

        $this->assertEquals($actual, $expected);
    }

    /** @test */
    public function shouldGenerateFirstRecipeSection()
    {
        $actual = $this->sut->generateFirstRecipeSection();
        $expected = '
        <input type="text" name="title" placeholder="Title"/>
        <input type="text" name="author" placeholder="Author"/>

        <label for="servings">Servings:</label>
        <select id="servings">
            <option value="two">2</option>
            <option value="four">4</option>
            <option value="six">6</option>
            <option value="eight">8</option>
            <option value="ten">10</option>
            <option value="twelve">12</option>
        </select>

        <label for="tag">Tag</label>
        <select id="tag">
            <option value="breakfast">Breakfast</option>
            <option value="lunch">Lunch</option>
            <option value="dinner">Dinner</option>
        </select>
        ';

        $this->assertEquals($actual, $expected);
    }

    /** @test */
    public function shouldGenerateIngredientInput()
    {
        $actual = $this->sut->generateIngredientInput();
        $expected = '
            <input type="text" name="ingredient" placeholder="Ingredient" />
            <input type="number" name="amount" placeholder="Amount" />

            <select name="measurement" id="measurement">
                <option value="dl">dl</option>
                <option value="kg">kg</option>
                <option value="g">g</option>
                <option value="cl">cl</option>
                <option value="tbsp">tbsp</option>
                <option value="tsp">tsp</option>
                <option value="ml">ml</option>
                <option value="l">l</option>
                <option value="hg">hg</option>
                <option value="pcs">pcs</option>
            </select>
        ';

        $this->assertEquals($actual, $expected);
    }

    /** @test */
    public function shouldGenerateInstructionInput()
    {
        $actual = $this->sut->generateInstructionInput();
        $expected = '
            <textarea name="instruction" id="instruction" placeholder="Write instructions, for example: Set the oven to 200 degrees" rows="3"></textarea>
        ';

        $this->assertEquals($actual, $expected);
    }

    /** @test */
    public function shouldGenerateFormStart()
    {
        $actual = $this->sut->generateFormStart();
        $expected = '
            <form method="get" class="add-recipe-form">
        ';

        $this->assertEquals($actual, $expected);
    }

    /** @test */
    public function shouldGenerateFormEnd()
    {
        $actual = $this->sut->generateFormEnd();
        $expected = '</form>';

        $this->assertEquals($actual, $expected);
    }

    /** @test */
    public function shouldCallMethodsInsideGenerateoutput()
    {
        $mock = $this->getMockBuilder(RecipeView::class)
            ->setMethods([
                'generateHTMLTitle',
                'generateFormStart',
                'generateFirstRecipeSection',
                'generateIngredientInput',
                'generateAddIngredientButton',
                'generateInstructionInput',
                'generateAddRecipeButton',
                'generateFormEnd'
            ])
            ->getMock();

        $mock->expects($this->once())->method('generateHTMLTitle');
        $mock->expects($this->once())->method('generateFormStart');
        $mock->expects($this->once())->method('generateFirstRecipeSection');
        $mock->expects($this->once())->method('generateIngredientInput');
        $mock->expects($this->once())->method('generateAddIngredientButton');
        $mock->expects($this->once())->method('generateInstructionInput');
        $mock->expects($this->once())->method('generateAddRecipeButton');
        $mock->expects($this->once())->method('generateFormEnd');

        $mock->generateOutput();
    }

    /** @test */
    public function shouldGenerateAddRecipeButton()
    {
        $actual = $this->sut->generateAddRecipeButton();
        $expected = '<input type="submit" name="submit" value="Add recipe"/>';

        $this->assertEquals($actual, $expected);
    }

    /** @test */
    public function shouldBeAbleToAddMoreIngredients()
    {
        $actual = $this->sut->generateAddIngredientButton();
        $expected = '<input class="add-ingredient-btn" type="button" value="+"/>';

        $this->assertEquals($actual, $expected);
    }

    /** @test */
    public function shouldRespondIfUserWantsToAddIngredient()
    {
        $mock = $this->getMockBuilder(RecipeView::class)
            ->setMethods([
                'userWantsToAddIngredient',
            ])
            ->getMock();

        $mock->method('userWantsToAddIngredient')->willReturn(true);

        $actual = $mock->userWantsToAddIngredient();

        $this->assertTrue($actual);
    }
}
