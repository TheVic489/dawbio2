<?php

namespace proven\store\model;

class WarehouseProducts {

    public function __construct(
        private int $warehouseId = 0,
        private int $productId   = 0,
        private int $stock       = 0,
    ) {
        
    }

    public function getWarehouseId(): ?int {
        return $this->warehouseId;
    }

    public function getProductId(): ?int {
        return $this->productId;
    }

    public function getStock(): ?string {
        return $this->stock;
    }

    public function setWarehouseId(int $warehouseId): void {
        $this->warehouseId = $warehouseId;
    }

    public function setProductId(int $productId): void {
        $this->productId = $productId;
    }

    public function setStock(int $stock): void {
        $this->stock = $stock;
    }

    public function __toString() {
        return sprintf("WarehouseProducts{[warehouse_id=%d][product_id=%s][stock=%s]}",
                $this->warehouseId, $this->productId, $this->stock);
    }

}
