<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateCategory extends Model
{
    public $incrementing = false;
    protected $primaryKey = '';
    protected $table = 'template_category';


    static function getAll()
    {
        return Category::from('categories as c')
            ->where('c.type', Category::TYPE['template'])
            ->get();
    }
}
