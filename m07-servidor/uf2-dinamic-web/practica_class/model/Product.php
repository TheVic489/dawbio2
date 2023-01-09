<?php

/**
 * ADT for user.
 *
 * @author ProvenSoft
 */
class Product {

    private int $id; //PK
    private ?string $description; //UNIQUE
    private ?string $price;
    private ?string $stock;


    public function __construct(int $id, string $description = null, string $price = null, string $stock = null) {
        $this->id = $id;
        $this->description = $description;
        $this->price = $price;
        $this->stock = $stock;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function getPrice(): ?string {
        return $this->price;
    }

    public function getStock(): ?string {
        return $this->stock;
    }

   
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function setPrice(string $price): void {
        $this->price = $price;
    }

    public function setStock(string $stock): void {
        $this->stock = $stock;
    }


    public function __toString(): string {
        $result = "Product{";
        $result .= sprintf("[id=%s]", $this->id);
        $result .= sprintf("[description=%s]", $this->description);
        $result .= sprintf("[price=%s]", $this->price);
        $result .= sprintf("[stock=%s]", $this->stock);
        $result .= "}";
        return $result;
    }

}