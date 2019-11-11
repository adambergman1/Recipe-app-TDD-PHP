<?php

class InstructionsCollection
{
    private $instructions = array();

    public function addInstruction(Instruction $toBeSaved): void
    {
        $this->instructions[] = $toBeSaved->getInstruction();
    }

    public function getInstructions(): array
    {
        return $this->instructions;
    }
}
