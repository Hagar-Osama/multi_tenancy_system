<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\ProductInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\ImagesTrait;
use App\Http\Traits\ImagesTraits;
use App\Http\Traits\ProductTrait;
use App\Models\Product;

class ProductRepository implements ProductInterface
{

    use ProductTrait;
    use ImagesTrait;
    use ApiResponseTrait;
    private $productModel;

    public function __construct(Product $product)
    {
        $this->productModel = $product;


    }
    public function index()
    {
        $products = $this->getAllProducts();
        return response()->json($products);
    }

    public function store($request)
    {
        $image = $request->file('image');
        $imageName = $image->hashName();
        $this->uploadFile($image, 'products/'. $request->name, $imageName, null);
       $product = $this->productModel::create([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'image' => $imageName,
            'user_id' => auth()->user()->id,
        ]);
        return $this->apiresponse(201, 'Product Created successfully', null, $product);

    }

    public function update($request)
    {
        $product = $this->getProductById($request->productId);
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $this->uploadFile($image, 'products/'. $request->name, $imageName, 'storage/products/'. $product->name);
        }
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'description' => $request->description,
                'image' => isset($imageName) ? $imageName : $product->image,
                'user_id' => auth()->user()->id,

            ]);
            return $this->apiresponse(200, 'Product updated successfully', null, $product);

    }

    public function destroy($productId)
    {
        $product = $this->getProductById($productId);
        $product->delete();
        $this->deleteFile('storage/products/'. $product->name);
        return $this->apiresponse(204, 'Product deleted successfully', null, $product);

    }
}
