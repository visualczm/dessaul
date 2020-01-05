<?php

namespace App\Http\Controllers;



class HomeController extends Controller
{

 public function index()
 {

     $nav= new \App\Models\NavCategory();//获取产品列表
     $imports=  $nav->getNavCategory(1);//进口列表

     $about=\App\models\About::select('mission')->findOrFail(1);

     $product=\App\models\Product::where('push','=',1)->get();


    return view('index',compact('imports','about','product'));

 }


// public function product()
// {
//       $pro= Product::all();
//
//     return view('product',compact(['pro']));
//
// }



}
