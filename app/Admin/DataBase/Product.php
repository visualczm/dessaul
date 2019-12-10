<?php

namespace App\Admin\DataBase;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table="dessaul_product";

    public function category()
    {
        return $this->belongsTo(Category::class,"category_id","id");
    }


    public function navcategory()
    {
        return $this->belongsTo(NavCategory::class,"parent_id","id");
    }


}
