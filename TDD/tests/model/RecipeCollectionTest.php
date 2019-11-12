<?php

use PHPUnit\Framework\TestCase;

class RecipeCollectionTest extends TestCase
{
    /** @test */
    public function shouldReturnNumberOfRecipes()
    {
        $sut = new RecipeCollection();
        $actual = $sut->getNumRecipes();

        $expected = 0;

        $this->assertCount($expected, $actual);
    }
}
