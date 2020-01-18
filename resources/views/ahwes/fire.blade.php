<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>禁止燃放烟花炮竹,建设文明美丽城市</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('layui/css/layui.css') }}?v=2.5.5">
    <script type="text/javascript" src="{{ asset('layui/layui.js') }}?v=2.5.5"></script>
<style>
    #web_bg{
        /*position:fixed;*/
        /*top: 0;*/
        /*left: 0;*/
        /*margin: 0 auto;*/
        /*width:100%;*/
        /*!*height:100%;*!*/
        /*!*max-width: 400px;*!*/

        /*!*!*min-width: 1000px;*!*!*/
        /*!*z-index:-10;*!*/
        /*!*zoom: 1;*!*/
        /*background-color: #fff;*/
        /*background-repeat: no-repeat;*/
        /*background-size: cover;*/
        /*-webkit-background-size: cover;*/
        /*-o-background-size: cover;*/
        /*background-position: center 0;*/
        background-image:url({{$imgpath[0]}});

        background-size: 100% 100%;
        min-width: 375px;
    }



    .layui-input-block{width:50%;margin: 0 auto}

    .layui-input{background-color: transparent;font-size: 25px;color: white}

    .layui-container{padding: 0}
</style>
</head>
<body id="web_bg">
<div class="layui-container">
        <div class="layui-row" >
            <div class="layui-col-md12" >

            <div id="dd" style="position:absolute;bottom: 0;height: 150px;width: 100%" >
                <div class="layui-input-block">
                    <input type="text" name="yourname" lay-verify="title" autocomplete="off" placeholder="请输入姓名" class="layui-input">
                </div>
                <div id="itdone" style="position:absolute;top: 45px;height: 100px;width: 100%" >

                </div>
            </div>
        </div>

        <div class="poster-box" style="display: none;min-height:650px;min-width: 320px">
        <img class="poster-img" src="" style=""/>
        </div>

        </div>

</div>
<script src="https://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
<script>

    layui.use(['jquery',['layer']], function(){
        $=layui.jquery;
        $('#web_bg').height(window.screen.height);
        $('.layui-col-md12').css({"top":window.screen.height-80});

        $('.poster-box').hide();

        $("#itdone").click(function(){
            var name=$(" input[ name='yourname' ] ").val();
            var index;

            if(!name)
            {
                layer.msg('请输入姓名');
                return false;
            }


            $.ajax({
                type: 'POST',
                url: '/firecrackers/post',
                data: {'yourname':name,'company':getUrlParam("company")},
                headers: {'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')},
                dataType: 'json',
                beforeSend:function(){
                    index=layer.load(1, {
                        shade: [0.1,'#fff'] //0.1透明度的白色背景
                    });

                },
                success: function (d) {

                    layer.close(index);
                },
                complete:function (e) {

                    $(".poster-img").attr('src',e.responseJSON.data);
                    $(".poster-img").width($(window).width()-80);
                    $(".poster-img").height($(window).height()-100);
                    layer.open({

                        type: 1,
                        shade: false,
                        title: false, //不显示标题
                        content: $('.poster-box'), //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响
                    });




                }
            });
        });










    });


    function getUrlParam(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
        var r = window.location.search.substr(1).match(reg);  //匹配目标参数
        if (r != null) return unescape(r[2]); return null; //返回参数值
    }



</script>

</body>
</html>
