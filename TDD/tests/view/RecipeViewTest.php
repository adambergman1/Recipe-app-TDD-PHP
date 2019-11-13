<?php

use PHPUnit\Framework\TestCase;

class RecipeViewTest extends TestCase
{
    /** @test */
    public function shouldGenerateHtmlTitle()
    {
        $sut = new RecipeView();
        $actual =   $sut->generateHTMLTitle();
        $expected = "<h1>Cook book</h1>";

        $this->assertEquals($actual, $expected);
    }

    /** @test */
    public function shouldGenerateFirstRecipeSection()
    {
        $sut = new RecipeView();
        $actual = $sut->generateFirstRecipeSection();
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
}
