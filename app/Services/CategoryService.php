<?php

namespace App\Services;

use App\Filters\CategoryFilters;
use App\Models\Category;

class CategoryService
{
    public function getItems(?CategoryFilters $filters = null)
    {
        $categoryItems = Category::with('products', 'children')->orderBy('parent_id');
        if (request()->search){
            return $categoryItems->filter($filters)->get();
        }
        return $this->buildTree($categoryItems->get());
    }

    private function buildTree($categoryItems)
    {
        $grouped = $categoryItems->groupBy('parent_id');
        foreach ($categoryItems as $item) {
            if ($grouped->has($item->id)) {
                $item->children = $grouped[$item->id];
            }
        }
        return $categoryItems->where('parent_id', 0);
    }
}
