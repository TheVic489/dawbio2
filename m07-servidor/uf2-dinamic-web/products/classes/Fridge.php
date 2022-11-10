<?php
namespace products;
require_once 'Product.php';
/**
 * Description of Fridge
 * @author ProvenDev
 */
class Fridge extends Product {
    
    private int $capacity;
    
    public function __construct(string $code, string $description, float $price, int $capacity) {
        parent::__construct($code, $description, $price);
        $this->capacity = $capacity;
    }

    public function getCapacity(): int {
        return $this->capacity;
    }

    public function setCapacity(int $capacity) {
        $this->capacity = $capacity;
    }

    public function __toString() {
        return "Fridge: " . parent::__toString() . ", capacity=$this->capacity";
    }
}