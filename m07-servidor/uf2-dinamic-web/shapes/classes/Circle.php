<?php

namespace shapes;
require_once 'Shape.php';

/**
 * Description of Circle
 * @author ProvenDev
 */
class Circle implements Shape {
    
    private $radius;
    
    /**
     * class constructor
     * @param type $radius
     */
    public function __construct(float $radius) {
        $this->radius = $radius;
    }
    
    /**
     * read accessor for $radius
     * @return float
     */
    public function getRadius(): float {
        return $this->radius;
    }

    /**
     * write accessor for $radius
     * @param float $radius
     */
    public function setRadius(float $radius) {
        $this->radius = $radius;
    }

    /**
     * converts object into a string
     * @return string
     */
    public function __toString() {
        return "Circle: {radius=$this->radius}";
    }

    public function area(): float {
        return M_PI * $this->radius * $this->radius;
    }

    public function perimeter(): float {
        return 2.0 * M_PI * $this->radius;
    }

}
