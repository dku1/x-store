<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function store(array $data)
    {
        if (isset($data['option_ids'])) {
            $option_ids = $data['option_ids'];
            unset($data['option_ids']);
        }
        $product = Product::create($data);
        if(isset($option_ids)) $product->options()->attach($option_ids);
    }

    public function upload(array $data, Product $product)
    {
        if (isset($data['option_ids'])) {
            $product->options()->sync($data['option_ids']);
            unset($data['option_ids']);
        }else{
            $product->options()->detach();
        }
        $product->update($data);
    }
}
