<?php
namespace products;
/**
 * Description of product
 * @author ProvenDev
 */
abstract class Product {
    
    protected string $code;
    protected string $description;
    protected float  $price;
    
    /**
     * class constructor
     * @param string $code
     * @param string $description
     * @param float $price
     */
    public function __construct(string $code, string $description, float $price) {
        $this->code = $code;
        $this->description = $description;
        $this->price = $price;
    }

    public function getCode(): string {
        return $this->code;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function setCode(string $code) {
        $this->code = $code;
    }

    public function setDescription(string $description) {
        $this->description = $description;
    }

    public function setPrice(float $price) {
        $this->price = $price;
    }

    public function __toString() {
        return sprintf("Product: {code=%s, description=%s, price=%.2f}", 
                $this->code, $this->description, $this->price);
    }    
    
}