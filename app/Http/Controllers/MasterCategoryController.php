<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class MasterCategoryController extends Controller
{
    //
    public function storecat(Request $request)
    {
        $validate = $request->validate([
            'category_name' => 'required|unique:categories|string|max:255|min:3',
        ]);

        Category::create($validate);
        return redirect()->back()->with('success', 'Category Created Successfully');
    }

    public function show_single_category($id)
    {
        $category_info = Category::find($id);
        return view("admin.category.edit", compact('category_info'));
    }

    public function update_category(Request $request, $id)
    {

        $category = Category::findOrFail($id);
        $validate = $request->validate([
            'category_name' => 'required|unique:categories|string|max:255|min:3',
        ]);

        $category->update($validate);
        return redirect()->back()->with('success', 'Category Updated Successfully');
    }

    public function delete_category($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success', 'Category Deleted Successfully');
    }
}
