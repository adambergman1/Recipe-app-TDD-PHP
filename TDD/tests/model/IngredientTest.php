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
        $this->expectException(Exception::class);

        $input = 'This is veeeeery long ingredient that is not acceptable to our system';
        new Ingredient($input);
    }
}
