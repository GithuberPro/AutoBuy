<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $where = [];
        if ($request->input('product_id')) {
            $where[] = ['product_id', $request->input('product_id')];
        }
        $orders = Order::where($where)->orderBy('id', 'desc')->paginate(15);
        return view('backend.order.index', compact('orders'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        flash()->success('删除成功');
        return redirect()->back();
    }

}
