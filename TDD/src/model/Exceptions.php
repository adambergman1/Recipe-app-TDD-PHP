<?php

use PHPUnit\Framework\Exception;

class NotAValidMeasurementException extends Exception
{ }

class TooLargeAmountException extends Exception
{ }

class TooSmallAmountException extends Exception
{ }

class TooLongIngredientException extends Exception
{ }

class TooShortIngredientException extends Exception
{ }

class IngredientContainsNumbersException extends Exception
{ }

class EmptyInstructionException extends Exception
{ }
