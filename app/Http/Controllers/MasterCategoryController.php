<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class MasterCategoryController extends Controller
{
    //
    public function storecat(Request $request)
    {

        // dd($request);
        $validate = $request->validate([
            'category_name' => 'required|unique:categories|string|max:255|min:3',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => 'required|string|unique:categories,slug',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        // Handle the image upload

        $imagePath = $request->file('image')->store('category_images', 'public');


        Category::create([
            'category_name' => $validate['category_name'],
            'slug' => $validate['slug'],
            'description' => $validate['description'] ?? null,
            'meta_title' => $validate['meta_title'] ?? null,
            'meta_description' => $validate['meta_description'] ?? null,
            'icon_path' => $imagePath,
            'is_featured' => $request->has('is_featured') ? 1 : 0,
        ]);
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
            'category_name' => 'required|string|min:3|max:255|unique:categories,category_name,' . $id,
    'slug' => 'required|string|unique:brands,slug,' . $id,
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
            $validate['icon_path'] = $request->file('new_image')->store('brand_logos', 'public');
        }
        $category->update([
            'category_name' => $validate['category_name'],
            'slug' => $validate['slug'],
            'description' => $validate['description'] ?? null,
            'is_featured' => $request->has('is_featured') ? 1 : 0,
            'meta_title' => $request->input('meta_title'),
            'meta_description' => $request->input('meta_description'),
        ]);
        // If a new image is uploaded, update the logo_path
        if ($request->hasFile('new_image')) {
            $category->update(['icon_path' => $validate['icon_path']]);
        }
        return redirect()->back()->with('success', 'Category Updated Successfully');
    }

    public function delete_category($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success', 'Category Deleted Successfully');
    }
}
