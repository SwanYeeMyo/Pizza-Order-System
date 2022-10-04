<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function productList()
    {
        $products = Product::all();
        $users = User::all();
        $data = [
            'proudcts' => $products,
            'users' => $users,
        ];
        return response()->json($data, 200);
    }
    public function categoryList()
    {
        $category = Category::all();
        return response()->json($category, 200);
    }
    public function categoryCreate(Request $request)
    {
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $response = Category::create($data);
        return response()->json($response, 200);
    }
    public function createContact(Request $request)
    {
        $contact = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        Contact::create($contact);
        return response()->json($contact, 200);
    }
    public function deleteCategory(Request $request)
    {
        $data = Category::where('id', $request->category_id)->first();
        if ($data) {
            Category::where('id', $request->category_id)->delete();
            return response()->json(['status' => 'true', 'message' => 'delete success'], 200);
        }
        return response()->json(['status' => 'false', 'message' => 'There is no category'], 200);

    }

}
