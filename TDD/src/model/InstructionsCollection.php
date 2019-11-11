<?php

class InstructionsCollection
{
    private $instructions = array();
    private $maxInstructions = 50;

    public function addInstruction(Instruction $toBeSaved): void
    {

        $this->validateCollectionLength();
        if (in_array($toBeSaved, $this->instructions)) {
            throw new InstructionDuplicationException();
        }
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
