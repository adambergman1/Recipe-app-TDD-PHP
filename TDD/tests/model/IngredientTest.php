<?php

use PHPUnit\Framework\TestCase;

class IngredientTest extends TestCase
{
    protected $amount;
    protected $measurement;

    function setUp(): void
    {
        $this->amount = $this->getMockBuilder("Amount")
            ->setConstructorArgs([2.3])
            ->setMethods(["getAmount"])
            ->getMock();

        $this->amount->method("getAmount")
            ->willReturn(2.3);

        $this->measurement = $this->getMockBuilder("Measurement")
            ->setConstructorArgs(["dl"])
            ->setMethods(["getMeasurement"])
            ->getMock();

        $this->measurement->method("getMeasurement")
            ->willReturn("dl");
    }

    /** @test */
    function shouldAcceptIngredientWithAmountAndMeasurement()
    {
        $input = 'Potatoes';

        $sut = new Ingredient($input);
        $actual = $sut->getName();
        $expected = 'Potatoes';
        $this->assertEquals($actual, $expected);
    }

    /** @test */
    function shouldAcceptIngredient()
    {
        $input = 'Flour';
        $sut = new Ingredient($input);
        $actual = $sut->getIngredient();

        $expected = 'Flour';

        $this->assertEquals($actual, $expected);
    }

    /** @test */
    function shouldThrowExceptionOnIngredientLongerThan60Characters()
    {
        $this->expectException(TooLongIngredientException::class);

        $input = 'This is a veeeeery long ingredient that is not acceptable to our system';
        new Ingredient($input);
    }

    /** @test */
    function shouldThrowExceptionOnIngredientShorterThan2Characters()
    {
        $this->expectException(TooShortIngredientException::class);

        $input = 'Pe';
        new Ingredient($input);
    }

    /** @test */
    function shouldThrowExceptionOnIngredientIncludingNumbers()
    {
        $this->expectException(IngredientContainsNumbersException::class);

        $input = '3 milk products';
        new Ingredient($input);
    }
}
