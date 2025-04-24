<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\Cart;

class UserHomeController extends Controller
{
    public function home()
    {
        $product = Product::all();

        if (Auth::check()) {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
        } else {
            $count = '';
        }        

        return view('home.index',compact('product', 'count'));
    }

    public function login_home()
    {
        $product = Product::all();

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

        return view('home.index',
        compact('product', 'count'));
    }
}
