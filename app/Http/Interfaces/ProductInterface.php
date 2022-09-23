<?php

namespace App\Http\Interfaces;

interface ProductInterface {

    public function index();

    public function store($request);

    public function update($request);

    public function destroy($productId);
}
