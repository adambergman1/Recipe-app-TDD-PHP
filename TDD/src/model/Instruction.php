<?php

class Instruction
{
    private $instruction;

    public function __construct(string $instruction)
    {
        if (empty($instruction)) {
            throw new EmptyInstructionException();
        }
        $this->instruction = $instruction;
    }

    public function getInstruction(): string
    {
        return $this->instruction;
    }
}
