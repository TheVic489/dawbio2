<?php

interface SequenceInterface {

    public function validate(): bool;
    public function transcription(string $id);
    public function countBases(): array;
    
}
