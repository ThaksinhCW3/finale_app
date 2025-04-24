<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\Cart;
// use App\Models\Order;
// use App\Models\User;

class UserProductController extends Controller
{
    public function details_product($id)
    {
        $data = Product::find($id);

        if(Auth::id())
        {
            $user = Auth::user();

            $userid = $user->id;
        
            $count = Cart::where('user_id', $userid)->count();
        }
        else
        {
            $count = '';
        }

        return view('home.product.product_details',
         compact('data', 'count'));
    }
}
