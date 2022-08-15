<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class OrderFilters extends QueryFilter
{
    public function search($keyword = ''): Builder
    {
        return $this->builder->where('email', 'like', '%' . $keyword . '%');
    }

    public function processed()
    {
        return $this->builder->status(1);
    }

    public function notProcessed()
    {
        return $this->builder->status(0);
    }
}
