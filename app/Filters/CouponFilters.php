<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class CouponFilters extends QueryFilter
{
    public function search($keyword = ''): Builder
    {
        return $this->builder
            ->where('code', 'like', '%' . $keyword . '%');
    }
}
