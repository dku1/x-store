<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function getItems()
    {
        $categoryItems = Category::ofSort(['parent_id' => 'asc', 'sort_order' => 'asc'])->with('children')->get();
        return $this->buildTree($categoryItems);
    }

    private function buildTree($categoryItems)
    {
        $grouped = $categoryItems->groupBy('parent_id');
        foreach ($categoryItems as $item){
            if ($grouped->has($item->id)){
                $item->children = $grouped[$item->id];
            }
        }
        return $categoryItems->where('parent_id',0);
    }
}
