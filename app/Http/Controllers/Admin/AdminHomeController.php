<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class AdminHomeController extends Controller
{
    public function index()
    {
        $user = User::where('usertype', 'user')->count();
        $product = Product::count();
        $order = Order::count();
        $delivered = Order::where('status', 'Delivered')->count();

        return view('admin.index', compact('user', 'product', 'order', 'delivered'));
    }
}
