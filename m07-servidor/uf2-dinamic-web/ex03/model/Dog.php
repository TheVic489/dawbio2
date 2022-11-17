<?php
require_once './model/Animal.php';

class Dog extends Animal
{
    private string $color;

    public function __construct(string $name, string $color)
    {
        parent::__construct($name);
        $this->color = $color;
    }

    public function talk()
    {
        echo 'Woof!';
    }

    public function __toString()
    {
        return sprintf(
            "%s{name=%s, color=%s}",
            get_class($this),
            $this->getName(),
            $this->color
        );
    }
}
