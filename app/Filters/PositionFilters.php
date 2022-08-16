<?php

namespace App\Filters;

use App\Models\Position;
use Illuminate\Database\Eloquent\Builder;

class PositionFilters extends QueryFilter
{
    public function search($keyword = ''): Builder
    {
        return $this->builder
            ->whereRelation('product', 'title_ru', 'like', '%' . $keyword . '%')
            ->orWhereRelation('product', 'title_en', 'like', '%' . $keyword . '%');
    }

    public function price($order = 'asc'): Builder
    {
        return $this->builder->orderBy('price', $order);
    }

    public function priceFrom(int $priceFrom = 1): Builder
    {
        return $this->builder->where('price', '>=', $priceFrom);
    }

    public function priceTo(int $priceTo = 1000000): Builder
    {
        return $this->builder->where('price', '<=', $priceTo);
    }

    public function values(array $valuesIds): Builder
    {
        return $this->builder->join('position_value', 'positions.id', '=',
            'position_value.position_id')->whereIn('value_id', $valuesIds)->select('positions.*')->distinct();
    }

    public function value(int $id): Builder
    {
        return $this->builder->whereRelation('values', 'value_id', '=', $id);
    }
}
