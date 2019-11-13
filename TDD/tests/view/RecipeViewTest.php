<?php

use PHPUnit\Framework\TestCase;

class RecipeViewTest extends TestCase
{
    /** @test */
    public function echoHTMLShouldRenderInput()
    {
        $sut = new RecipeView();
        $actual =   $sut->generateHTMLTitle();
        $expected = "<h1>Hello world!</h1>";

        $this->assertEquals($actual, $expected);
    }
}
