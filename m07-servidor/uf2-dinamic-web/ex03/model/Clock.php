<?php
include_once './model/Speaker.php';

class Clock implements Speaker
{
    private string|bool $type;

    public function __construct(string|bool $type)
    {
        $this->type = $type;
    }

    public function setType(string|bool $type): void
    {
        $this->type = $type;
        
    }
    public function getName(): string|bool
    {
        return $this->type;
    }


    public function talk()
    {
        echo "TicTac!";
    }

    public function __toString()
    {
        return sprintf(
            "%s{}",
            get_class($this)
        );
    }
}
