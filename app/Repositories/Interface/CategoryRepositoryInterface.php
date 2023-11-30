<?php



namespace App\Repositories\Interface;

interface CategoryRepositoryInterface{

    public function getParentCategory();
    public function getChildCategory();
}
