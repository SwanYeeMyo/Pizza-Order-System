<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function createPage()
    {
        $categories = Category::select('id', 'name', )->get();
        return view('admin.product.pizzaCreate', compact('categories'));
    }
    function list(Request $request) {
        //  orderby('id', 'desc')->paginate(3)
        $product = Product::all();
        $products = Product::select('products.*', 'categories.name as category_name')->when(request('Key'), function ($product) {
            $searchKey = request('Key');
            $product->where('products.name', 'like', '%' . $searchKey . '%');
        })->join('categories', 'products.category_id', 'categories.id')->orderBy('id', 'desc')->paginate(3);

        $products->appends($request->all());
        return view('admin.product.pizzaList', \compact('products'));
    }
    public function create(Request $request)
    {
        $this->productValidationCheck($request, "create");
        $data = $this->getProductData($request);
        if ($request->hasFile('productImage')) {
            $fileName = \uniqid() . $request->file('productImage')->getClientOriginalName();
            $request->file('productImage')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }
        Product::create($data);
        return \redirect()->route('product#list')->with(['success' => 'Create Success']);
    }
    public function detail($id)
    {
        $product = Product::select('products.*', 'categories.name as category_name')->where('products.id', $id)->leftJoin('categories', 'products.category_id', 'categories.id')->first();
        return view('admin.product.details', compact('product'));
    }
    public function updatePage($id)
    {
        $categories = Category::select('id', 'name')->get();
        $product = Product::where('id', $id)->first();
        return view('admin.product.edit', compact('product', 'categories'));
    }
    public function update(Request $request)
    {
        $this->productValidationCheck($request, "update");
        $data = $this->getProductData($request);
        if ($request->hasFile('productImage')) {
            $oldImageName = Product::where('id', $request->pizzaId)->first();
            $oldImageName = $oldImageName->image;
            if ($oldImageName != null) {
                Storage::delete('public/' . $oldImageName);
            }
            $fileName = \uniqid() . $request->file('productImage')->getClientOriginalName();
            $request->file('productImage')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }
        Product::where('id', $request->pizzaId)->update($data);
        return \redirect()->route('product#list')->with(['success' => 'Update Success']);

    }
    private function getProductData($request)
    {
        return [
            'name' => $request->productName,
            'category_id' => $request->category,
            'description' => $request->productDescription,
            'price' => $request->productPrice,
            'waiting_time' => $request->productTime,
        ];
    }
    private function productValidationCheck($request, $action)
    {

        $validationRule = [
            'productName' => 'required||unique:products,name,' . $request->pizzaId,
            'category' => 'required',
            'productDescription' => 'required|min:10',
            'productPrice' => 'required',
            'productTime' => 'required',
            // 'productImage' => 'required|mimes:jpg,jpeg,png|file',
        ];
        $validationRule['productImage'] = $action == "create" ? 'required|mimes:jpg,jpeg,png|file' : "mimes:jpg,jpeg,png|file";

        Validator::make($request->all(), $validationRule)->validate();
    }
}
