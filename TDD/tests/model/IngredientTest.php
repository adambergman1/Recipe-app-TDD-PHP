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
    function shouldThrowExceptionOnIngredientLongerThan60Characters()
    {
        $this->expectException(TooLongIngredientException::class);

        $input = 'This is a veeeeery long ingredient that is not acceptable to our system';
        new Ingredient($input);
    }

    /** @test */
    function shouldThrowExceptionOnIngredientShorterThan2Characters()
    {
        $this->expectException(TooShortIngredientException::class);

        $input = 'Pe';
        new Ingredient($input);
    }

    /** @test */
    function shouldThrowExceptionOnIngredientIncludingNumbers()
    {
        $this->expectException(IngredientContainsNumbersException::class);

        $input = '3 milk products';
        new Ingredient($input);
    }
}
