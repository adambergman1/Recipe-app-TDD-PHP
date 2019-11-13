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
    }

    public function generateIngredientInput()
    {
        return '
            <input type="text" name="ingredient" placeholder="Ingredient" value="" />
            <input type="number" name="amount" placeholder="Amount" value="" />

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
    }
}
