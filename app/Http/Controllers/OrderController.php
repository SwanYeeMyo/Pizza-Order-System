<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function list(Request $request) {
        $orders = Order::select('orders.*', 'users.name as user_name')->leftJoin('users', 'users.id', 'orders.user_id')->when(request('Key'), function ($query) {
            $searchKey = request('Key');
            $query->where('order_code', 'like', '%' . $searchKey . '%');

        })

            ->paginate(6);

        $orders->appends($request->all());
        return \view('admin.order.list', \compact('orders'));
    }
    public function changeStatus(Request $request)
    {
        $orders = Order::select('orders.*', 'users.id as user_id', 'users.name as user_name')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->orderBy('created_at', 'desc');

        //query kwal yay lox ya
        if ($request->orderStatus == null) {
            $orders = $orders->paginate(6);
        } else {
            $orders = $orders->where('status', $request->orderStatus)->paginate(6);
        }
        return \view('admin.order.list', \compact('orders'));

        // return response()->json($order, 200);P
    }
    public function ajaxChangeStatus(Request $request)
    {
        Order::where('id', $request->orderId)->update(
            [
                'status' => $request->status,
            ]);
    }
    public function listInfo($orderCode)
    {
        $order = Order::where('order_code', $orderCode)->first();
        $ordersList = OrderList::select('order_lists.*', 'users.name as user_name', 'products.name as product_name',
            'products.image as product_image')
            ->leftJoin('users', 'users.id', 'order_lists.user_id')
            ->leftJoin('products', 'products.id', 'order_lists.product_id')->where('order_code', $orderCode)->get();
        // dd($ordersList->toArray());
        return view('admin.order.productList', compact('ordersList', 'order'));
    }
}
