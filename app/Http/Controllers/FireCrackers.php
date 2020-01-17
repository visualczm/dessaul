<?php

namespace App\Http\Controllers;
use App\Models\Fire;
use Illuminate\Http\Request;
use Image;

class FireCrackers extends Controller
{




    public  function index(Request $request)
    {
        $basePath="http://images.ahwes.com/";
        $imgpath=[];

        if($request['company']=="police")
        {$imgpath=[$basePath."fireP_bg.jpg",$basePath."fireP_sg.jpg"];}
        elseif($request['company']=="community")
        {
            $imgpath=[$basePath."fireP_bg.jpg",$basePath."fireP_sg.jpg"];
        }

        return view('ahwes.fire',compact('imgpath'));
    }



   public function createFireCrackers(Request $request)
   {



      // dd($request -> all()); //表单过来的所有数据
       $basePath="http://images.ahwes.com/";
       $imgpath="";

       if($request['company']=="police")
       {$imgpath=$basePath."fireP_sg.jpg";}
       elseif($request['company']=="community")
       {
           $imgpath=$basePath."fireP_sg.jpg";
       }

    // create Image from file
    $img = Image::make($imgpath); //背景图的地址

//       $img->text('我是第参与者', 100, 1730, function($font) {
//           $font->file(public_path().'\font\signature.ttf'); //字体的地址，地址错误会报GD库的错
//           $font->size(45);
//           // $font->color('#fdf6e3');
//           // $font->align('center');
//           // $font->valign('top');
//           // $font->angle(45);
//       });

       $img->text('承諾人', 100, 1730, function($font) {
           $font->file(public_path("font/signature.ttf")); //字体的地址，地址错误会报GD库的错
           $font->size(45);
           // $font->color('#fdf6e3');
           // $font->align('center');
           // $font->valign('top');
           // $font->angle(45);
       });
       $yourname=$request['yourname'];
       $x = mb_strlen($yourname)>2?80:100;

    // use callback to define details
    $img->text($yourname, $x, 1800, function($font) {
    $font->file(public_path("font/signature.ttf")); //字体的地址，地址错误会报GD库的错
    $font->size(55);
    // $font->color('#fdf6e3');
    // $font->align('center');
    // $font->valign('top');
     //$font->angle(45);
});


$img->text(now(), 50, 1850, function($font) {
    $font->file(public_path("font/signature.ttf"));
    $font->size(25);
    // $font->color('#fdf6e3');
    // $font->align('center');
    // $font->valign('top');
    // $font->angle(45);
});


       $image = (string)$img->encode('png', 22);
       $base64_encode = 'data:image/png;base64,' . base64_encode($image);



       return response()->json([
           'code' => 1,
           'message' => 'success',
           'data' => $base64_encode,
       ]);

   }
}
