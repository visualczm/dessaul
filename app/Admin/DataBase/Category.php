<?php

namespace App\Admin\DataBase;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table="dessaul_category";

    public function navcategory()
    {
        return $this->belongsTo(NavCategory::class,"navcategory_id","id");
    }

}
