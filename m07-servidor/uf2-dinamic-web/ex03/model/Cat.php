<?php
require_once './model/Animal.php';

class Cat extends Animal
{
    private bool $handsome;

    public function __construct(string $name, bool $handsome)
    {
        parent::__construct($name);
        $this->handsome = $handsome;
    }


    public function isHandsome(): bool
    {
        return $this->handsome;
    }

    public function setHandsome(bool $handsome): void
    {
        $this->handsome = $handsome;
    }

    public function talk()
    {
        echo 'Meow!';
    }

    public function __toString()
    {
        return sprintf(
            "%s{name=%s, handsome=%s}",
            get_class($this),
            $this->getName(),
            $this->handsome
        );
    }
}

