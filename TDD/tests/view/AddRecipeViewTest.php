<?php

use PHPUnit\Framework\TestCase;

class AddRecipeViewTest extends TestCase
{
    protected $sut;

    public function setUp(): void
    {
        $this->sut = new AddRecipeView();
    }

    /** @test */
    public function shouldRespondIfUserWantsToAddRecipe()
    {
        $mock = $this->getMockBuilder(AddRecipeView::class)
            ->setMethods([
                'userWantsToAddRecipe',
            ])
            ->getMock();

        $mock->method('userWantsToAddRecipe')->willReturn(true);

        $actual = $mock->userWantsToAddRecipe();

        $this->assertTrue($actual);
    }

    /** @test */
    public function shouldRespondFalseOnEmptyPost()
    {
        $actual = $this->sut->userWantsToAddRecipe();

        $this->assertFalse($actual);
    }

    /** @test */
    public function shouldIncludeForm()
    {
        $this->expectOutputRegex('/form method="POST"/');
        $this->sut->generateOutput();
    }

    /** @test */
    public function shouldCallOnRenderAddRecipe()
    {
        $mock = $this->getMockBuilder(AddRecipeView::class)
            ->setMethods([
                'userWantsToAddRecipe',
                'generateOutput',
                'renderAddRecipe'
            ])
            ->getMock();

        $mock->method('userWantsToAddRecipe')->willReturn(true);
        $mock->expects($this->once())->method('renderAddRecipe');
        $mock->generateOutput();
    }
}
