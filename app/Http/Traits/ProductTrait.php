<?php
namespace App\Http\Traits;

trait ProductTrait {

    public function getAllProducts() {

        return $this->productModel::all();
    }

    public function getProductById($productId) {

        return $this->productModel::findOrFail($productId);
    }
}
