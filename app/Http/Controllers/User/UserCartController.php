<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\Cart;
use App\Models\Order;
use Stripe;

class UserCartController extends Controller
{
    public function add_cart($id)
    {
        $product_id = $id;
        $user = Auth::user();
        $user_id = $user->id;

        $data = new Cart;

        $data->user_id = $user_id;
        $data->product_id = $product_id;

        $data->save();

        toastr()->closeButton()->timeOut(5000)
        ->success(message: 'Product has been added to cart');

        return redirect()->back();
    }
    public function my_cart()
    {
        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id', $userid)->count();
            $cart = Cart::where('user_id', $userid)->get();
        }
        return view('home.cart.my_cart', compact('count', 'cart'));
    }
    public function stripe($value)
    {
        return view('home.cart.stripe', compact('value'));
    }
    public function stripePost(Request $request, $value)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
                "amount" => $value * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment complete" 
        ]);

        $name = Auth::user()->name;
        $phone = Auth::user()->phone;
        $address = Auth::user()->address;
        $userid = Auth::user()->id;
        $cart = Cart::where('user_id', $userid)->get();

        foreach($cart as $carts)
        {
            $order = new Order;

            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;
            $order->user_id = $userid;

            $order->payment_status = "paid";
            
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

            return redirect('cart/my_cart');
    }
}
