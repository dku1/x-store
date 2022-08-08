<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProductFilters extends QueryFilter
{
    public function search($keyword = ''): Builder
    {
        return $this->builder
            ->where('title_ru', 'like', '%' . $keyword . '%')
            ->orWhere('title_en', 'like', '%' . $keyword . '%');
    }

    public function price($order = 'asc'): Builder
    {
        return $this->builder->orderBy('price', $order);
    }

    public function priceFrom(int $priceFrom = 1): Builder
    {
        return $this->builder->where('price', '>', $priceFrom);
    }

    public function priceTo(int $priceTo = 1000000): Builder
    {
        return $this->builder->where('price', '<', $priceTo);
    }

    public function values(array $valuesIds): Builder
    {
        return $this->builder->join('product_value', 'products.id', '=',
            'product_value.product_id')->whereIn('value_id', $valuesIds)->select('products.*');

//        return $this->builder->join('product_value', 'products.id', '=',
//            'product_value.product_id')->whereIn('value_id', $valuesIds);
    }
}
