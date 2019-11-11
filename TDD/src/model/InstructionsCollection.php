<?php

class InstructionsCollection
{
    private $instructions = array();
    private $maxInstructions = 50;

    public function addInstruction(Instruction $toBeSaved): void
    {
        $this->validateCollectionLength();
        $this->validateCollectionDuplicate($toBeSaved);
        $this->instructions[] = $toBeSaved;
    }

    public function getInstructions(): array
    {
        return $this->instructions;
    }

    private function validateCollectionLength(): void
    {
        if (count($this->instructions) > $this->maxInstructions) {
            throw new TooManyInstructionsException();
        }
    }

    private function validateCollectionDuplicate(Instruction $validate): void
    {
        if (in_array($validate, $this->instructions)) {
            throw new InstructionDuplicationException();
        }
    }
}
