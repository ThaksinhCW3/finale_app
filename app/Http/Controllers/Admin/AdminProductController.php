<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Models\Category;
use App\Models\Product;

class AdminProductController extends Controller
{
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

        toastr()->closeButton()->timeOut(5000)
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

        toastr()->closeButton()->timeOut(5000)
        ->success(message: 'Product has been deleted Successfully');

        return redirect()->back();
    }
    //? Edit Product
    public function edit_product($id)
    {
        $data = Product::find($id);
        $categories = Category::all();

        return view('admin.product.edit_product', compact('data', 'categories'));
    }
    //!Update Product
    public function update_product(Request $request,$id)
    {
        $data = Product::find($id);

        $data->title =  $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->quantity = $request->quantity;
        $data->category = $request->category;

        $image = $request->image;

        if($image)
        {
        // Delete the old image if it exists
            if ($data->image) {
                $oldImagePath = public_path('products/' . $data->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $imagename = time().'.'.$image->getClientOriginalExtension();

            $request->image->move("products", $imagename);

            $data->image = $imagename;
        }

        $data->save();

        toastr()->closeButton()->timeOut(5000)
            ->success(message: 'Product has been updated Successfully');

        return redirect('admin/product/view_product');
    }
    public function product_search(Request $request)
    {
        $search = $request->search;

        $product = Product::where('title', 'LIKE',
         '%'.$search.'%')->paginate(3);

         return view('admin.product.view_product', compact('product'));
    }
}
