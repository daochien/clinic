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
}
