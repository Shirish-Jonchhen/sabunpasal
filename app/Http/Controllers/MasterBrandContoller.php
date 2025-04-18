<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class MasterBrandContoller extends Controller
{
    public function store_brand(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:brands,slug',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'website_url' => 'nullable|url',

        ]);

        Brand::create([
            'name' => $validate['name'],
            'slug' => $validate['slug'],
            'description' => $validate['description'] ?? null,
            'website_url' => $validate['website_url'] ?? null,
            'is_featured' => $request->has('is_featured') ? 1 : 0,
            'meta_title' => $request->input('meta_title'),
            'meta_description' => $request->input('meta_description'),
            'logo_path' => $request->file('image') ? $request->file('image')->store('brand_logos', 'public') : null,
        ]);


        return redirect()->back()->with('success', 'Brand Added successfully');
    }



    public function show_single_brand($id)
    {
        $brand_info = Brand::find($id);
        return view('admin.brand.edit', compact('brand_info'));
    }


    public function delete_brand($id)
    {
        $brand = Brand::findOrFail($id);
        // Delete associated image from storage
        if ($brand->logo_path) {
            $imagePath = public_path('storage/' . $brand->logo_path);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        // Delete the brand
        $brand->delete();

        return redirect()->back()->with('success', 'Brand Deleted successfully');
    }






    public function update_brand(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);
        // dd($request);
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:brands,slug,' . $id,
            'description' => 'nullable|string',
            'new_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deleted_image' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'website_url' => 'nullable|url',
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
            $validate['logo_path'] = $request->file('new_image')->store('brand_logos', 'public');
        }
        $brand->update([
            'name' => $validate['name'],
            'slug' => $validate['slug'],
            'description' => $validate['description'] ?? null,
            'website_url' => $validate['website_url'] ?? null,
            'is_featured' => $request->has('is_featured') ? 1 : 0,
            'meta_title' => $request->input('meta_title'),
            'meta_description' => $request->input('meta_description'),
        ]);

        // If a new image is uploaded, update the logo_path
        if ($request->hasFile('new_image')) {
            $brand->update(['logo_path' => $validate['logo_path']]);
        }

        return redirect()->back()->with('success', 'Brand Updated successfully');

    }
}
