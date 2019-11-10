<?php

namespace App\Admin\Controllers;

use App\Admin\DataBase\Settings;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
//use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
//use Encore\Admin\Show;
use App\Admin\Forms;



class SettingsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '网站设置';



    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

       // Route::redirect('/here');
       // Route::get('/user', 'UsersController@index');
        //$this->setResource('/admin/users');
       // $router->resource('users', UserController::class);

//        $grid = new Grid(new Settings);
//
//        $grid->column('id', __('Id'));
//        $grid->column('title', __('Title'));
//        $grid->column('logo', __('Logo'));
//        $grid->column('contact', __('Contact'));
//        $grid->column('wechat', __('Wechat'));
//        $grid->column('qq', __('Qq'));
//        $grid->column('email', __('Email'));
//        $grid->column('address', __('Address'));
//        $grid->column('banner', __('Banner'));
//        $grid->column('footer', __('Footer'));
//        $grid->column('updated_at', __('Updated at'));
//
//        return $grid;
        
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Settings::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('logo', __('Logo'));
        $show->field('contact', __('Contact'));
        $show->field('wechat', __('Wechat'));
        $show->field('qq', __('Qq'));
        $show->field('email', __('Email'));
        $show->field('address', __('Address'));
        $show->field('banner', __('Banner'));
        $show->field('footer', __('Footer'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Settings);

        $form->text('title', __('Title'));
        $form->textarea('logo', __('Logo'));
        $form->textarea('contact', __('Contact'));
        $form->textarea('wechat', __('Wechat'));
        $form->text('qq', __('Qq'));
        $form->email('email', __('Email'));
        $form->text('address', __('Address'));
        $form->multipleImage('banner', __('Banner'));
        $form->textarea('footer', __('Footer'));
        $form->tools(function (Form\Tools $tools) {

            // 去掉`列表`按钮
            $tools->disableList();

            // 去掉`删除`按钮
            $tools->disableDelete();

            // 去掉`查看`按钮
            $tools->disableView();

            // 添加一个按钮, 参数可以是字符串, 或者实现了Renderable或Htmlable接口的对象实例
            //$tools->add('<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;delete</a>');
        });

        $form->footer(function ($footer) {

            // 去掉`重置`按钮
            $footer->disableReset();

            // 去掉`提交`按钮
            //$footer->disableSubmit();

            // 去掉`查看`checkbox
            $footer->disableViewCheck();

            // 去掉`继续编辑`checkbox
            $footer->disableEditingCheck();

            // 去掉`继续创建`checkbox
            $footer->disableCreatingCheck();

        });

        return $form;
    }
}
