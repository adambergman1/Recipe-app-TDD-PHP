<?php

use PHPUnit\Framework\TestCase;

class RecipeCollectionTest extends TestCase
{
    /** @test */
    public function shouldReturnNumberOfRecipes()
    {
        $sut = new RecipeCollection();
        $actual = $sut->getNumberOfRecipes();

        $expected = 0;

        $this->assertEquals($expected, $actual);
    }
}
