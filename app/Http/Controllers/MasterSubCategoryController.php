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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => 'required|string|unique:sub_categories,slug',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        $imagePath = $request->file('image')->store('subcategory_images', 'public');


        SubCategory::create([
            'subcategory_name' => $validation['subcategory_name'],
            'category_id' => $request->category_id,
            'slug' => $validation['slug'],
            'description' => $validation['description'] ?? null,
            'meta_title' => $validation['meta_title'] ?? null,
            'meta_description' => $validation['meta_description'] ?? null,
            'icon_path' => $imagePath,
            'is_featured' => $request->has('is_featured') ? 1 : 0,
        ]);
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
            'subcategory_name' => 'required|string|min:3|max:255|unique:sub_categories,subcategory_name,' . $id,
            // 'category_id' => 'required|exists:categories,id',
            'slug' => 'required|string|unique:sub_categories,slug,' . $id,
            'description' => 'nullable|string',
            'new_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deleted_image' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
        ]);


        if ($request->filled('deleted_image') && !$request->hasFile('new_image')) {
            return back()->withErrors([
                'new_image' => 'The new image is required in place of deleted image.',
            ])->withInput();
        }

        if ($request->hasFile('new_image') && !$request->filled('deleted_image')) {
            return back()->withErrors([
                'deleted_image' => 'The deleted image is required when a new image is uploaded.',
            ])->withInput();
        }

        if ($request->filled('deleted_image')) {
            $deletedImagePath = public_path('storage/' . $request->input('deleted_image'));
            if (file_exists($deletedImagePath)) {
                unlink($deletedImagePath);
            }
        }
        if ($request->hasFile('new_image')) {
            $validate['icon_path'] = $request->file('new_image')->store('subcategories_icons', 'public');
        }

        $category->update([
            'subcategory_name' => $validation['subcategory_name'],
            'slug' => $validation['slug'],
            'description' => $validation['description'] ?? null,
            'is_featured' => $request->has('is_featured') ? 1 : 0,
            'meta_title' => $request->input('meta_title'),
            'meta_description' => $request->input('meta_description'),
        ]);

        if ($request->hasFile('new_image')) {
            $category->update(['icon_path' => $validate['icon_path']]);
        }
        return redirect()->back()->with('success', 'Sub Category Updated Successfully');
    }

    public function delete_subcategory($id)
    {
        $category = SubCategory::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success', 'Sub Category Deleted Successfully');
    }
}
