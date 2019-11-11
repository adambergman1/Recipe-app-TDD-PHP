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
        $this->expectException(Exception::class);
        $input = 101;
        new Amount($input);
    }
}
