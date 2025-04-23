<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;

class AdminController extends Controller
{
    public function view_category()
    {
        $data = Category::all();
        return view('admin.category.view_category', compact('data'));
    }
    //? add
    public function add_category(Request $request)
    {
        $category = new Category  ;

        $category->category_name = $request->category;

        $category->save();

        toastr()->closeButton()->timeOut(50000)
        ->success(message: 'Category Added Successfully');

        return redirect()->back();
    }
    //! delete
    public function delete_Category($id)
    {
        $data = Category::find($id);
        $data->delete();

        toastr()->closeButton()->timeOut(50000)
        ->success(message: 'Category has been deleted Successfully');

        return redirect()->back();
    }
    //? edit
    public function edit_Category($id)
    {
        $data = Category::find($id);
        return view('admin.category.edit_category', compact('data'));
    }
    public function update_Category(Request $request, $id)
    {
        $data = Category::find($id);
        $data->category_name= $request->category;
        $data->save();

        toastr()->closeButton()->timeOut(50000)
        ->success(message: 'Category has been updated Successfully');

        return redirect('admin/category/view_category');
    }

    //PRODUCT
    public function add_product()
    {
        $category = Category::all();

        return view('admin.product.add_product', compact('category'));
    }
    //? Upload Product
    public function upload_product(Request $request)
    {
        $data = new Product;

        $data->title =  $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->quantity = $request->quantity;
        $data->category = $request->category;

        $image = $request->image;

        if($image)
        {
            $imagename = time().'.'.$image->
            getClientOriginalExtension();

            $request->image->move("products", $imagename);

            $data->image = $imagename;
        }

        toastr()->closeButton()->timeOut(50000)
        ->success(message: 'Product has been upload Successfully');
        
        $data->save();

        return redirect()->back();
    }
    //? View Product page
    public function view_product(){
        $product = Product::paginate(1);
        return view('admin.product.view_product', compact('product'));
    }

    public function delete_product($id){
        $data = Product::find($id);

        $image_path=public_path('products/'.$data->image);

        if(file_exists($image_path))
        {
            unlink($image_path);
        }

        $data->delete();

        toastr()->closeButton()->timeOut(50000)
        ->success(message: 'Product has been deleted Successfully');

        return redirect()->back();
    }

    }
