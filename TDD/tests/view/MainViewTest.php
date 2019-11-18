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

    /** @test */
    public function shouldCallOnGenerateMainTitle()
    {
        $viewMock = $this->getMockBuilder(MainView::class)
            ->setMethods(['generateMainTitle'])
            ->getMock();

        $title = '<h1>My Cook Book</h1>';
        $viewMock->method('generateMainTitle')->willReturn($title);

        $viewMock->expects($this->once())->method('generateMainTitle');

        $viewMock->render();
    }
}
