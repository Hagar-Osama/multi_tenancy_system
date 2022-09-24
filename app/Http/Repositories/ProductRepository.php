<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\ProductInterface;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\ImagesTrait;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductRepository implements ProductInterface
{

    use ImagesTrait;
    use ApiResponseTrait;
    private $productModel;

    public function __construct(Product $product)
    {
        $this->productModel = $product;
    }

    public function index()
    {

        $token = JWTAuth::getToken();
        $payLoad = JWTAuth::getPayload($token)->toArray();
        if ($products = $this->productModel::where('user_id', $payLoad['user_id'])->get()) {
            return response()->json($products);
        } else {
            return response()->json(['message' => 'No product Found', 'status' => 404]);
        }
    }

    public function store($request)
    {
        $token = JWTAuth::getToken();
        $payLoad = JWTAuth::getPayload($token)->toArray();
        if (Auth::user()->email == $payLoad['email']) {

            $image = $request->file('image');
            $imageName = $image->hashName();
            $this->uploadFile($image, 'products/' . $request->name, $imageName, null);
            $product = $this->productModel::create([
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'description' => $request->description,
                'image' => $imageName,
                'user_id' => auth()->user()->id,
            ]);
            return $this->apiresponse(201, 'Product Created successfully', null, $product);
        } else {
            return response()->json('You Cant Add Products');
        }
    }

    public function update($request)
    {

        $token = JWTAuth::getToken();
        $payLoad = JWTAuth::getPayload($token)->toArray();
        if ($product = $this->productModel::where([['user_id', $payLoad['user_id']], ['id', $request->productId]])->first()) {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $image->hashName();
                $this->uploadFile($image, 'products/' . $request->name, $imageName, 'storage/products/' . $product->name);
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
        } else {
            return response()->json('You Cant Make Changes On the Product');
        }
    }

    public function destroy($productId)
    {
        $token = JWTAuth::getToken();
        $payLoad = JWTAuth::getPayload($token)->toArray();
        if ($product = $this->productModel::where([['user_id', $payLoad['user_id']], ['id', $productId]])->first()) {
            $product->delete();
            $this->deleteFile('storage/products/' . $product->name);
            return $this->apiresponse(204, 'Product deleted successfully', null, $product);
        } else {
            return response()->json('You Cant Delete this Product');
        }
    }
}
