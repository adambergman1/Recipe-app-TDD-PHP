<?php

use PHPUnit\Framework\TestCase;

class IngredientTest extends TestCase
{
    /** @test */
    function shouldAcceptIngredient()
    {
        $input = 'Flour';
        $sut = new Ingredient($input);
        $actual = $sut->getIngredient();

        $expected = 'Flour';

        $this->assertEquals($actual, $expected);
    }
}
