<?php

namespace App\Admin\Controllers;

use App\Admin\DataBase\Navbar;
use App\Admin\DataBase\NavCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Collection;

class NavCategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '菜单管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {


        $grid = new Grid(new NavCategory);

        $grid->column('id')->hide();
//        $grid->column('navid',"导航类别")->display(function ($navid){
//            return Navbar::all()->find($navid)->getAttribute("name");
//        });
        //$grid->navbars()->name();
        $grid->column('navbar.name', "导航类别")->sortable();
        $grid->column('name', "菜单名称"); //shishi
        $grid->column('created_at',"建立日期");
        $grid->column('updated_at', "修改日期");

        //$grid->filter()
        $grid->filter(function($filter){

            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            // 在这里添加字段过滤器
            $filter->like('name', '菜单名称');
            $filter->like('navbar.name', '导航类别');


        });


        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {

        $show = new Show(NavCategory::findOrFail($id));

        $show->field('id',"编号");


        $show->field('navid',"导航类别")->as(function ($navid) {
            return  Navbar::find($navid)->getAttributeValue('name');
        });;
        $show->field('name', "菜单名称");
        $show->field('created_at', "建立时间");
        $show->field('updated_at', "更新时间");

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {



        $form = new Form(new NavCategory);

       // $form->number('navid', __('Navid'));
        $form->select('navid',"导航类别")->options(Navbar::pluck("name","id"));
        $form->text('name',"菜单名称")->rules('required|min:3');

        return $form;
    }





}