<?php

class InstructionsCollection
{
    private $instructions = array();
    private $maxInstructions = 50;

    public function addInstruction(Instruction $toBeSaved): void
    {
        $this->validateCollectionLength();
        $this->instructions[] = $toBeSaved;
    }

    public function getInstructions(): array
    {
        return $this->instructions;
    }

    private function validateCollectionLength()
    {
        if (count($this->instructions) > $this->maxInstructions) {
            throw new TooManyInstructionsException();
        }
    }
}
