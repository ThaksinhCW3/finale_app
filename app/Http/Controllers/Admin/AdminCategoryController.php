<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\File;

use App\Models\Category;

class AdminCategoryController extends Controller
{
    //! VIEW CATEGORY
    public function view_category()
    {
        $data = Category::all();
        return view('admin.category.view_category', compact('data'));
    }
    //! add category
    public function add_category(Request $request)
    {
        $category = new Category  ;

        $category->category_name = $request->category;

        $category->save();

        toastr()->closeButton()->timeOut(5000)
        ->success(message: 'Category Added Successfully');

        return redirect()->back();
    }
    //! delete category
    public function delete_Category($id)
    {
        $data = Category::find($id);
        $data->delete();

        toastr()->closeButton()->timeOut(5000)
        ->success(message: 'Category has been deleted Successfully');

        return redirect()->back();
    }
    //! edit category
    public function edit_Category($id)
    {
        $data = Category::find($id);
        return view('admin.category.edit_category', compact('data'));
    }
    //! UPDATE CATEGORY
    public function update_Category(Request $request, $id)
    {
        $data = Category::find($id);
        $data->category_name= $request->category;
        $data->save();

        toastr()->closeButton()->timeOut(5000)
        ->success(message: 'Category has been updated Successfully');

        return redirect('admin/category/view_category');
    }
}
