<?php

class MainControllerTest extends PHPUnit\Framework\TestCase
{
    /** @test */
    function shouldReturnMainViewRender()
    {
        $app = new MainController();
        $actual = $app->run();

        $this->assertStringContainsString('DOCTYPE html', $actual);
    }
}
