<?php

namespace App\Repositories;

use App\Models\Category;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository
{

    protected $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function getTemplateByCategory($catType)
    {
        return $this->model->where('type', $catType)->get();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function showClientCategoryBlog($cateType, $withId = '', $getLatest = '', $limit = 10)
    {
        if (!empty($withId)) {
            $cateIds = $this->model->where('type', $cateType)->where('id', '<>', $withId)->limit($limit - 1)->pluck('id')->toArray();
            array_push($cateIds, $withId);

            $categorys = $this->model->where('type', $cateType)->whereIn('id', $cateIds);
            return $categorys->with(['latestPage'])->get();
        } else {
            $categorys = $this->model->where('type', $cateType);
            if (!empty($getLatest)) {
                $categorys->with(['latestPage']);
            }
            return $categorys->get();
        }
    }

}
