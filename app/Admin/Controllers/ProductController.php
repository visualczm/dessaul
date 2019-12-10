<?php

namespace App\Admin\Controllers;

use App\Admin\DataBase\Category;
use App\Admin\DataBase\NavCategory;
use App\Admin\DataBase\Product;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Route;

class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '产品管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product);
        $grid->column('id', __('Id'))->hide();
        $grid->column('navcategory.name', '品牌');
        $grid->column('category.name', '产品类别');
        $grid->column('model','产品型号');
        $grid->column('name','产品名称');
//        $grid->column('images','产品图片');
//        $grid->column('desc', '产品说明');
       $grid->column('explain','说明文件');
        $grid->column('downfile','下载文件');
        $grid->column('downdriver','下载驱动');
        $grid->column('created_at', '建立日期');
        $grid->column('updated_at', '更新日期');


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
        $show = new Show(Product::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('parent_id', __('Parent id'));
        //$show->field('images', '产品');
        $show->field('files', '产品文件');
        $show->field('categoryid','产品类别');
        $show->field('name', '产品名称');
        $show->field('model', '产品型号');
        $show->field('desc','产品说明');
        $show->field('created_at', '建立日期');
        $show->field('created_at', '建立日期');

        return $show;
    }

    /**
     * Make a form builder.
     * @return Form
     */


    protected function form()
    {
        $form = new Form(new Product);
        if(Route::currentRouteName() == 'product.edit')
        {$data=Product::findOrFail(request()->route()->parameters()['product'])->toArray();}
        else {
            $data=Product::where('parent_id')->first();
        }

        $form->select('parent_id',"品牌")->options(NavCategory::pluck("name","id"))
            ->load('category_id','/api/getcategory');
        $form->select('category_id','产品类别')->options(Category::where('navcategory_id','=',$data['parent_id'])->pluck("name","id"));
        $form->text('name', __('产品名称'));
        $form->text('model','产品型号');
        $form->image('images','图片')->removable();
        $form->file('explain', __('说明文件'))->removable();
        $form->file('downfile', __('下载文件'))->removable();
        $form->file('downdriver', __('下载驱动'))->removable();
        $form->textarea('desc', __('产品说明'));





        return $form;
    }
}
