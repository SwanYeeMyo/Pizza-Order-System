<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function home()
    {
        $orders = Order::where('user_id', Auth::user()->id)->get();
        $pizzas = Product::get();
        $categories = Category::get();
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        return view('user.main.home', compact('pizzas', 'categories', 'carts', 'orders'));
    }
    //filter
    public function filter($categoryId)
    {
        $orders = Order::where('user_id', Auth::user()->id)->paginate(6);
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        $pizzas = Product::where('category_id', $categoryId)->orderBy('created_at', 'desc')->get();
        $categories = Category::get();
        return view('user.main.home', compact('pizzas', 'categories', 'carts', 'orders'));
    }
    //detail
    public function pizzaDetail($productId)
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        $pizza = Product::where('id', $productId)->first();
        return view('user.main.details', compact('pizza', 'carts'));
    }
    public function cart()
    {
        $carts = Cart::Select('carts.*', 'products.name as pizza_name', 'products.price as pizza_price', 'products.image as image')->leftJoin('products', 'products.id', 'carts.product_id')->where('user_id', Auth::user()->id)->get();

        $totalPrice = 0;
        foreach ($carts as $cart) {
            $totalPrice += $cart->pizza_price * $cart->qty;
        }
        $total = $totalPrice;
        return view('user.main.cart', compact('carts', 'total'));
    }
    public function order(Request $request)
    {
        $orders = Order::where('user_id', Auth::user()->id)->paginate(6);
        //dd($orders->toArray());
        $orders->appends($request->all());
        return view('user.main.history', compact('orders'));
    }
    public function pwChangePage()
    {
        return view('user.account.pwChange');
    }

    public function pwChange(Request $request)
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        $this->validationCheck($request);
        $userId = Auth::user()->id;
        $data = [
            'password' => Hash::make($request->newPassword),
        ];
        $oldPw = User::where('id', $userId)->first();
        $oldHashValue = $oldPw->password;
        if (Hash::check($request->oldPassword, $oldHashValue)) {
            User::where('id', $userId)->update($data);
            return back()->with(['success' => 'update Succss']);
        }
        return back()->with(['notMatch' => 'Old password doest not match. Try again']);
    }
    public function profileChange()
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        return view('user.account.account', compact('carts'));
    }
    public function change(Request $request)
    {
        $this->validationData($request);
        $data = $this->getUserData($request);
        if ($request->hasfile('image')) {
            $oldImage = User::where('id', Auth::user()->id)->first();
            $oldImage = $oldImage->image;

            if ($oldImage != null) {
                Storage::delete('public/' . $oldImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/', $fileName);
            $data['image'] = $fileName;
        }

        User::where('id', Auth::user()->id)->update($data);
        return \redirect()->route('user#profileChange')->with(['success' => 'Update Success']);

    }
    public function contentForm(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];
        Contact::create($data);
        return \redirect()->route('user#home')->with(['successSent' => 'Well receive']);
    }
    private function validationCheck($request)
    {
        Validator::make(
            $request->all(),
            [
                'oldPassword' => 'required|min:6',
                'newPassword' => 'required|min:6',
                'confirmPassword' => 'required|min:6|same:newPassword',

            ]
        )->validate();
    }
    private function getUserData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
    }
    private function validationData($request)
    {
        Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required',
                'image' => 'mimes:jpg,jpeg,png|file',
                'phone' => 'required',
                'gender' => 'required',
                'address' => 'required',

            ]
        )->validate();
    }
}
