<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function pizzaList(Request $request)
    {
        // logger($request->status);
        if ($request->status == 'desc') {
            $data = Product::orderBy('created_at', 'desc')->get();
        } else {
            $data = Product::orderBy('created_at', 'asc')->get();
        }

        return $data;
    }

    public function addToCart(Request $request)
    {
        $data = $this->getOrderData($request);
        Cart::create($data);
        return [
            'status' => 'success',
            'message' => 'Add To Cart Complete',
        ];
    }
    public function order(Request $request)
    {
        $total = 0;
        foreach ($request->all() as $item) {
            $data = OrderList::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'total' => $item['total'],
                'order_code' => $item['order_code'],
            ]);
            $total += $data->total;
        }
        logger($total);
        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $total + 3000,
        ]);
        Cart::where('user_id', Auth::user()->id)->delete();
        return \response()->json([
            'status' => 'true',
            'message' => 'order completed',
        ], 200);

    }
    public function clear()
    {
        Cart::where('user_id', Auth::user()->id)->delete();

    }
    public function remove(Request $request)
    {
        Cart::where('user_id', Auth::user()->id)->where('id', $request->orderId)->where('product_id', $request->productId)->delete();
    }
    public function viewCount(Request $request)
    {
        logger($request->all());
        $pizza = Product::where('id', $request->productId)->first();
        $viewCount = [
            'view_count' => $pizza->view_count + 1,
        ];
        Product::where('id', $request->productId)->update($viewCount);
    }
    private function getOrderData($request)
    {
        return [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'qty' => $request->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
