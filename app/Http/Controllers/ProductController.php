<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ProductInterface;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\DeleteProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productInterface;

    public function __construct(ProductInterface $productInterface)
    {
        $this->productInterface = $productInterface;
        // $this->middleware('auth:api');


    }

    public function index()
    {
        return $this->productInterface->index();
    }

    public function store(AddProductRequest $request)
    {
        return $this->productInterface->store($request);
    }

    public function update(UpdateProductRequest $request)
    {
        return $this->productInterface->update($request);
    }

    public function destroy($productId)
    {
        return $this->productInterface->destroy($productId);
    }
}
