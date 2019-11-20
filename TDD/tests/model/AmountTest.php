<?php

class AmountTest extends PHPUnit\Framework\TestCase
{

    /** @test */
    function shouldAcceptCorrectAmount()
    {
        $input = 1;
        $sut = new Amount($input);
        $actual = $sut->getAmount();

        $expected = 1;

        $this->assertEquals($actual, $expected);
    }

    /** @test */
    function shouldThrowExceptionOnTooLargeAmount()
    {
        $this->expectException(TooLargeAmountException::class);
        $input = 1501;
        new Amount($input);
    }

    /** @test */
    function shouldThrowExceptionOnTooSmallAmount()
    {
        $this->expectException(TooSmallAmountException::class);
        $input = -1;
        new Amount($input);
    }
}
