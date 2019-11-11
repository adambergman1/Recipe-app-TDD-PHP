<?php

class Instruction
{
    private $instruction;
    private $isCompleted = false;

    public function __construct(string $instruction)
    {
        $this->validateInstruction($instruction);
    }

    private function validateInstruction(string $instruction): void
    {
        if (empty($instruction)) {
            throw new EmptyInstructionException();
        }

        if (str_word_count($instruction) < 2) {
            throw new InstructionContainsTooFewWordsException();
        }

        if (strlen($instruction) > 500) {
            throw new InstructionContainsTooManyCharactersException();
        }

        $this->instruction = $instruction;
    }

    public function getInstruction(): string
    {
        return $this->instruction;
    }

    public function isCompleted(): bool
    {
        return $this->isCompleted;
    }
}
