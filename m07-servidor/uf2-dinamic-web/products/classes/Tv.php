<?php
namespace products;
require_once 'Product.php';
/**
 * Description of Tv
 * @author ProvenDev
 */
class Tv extends Product {
    
    private $inches;
    
    public function __construct(string $code, string $description, float $price, int $inches) {
        parent::__construct($code, $description, $price);
        $this->inches = $inches;
    }

    public function getInches(): int {
        return $this->inches;
    }

    public function setInches(int $inches) {
        $this->inches = $inches;
    }

    public function __toString() {
        return "TV: " . parent::__toString() . ", inches=$this->inches";
    }
}