<?php
namespace App\Http\Traits;

trait ProductTrait {

    public function getAllProducts() {

        return $this->productModel::get();
    }

    public function getProductById($productId) {

        return $this->productModel::findOrFail($productId);
    }
}
