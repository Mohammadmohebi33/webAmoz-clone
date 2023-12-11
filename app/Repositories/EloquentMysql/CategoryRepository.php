<?php


namespace App\Repositories\EloquentMysql;

use App\Models\Category;
use App\Repositories\Interface\CategoryRepositoryInterface;


class CategoryRepository implements CategoryRepositoryInterface{

    public function getParentCategory()
    {
         return Category::query()->whereNull('parent_id')->get();
    }

    public function getChildCategory()
    {
       return Category::all();
    }
}
