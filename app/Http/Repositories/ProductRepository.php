<?php
namespace App\Http\Repositories;

use App\Http\Interfaces\ProductInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\ImagesTraits;
use App\Http\Traits\ProductTrait;

class ProductRepository implements ProductInterface {

    use ProductTrait;
    use ImagesTraits;
    use ApiResponseTrait;
    public function index()
    {
        $products = $this->getAllProducts();
        return response()->json($products);
    }

    public function store($request)
    {

    }

    public function update($request)
    {

    }

    public function destroy($request)
    {
        
    }
}
