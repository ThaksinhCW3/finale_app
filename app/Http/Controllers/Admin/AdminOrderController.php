<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Order;


class AdminOrderController extends Controller
{
    public function view_order()
    {
        $data = Order::all();

        return view('admin.order.view_order', compact('data'));
    }
    public function on_the_way_order($id)
    {
        $data = Order::find($id);

        $data->status = 'On the way';

        $data->save();

        toastr()->closeButton()->timeOut(5000)
            ->success(message: 'Order Status has been changed succesfully');

        return redirect('admin/order/view_order');
    }
    public function delivered_order($id)
    {
        $data = Order::find($id);

        $data->status = 'Delivered';

        $data->save();

        toastr()->closeButton()->timeOut(5000)
            ->success(message: 'Order Status has been changed succesfully');

        return redirect('admin/order/view_order');
    }
    public function print_pdf($id)
    {

        $data = Order::find($id);

        $pdf = Pdf::loadView('admin.order.invoice', compact('data'));

        return $pdf->download('invoice.pdf');
    }
}
