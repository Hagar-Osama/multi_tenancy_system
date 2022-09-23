<?php

namespace App\Http\Traits;

use Tymon\JWTAuth\Facades\JWTAuth;

trait ProductTrait
{

    public function getAllProducts()
    {

        $token = JWTAuth::getToken();
        $payLoad = JWTAuth::getPayload($token)->toArray();
        if ($this->productModel::where('user_id', '!=', $payLoad['user_id'])->get()) {
            return response()->json(['message' => 'No product Found', 'status' => 404]);
        }
    }

    public function getProductById($productId)
    {


        // $token = JWTAuth::getToken();
        // $payLoad = JWTAuth::getPayload($token)->toArray();

        // if ($this->productModel::where('user_id', '!=', $payLoad['user_id'])->first()) {
        //     return response()->json('You Cant Make Changes On the Product');
        // } else {
        //     $product = $this->productModel::where([['user_id', $payLoad['user_id']], ['id', $productId]])->first();
        // }
    }
}
