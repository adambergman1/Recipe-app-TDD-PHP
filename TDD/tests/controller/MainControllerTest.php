<?php

include_once("../../src/controller/MainController.php");

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
}
