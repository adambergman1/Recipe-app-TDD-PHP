<?php

class MainControllerTest extends PHPUnit\Framework\TestCase
{

    /** @test */
    function shouldInitializeApp()
    {
        $app = new MainController();
        $actual = $app->run();
        $expected = "<p>Hello world</p>";

        $this->assertEquals($actual, $expected);
    }
    /** @test */
    function shouldReturnMainView()
    {
        $app = new MainController();
        $actual = $app->run();

        $this->assertInstanceOf(MainView::class, $actual);
    }
}
