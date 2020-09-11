<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageGroup extends Model
{
    protected $table = 'page_group';

    protected $fillable = [
        'group_id', 'page_id'
    ];
}
