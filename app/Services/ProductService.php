<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function store(array $data)
    {
        $data['image'] = Storage::put('/images/products', $data['image']);
        if (isset($data['value_ids'])) {
            $value_ids = $data['value_ids'];
            unset($data['value_ids']);
        }
        $product = Product::create($data);
        if(isset($value_ids)) $product->values()->attach($value_ids);
    }

    public function upload(array $data, Product $product)
    {
        if (isset($data['image'])){
            Storage::delete($product->image);
            $data['image'] = Storage::put('/images/products', $data['image']);
        }
        if (isset($data['value_ids'])) {
            $product->values()->sync($data['value_ids']);
            unset($data['value_ids']);
        }else{
            $product->values()->detach();
        }
        $product->update($data);
    }
}
