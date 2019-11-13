<?php

use PHPUnit\Framework\TestCase;

class RecipeViewTest extends TestCase
{
    /** @test */
    public function generateHtmlTitleShouldReturnTitle()
    {
        $sut = new RecipeView();
        $actual =   $sut->generateHTMLTitle();
        $expected = "<h1>Cook book</h1>";

        $this->assertEquals($actual, $expected);
    }
}
