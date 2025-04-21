<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\DefaultAttribute;
use App\Models\Store;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class VendorProductController extends Controller
{
    public function index()
    {

        $stores = Store::where('user_id', Auth::user()->id)->get();
        return view('vendor.product.create', compact('stores'));
    }

    public function manage()
    {
        $products = Product::where('vendor_id', Auth::user()->id)->get();
        return view('vendor.product.manage', compact('products'));
    }

    public function store_product(Request $request)

    {
        $validate = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sku'  => 'required|string|unique:products,sku',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:sub_categories,id',
            'store_id' => 'required|exists:stores,id',
            // 'regular_price' => 'required|numeric|min:0',
            'is_on_sale' => 'nullable|boolean',
            // 'discounted_price' => 'nullable|numeric|lt:regular_price|required_if:is_on_sale,1',
            'tax_rate' => 'required|numeric|min:0|max:100',
            // 'stock_quantity' => 'required|integer|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => 'required|string|unique:products,slug',
        ]);

        $product = Product::create([
            'product_name' => $validate['product_name'],
            'description' => $validate['description'],
            'sku' => $validate['sku'],
            'vendor_id' => Auth::user()->id,
            'category_id' => $validate['category_id'],
            'subcategory_id' => $validate['subcategory_id'],
            'store_id' => $validate['store_id'],
            // 'regular_price' => $validate['regular_price'],
            // 'discounted_price' => $validate['discounted_price'],
            'tax_rate' => $validate['tax_rate'],
            // 'stock_quantity' => $validate['stock_quantity'],
            'slug' => $validate['slug'],
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                ProductImage::create(attributes: [
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'is_primary' => false,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Product Added successfully');
    }

    public function delete_product($id)
    {
        $product = Product::findOrFail($id);

        // Delete associated images from storage
        if ($product->images) {
            foreach ($product->images as $image) {
                $imagePath = public_path('storage/' . $image->image_path);

                // Check if the file exists and delete it
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }

                // Delete image record from the database
                $image->delete();
            }
        }

        // Delete the product
        $product->delete();

        return redirect()->back()->with('success', 'Product Deleted successfully');
    }


    public function show_single_product($id)
    {
        $product = Product::findOrFail($id);
        return view('vendor.product.edit', compact('product'));
    }

    public function update_product(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $validate = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sku' => ['required', 'string', Rule::unique('products', 'sku')->ignore($id)],
            // 'category_id' => 'required|exists:categories,id',
            // 'subcategory_id' => 'nullable|exists:sub_categories,id',
            // 'store_id' => 'required|exists:stores,id',
            'visibility' => 'nullable|boolean',
            // 'regular_price' => 'required|numeric|min:0',
            // 'discounted_price' => 'nullable|numeric|min:0',
            'tax_rate' => 'required|numeric|min:0|max:100',
            // 'stock_quantity' => 'required|integer|min:0',
            'new_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => ['required', 'string', Rule::unique('products', 'slug')->ignore($id)],
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'stock_status' => 'nullable|string',
            'status' => 'nullable|string',
        ]);
        // dd($validate);

        $validate['visibility'] = $request->has('visibility') ? 1 : 0;
        $validate['is_on_sale'] = $request->has('is_on_sale') ? 1 : 0;

        if ($request->filled('deleted_images')) {
            $deletedImageIds = explode(',', $request->deleted_images);
            foreach ($deletedImageIds as $imageId) {
                $image = ProductImage::find($imageId);
                if ($image) {
                    $imagePath = public_path('storage/' . $image->image_path);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }

                    // Delete from database
                    $image->delete();
                }
            }
        }

        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $file) {
                $path = $file->store('product_images', 'public'); // Save image to storage

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
            }
        }


        $product->update($validate);
        return redirect()->back()->with('success', 'Product Updated successfully');
    }






    //variant 
    public function index_variant(){
        $products = Product::where('vendor_id', Auth::user()->id)->get();
        $attributes = DefaultAttribute::all();
        return view('vendor.product.variant.create', compact('products','attributes'));
    }


    public function manage_variant(){
        $product_variants = ProductVariant::whereHas('product', function ($query) {
            $query->where('vendor_id', Auth::user()->id);
        })->get();
        return view('vendor.product.variant.manage', compact('product_variants'));
    }

    public function store_product_variant(Request $request){
        $validate = $request->validate([
            'product_id' => 'required|exists:products,id',
            'attribute_id' => 'required|exists:default_attributes,id',
            'regular_price' => 'required|numeric|min:0',
            'discounted_price' => 'nullable|numeric|lt:regular_price',
            'stock_quantity' => 'required|integer|min:0',
            'product_id' => [
                'required',
                'integer',
                Rule::unique('product_variants')->where(function ($query) use ($request) {
                    return $query->where('attribute_id', $request->attribute_id);
                })
            ]
        ]);

        ProductVariant::create([
            'product_id' => $validate['product_id'],
            'attribute_id' => $validate['attribute_id'],
            'regular_price' => $validate['regular_price'],
            'discounted_price' => $validate['discounted_price'],
            'stock_quantity' => $validate['stock_quantity'],
        ]);
        return redirect()->back()->with('success', 'Product Variant Added successfully');
    }

    public function delete_product_variant($id)
    {
        $product_variant = ProductVariant::findOrFail($id);

        // Delete the product variant
        $product_variant->delete();

        return redirect()->back()->with('success', 'Product Variant Deleted successfully');
    }

    public function show_single_product_variant($id)
    {
        $product_variant = ProductVariant::findOrFail($id);
        return view('vendor.product.variant.edit', compact('product_variant'));
    }

    public function update_product_variant(Request $request, $id)
    {
        $product_variant = ProductVariant::findOrFail($id);
        $validate = $request->validate([
            // 'product_id' => 'required|exists:products,id',
            // 'attribute_id' => 'required|exists:default_attributes,id',
            'regular_price' => 'required|numeric|min:0',
            'discounted_price' => 'nullable|numeric|lt:regular_price',
            'stock_quantity' => 'required|integer|min:0',
        ]);

        $product_variant->update($validate);
        return redirect()->back()->with('success', 'Product Variant Updated successfully');
    }
}
