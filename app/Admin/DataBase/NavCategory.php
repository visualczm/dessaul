<?php

namespace App\Admin\DataBase;

use Illuminate\Database\Eloquent\Model;

class NavCategory extends Model
{
    protected $table="dessaul_navcategory";
    //

    public function navbar()
    {
        return $this->belongsTo(Navbar::class,"navid","id");
    }

//    public function get_xxx()
//    {
//        $data = $this
//            ->leftJoin('dessaul_navbar', 'dessaul_navcategory.navid', '=', 'dessaul_navbar.id')
//            ->get(["dessaul_navbar.name as xxx","dessaul_navcategory.name"]);
//           ->
//        if ($data->isEmpty()) {
//            return [];
//        }
//        //$data = $data->toArray();
//
//        return $data;
//
//     }
}
