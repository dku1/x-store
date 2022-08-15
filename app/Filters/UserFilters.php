<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class UserFilters extends QueryFilter
{
    public function search($keyword = ''): Builder
    {
        return $this->builder
            ->where('email', 'like', '%' . $keyword . '%');
    }
}
