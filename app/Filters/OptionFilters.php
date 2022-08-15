<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class OptionFilters extends QueryFilter
{
    public function search($keyword = ''): Builder
    {
        return $this->builder
            ->where('title_ru', 'like', '%' . $keyword . '%')
            ->orWhere('title_en', 'like', '%' . $keyword . '%');
    }
}
