<?php
require_once './model/Speaker.php';

abstract class Animal implements Speaker
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public abstract function talk();

    public function __toString()
    {
        return sprintf(
            "%s{name=%s}",
            get_class($this),
            $this->name
        );
    }
}
