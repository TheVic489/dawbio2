<?php

/**
 * ADT for product.
 *
 * @author Pau Figueras
 */
class Product {

    private int $id; // "PK"
    private ?string $desc; // UNIQUE
    private ?float $price;
	private ?int $stock;

    public function __construct(int $id, string $desc = null, float $price = null, int $stock = null) {
        $this->id = $id;
        $this->desc = $desc;
        $this->price = $price;
        $this->stock = $stock;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getDesc(): string {
        return $this->desc;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function getStock(): int {
        return $this->stock;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setDesc(string $desc): void {
        $this->desc = $desc;
    }

    public function setPrice(float $price): void {
        $this->price = $price;
    }

    public function setStock(int $stock): void {
        $this->stock = $stock;
    }

    public function __toString(): string {
        $result = "Product{";
        $result .= sprintf("[id=%d]", $this->id);
        $result .= sprintf("[desc=%s]", $this->desc);
        $result .= sprintf("[price=%f]", $this->price);
        $result .= sprintf("[stock=%d]", $this->stock);
        $result .= "}";
        return $result;
    }

}
