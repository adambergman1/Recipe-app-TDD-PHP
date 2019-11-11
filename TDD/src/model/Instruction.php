<?php

class Instruction
{
    private $instruction;

    public function __construct(string $instruction)
    {
        $this->instruction = $instruction;
    }

    public function getInstruction(): string
    {
        return $this->instruction;
    }
}
