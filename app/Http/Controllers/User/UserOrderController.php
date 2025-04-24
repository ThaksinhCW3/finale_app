<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\Order;

class UserOrderController extends Controller
{
    public function confirm_order(Request $request)
    {
        $name = $request->name;
        $address = $request->address;
        $phone = $request->phone;
        $userid = Auth::user()->id;
        $cart = Cart::where('user_id', $userid)->get();

        foreach($cart as $carts)
        {
            $order = new Order;

            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->user_id = $userid;
            
            $order->product_id = $carts->product_id;
            $order->save();
        }

            $cart_remove = Cart::where('user_id', $userid)->
            get();

            foreach($cart_remove as $remove)
            {
                $data = Cart::find($remove->id);

                $data->delete();
            }

            toastr()->closeButton()->timeOut(5000)
            ->success(message: 'Products has been ordered succesfully');

            return redirect()->back();
    }
    //User's Orders
    public function my_order()
    {

        $user = Auth::user()->id;

        $count = Order::where('user_id', $user)
        ->get()->count();

        $order = Order::where('user_id', $user)->get();

        return view('home.order.my_order', compact('count',
    'order'));
    }
}
