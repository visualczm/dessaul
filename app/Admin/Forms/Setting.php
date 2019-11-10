<?php

namespace App\Admin\Forms;

use App\Admin\DataBase\Settings;
//use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;
use Encore\Admin\Form;

class Setting extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '网站设置';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        //dump($request->all());




       $res= Settings::where('id',1)->update($request->toArray());

       if($res>0)
           admin_toastr('设定成功', 'success', ['timeOut' => 5000]);
       else
        admin_error('失败');

       return back();
    }

    /**
     * Build a form here.
     */
    public function form()
    {


        $this->text('title')->rules('required');
        $this->file('logo','Logo');
        $this->text('contact','联系方式');
        $this->file('wechat','微信二维码');
        $this->email('email','邮箱');
        $this->text('address','地址');
        $this->multipleImage('banner','首页滚动大图');
        $this->text('footer','备案号');
        $this->email('email')->rules('email');
        $this->datetime('created_at');

    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        return [
        'title'       => 'John Doe',
        //'email'      => 'John.Doe@gmail.com',
        //'created_at' => now(),
    ];
    }
}
