<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\SubCategory;
// use App\Http\Requests;
// use App\Http\Controllers\Controller;


class MasterSubCategoryController extends Controller
{
    public function store_subcat(Request $request)
    {
        $validation = $request->validate([
            'subcategory_name' => 'required|unique:sub_categories|string|max:255|min:3',
            'category_id' => 'required|exists:categories,id',
        ]);

        SubCategory::create($validation);
        return redirect()->back()->with('success', 'Sub Category Created Successfully');
    }

    public function show_single_subcategory($id)
    {
        $subcategory_info = SubCategory::find($id);
        return view("admin.sub_category.edit", compact('subcategory_info'));
    }

    public function update_subcategory(Request $request, $id)
    {

        $category = SubCategory::findOrFail($id);
        $validation = $request->validate([
            'subcategory_name' => 'required|unique:sub_categories|string|max:255|min:3',
            // 'category_id' => 'required|exists:categories,id',
        ]);

        $category->update($validation);
        return redirect()->back()->with('success', 'Sub Category Updated Successfully');
    }

    public function delete_subcategory($id)
    {
        $category = SubCategory::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success', 'Sub Category Deleted Successfully');
    }

}
