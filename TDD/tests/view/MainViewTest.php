<?php

use PHPUnit\Framework\TestCase;

class MainViewTest extends TestCase
{
    private $sut;
    private $recipeMock;

    function setUp(): void
    {
        $this->sut = new MainView();

        $this->recipeMock = $this->getMockBuilder(AddRecipeView::class)
            ->disableOriginalConstructor()
            ->setMethods(['generateOutput'])
            ->getMock();
    }

    /** @test */
    function shouldGenerateMainTitle()
    {
        $actual = $this->sut->generateMainTitle();
        $expected = '<h1>My Cook Book</h1>';

        $this->assertEquals($actual, $expected);
    }

    /** @test */
    function shouldCallOnGenerateMainTitle()
    {
        $mainViewMock = $this->getMockBuilder(MainView::class)
            ->setMethods(['generateMainTitle'])
            ->getMock();

        $mainViewMock->expects($this->once())->method('generateMainTitle');

        $mainViewMock->render($this->recipeMock);
    }

    /** @test */
    function shouldCallOnAddRecipeMethodGenerateOutput()
    {
        $this->recipeMock->expects($this->once())->method('generateOutput');

        $this->sut->render($this->recipeMock);
    }
}
