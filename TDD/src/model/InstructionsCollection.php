<?php

class InstructionsCollection
{
    private $instructions = array();

    public function addInstruction(Instruction $toBeSaved): void
    {
        if (count($this->instructions) > 50) {
            throw new TooManyInstructionsException();
        }

        $this->instructions[] = $toBeSaved;
    }

    public function getInstructions(): array
    {
        return $this->instructions;
    }
}
