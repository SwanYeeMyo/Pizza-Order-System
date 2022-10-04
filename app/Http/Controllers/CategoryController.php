<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // direct category list page
    function list() {
        $categories = Category::When(request('Key'), function ($query) {
            $searchKey = \request('Key');
            $query->where('name', 'like', '%' . $searchKey . '%');
        })

            ->paginate(6);
        $categories->appends(request()->all());
        return view('admin.category.list', compact('categories'));
    }
    // direct category create page
    public function createPage()
    {
        return view('admin.category.create');
    }
    // direct category createPage
    public function create(Request $request)
    {
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::create($data);
        return \redirect()
            ->route('category#list')
            ->with(['success' => 'Create Success']);
    }
    // direct Category Delete
    public function delete($id)
    {
        $category = Category::where('id', $id)->delete();
        return redirect()
            ->route('category#list')
            ->with(['success' => 'Delete Success']);
    }
    // edit category
    public function edit($id)
    {
        $category = Category::where('id', $id)->first();
        return \view('admin.category.update', compact('category'));
    }
    public function update(Request $request)
    {
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::where('id', $request->categoryId)->update($data);
        return \redirect()
            ->route('category#list')
            ->with(['success' => 'Update Success ']);
    }
    private function categoryValidationCheck($request)
    {
        Validator::make($request->all(), [
            'categoryName' =>
            'required|min:4|unique:categories,name,' . $request->categoryId,
        ])->validate();
    }
    private function requestCategoryData($request)
    {
        return ['name' => $request->categoryName];
    }
}
