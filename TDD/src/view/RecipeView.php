<?php

class RecipeView
{
    public function generateHTMLTitle(): string
    {
        return "<h1>Cook book</h1>";
    }

    public function generateFirstRecipeSection()
    {
        return '
        <input type="text" name="title" placeholder="Title" value=""/>
        <input type="text" name="author" placeholder="Author" value=""/>

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
    }
}
