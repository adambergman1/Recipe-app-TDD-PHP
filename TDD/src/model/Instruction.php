<?php

class Instruction
{
    private $instruction;

    public function __construct(string $instruction)
    {
        if (empty($instruction)) {
            throw new EmptyInstructionException();
        }

        if (str_word_count($instruction) < 2) {
            throw new InstructionContainsTooFewWordsException();
        }

        if (strlen($instruction) > 500) {
            throw new Exception();
        }

        $this->instruction = $instruction;
    }

    public function getInstruction(): string
    {
        return $this->instruction;
    }
}
