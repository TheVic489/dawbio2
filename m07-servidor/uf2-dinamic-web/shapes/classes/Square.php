<?php

namespace shapes;
require_once 'Shape.php';

/**
 * Description of Square
 * @author ProvenDev
 */
class Square implements Shape {
    
    private $side;

    /**
     * class constructor
     * @param float $side
     */    
    public function __construct(float $side) {
        $this->side = $side;
    }
    
    /**
     * read accessor for $side
     * @return float
     */    
    public function getSide(): float {
        return $this->side;
    }

    /**
     * write accessor for $side
     * @param float $side
     */
    public function setSide(float $side) {
        $this->side = $side;
    }
    
    /**
     * converts object into a string
     * @return string
     */
    public function __toString() {
        return "Square: {side=$this->side}";
    }

    public function area(): float {
        return $this->side * $this->side;
    }

    public function perimeter(): float {
        return 4.0 * $this->side;
    }

}
