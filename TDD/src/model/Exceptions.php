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

class ContainsNumbersException extends Exception
{ }

class EmptyInstructionException extends Exception
{ }

class InstructionContainsTooFewWordsException extends Exception
{ }

class InstructionContainsTooManyCharactersException extends Exception
{ }

class TooManyInstructionsException extends Exception
{ }

class InstructionDuplicationException extends Exception
{ }

class IncorrectTagException extends Exception
{ }

class RecipeTitleMissingException extends Exception
{ }
