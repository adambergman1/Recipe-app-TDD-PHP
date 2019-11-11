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

    /** @test */
    function shouldThrowExceptionOnIngredientLongerThan20Characters()
    {
        $this->expectException(Exception::class);

        $input = 'This is my very looong ingredient';
        new Ingredient($input);
    }
}
