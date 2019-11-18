<?php

use PHPUnit\Framework\TestCase;

class MainViewTest extends TestCase
{
    /** @test */
    public function shouldGenerateMainTitle()
    {
        $view = new MainView();

        $actual = $view->generateMainTitle();

        $expected = '<h1>My Cook Book</h1>';

        $this->assertEquals($actual, $expected);
    }
}
