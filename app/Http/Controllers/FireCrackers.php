<?php

namespace App\Http\Controllers;
use App\Models\Fire;
use Illuminate\Http\Request;
use Image;



class FireCrackers extends Controller
{



    public  function index(Request $request)
    {
//        $appid ='wxcb2711060169adca' ;
//        $secret ='d8ebc47e79dffcaf97280b24e60ba66f';
//        $jssdk = new WechatJSSKD($appid, $secret);
//        $signPackage = $jssdk->GetSignPackage();


        $basePath="http://images.ahwes.com/";
        $imgpath=[];

        if($request['company']=="police")
        {$imgpath=[$basePath."fireP_bg.jpg",$basePath."fireP_sg.jpg"];}
        elseif($request['company']=="community")
        {
            $imgpath=[$basePath."fireC_bg.jpg",$basePath."fireC_sg.jpg"];
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

       $img->text("承诺人", 10, 580, function($font) {

           $font->file(public_path("font/signature.ttf")); //字体的地址，地址错误会报GD库的错

           $font->size(16);
           // $font->color('#fdf6e3');
           // $font->align('center');
           // $font->valign('top');
           // $font->angle(45);
       });
       $yourname=$request['yourname'];
       $x = mb_strlen($yourname)>2?8:10;

    // use callback to define details
    $img->text($yourname, $x, 590, function($font) {
    $font->file(public_path("font/signature.ttf")); //字体的地址，地址错误会报GD库的错
    $font->size(22);
    // $font->color('#fdf6e3');
    // $font->align('center');
    // $font->valign('top');
     //$font->angle(45);
});


$img->text(now(), 10, 610, function($font) {
    $font->file(public_path("font/signature.ttf"));
    $font->size(16);
    // $font->color('#fdf6e3');
    // $font->align('center');
    // $font->valign('top');
    // $font->angle(45);
});

       $img->text('tesjkdjljlkjljljlw', 20, 685, function($font) {
           //$font->file(public_path("font/signature.ttf"));
           $font->size(16);
            $font->color('#E7C844');
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


    public  function toUnicode($string)
    {
        $str = mb_convert_encoding($string, 'UCS-2', 'UTF-8');
        $arrstr = str_split($str, 2);
        $unistr = '';
        foreach ($arrstr as $n) {
            $dec = hexdec(bin2hex($n));
            $unistr .= '&#' . $dec . ';';
        }
        return $unistr;
    }

}
