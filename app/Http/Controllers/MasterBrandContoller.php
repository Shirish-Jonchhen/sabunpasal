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

    public function show_single_brand($id){
        $brand_info = Brand::find($id);
        return view('admin.brand.edit', compact('brand_info'));
        
    }
    
    public function delete_brand($id){
        $brand = Brand::findOrFail($id);
        $brand->delete();
        return redirect()->back()->with('success', 'Brand Removed Successfully');

    }

   
}
