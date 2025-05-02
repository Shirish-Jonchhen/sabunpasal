<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\DefaultAttribute;
use App\Models\Store;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\VariantPrice;
use App\Models\VariantImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


class VendorProductController extends Controller
{
    public function index()
    {

        $stores = Store::where('user_id', Auth::user()->id)->get();
        $brands = Brand::all();
        $units = DefaultAttribute::all();
        return view('vendor.product.create', compact('stores', 'brands', 'units'));
    }

    public function manage()
    {
        $products = Product::where('vendor_id', Auth::user()->id)->get();
        return view('vendor.product.manage', compact('products'));
    }

    public function store_product(Request $request)

    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sku' => 'required|string|max:255|unique:products',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:sub_categories,id',
            'brand_id' => 'required|exists:brands,id',
            'store_id' => 'required|exists:stores,id',
            'tax_rate' => 'required|numeric',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string|max:255',
            'images.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048', // Validate product images
            'variants.*.flavor' => 'string|max:255',
            'variants.*.size' => 'string|max:255',
            'variants.*.prices.*.unit' => 'required|string|max:50',
            'variants.*.prices.*.price' => 'required|numeric',
            'variants.*.prices.*.stock' => 'required|integer',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Start transaction to ensure data integrity
        DB::beginTransaction();

        try {
            // Create product
            $product = Product::create([
                'name' => $request->product_name,
                'description' => $request->description,
                'sku' => $request->sku,
                'vendor_id' => Auth::user()->id,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'store_id' => $request->store_id,
                'brand_id' => $request->brand_id,
                'tax_rate' => $request->tax_rate,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'status' => 'active', // You can set default status as needed
                'is_on_sale' => false, // Adjust as needed
            ]);

            // // Save product images
            // if ($request->hasFile('images')) {
            //     foreach ($request->file('images') as $image) {
            //         $imagePath = $image->store('products', 'public');
            //         $product->images()->create([
            //             'image_path' => $imagePath,
            //         ]);
            //     }
            // }

            // Process variants
            foreach ($request->variants as $variantData) {
                $variant = ProductVariant::create([
                    'product_id' => $product->id,
                    'size' => $variantData['size'],
                    'variant_name' => $variantData['flavor'],
                ]);

                // Process variant prices
                foreach ($variantData['prices'] as $priceData) {
                    VariantPrice::create([
                        'product_variant_id' => $variant->id,
                        'unit_id' => $priceData['unit'],  // Assuming unit is a DefaultAttribute ID
                        'price' => $priceData['price'],
                        'stock' => $priceData['stock'],
                    ]);
                }

                // Process variant images
                if (isset($variantData['images'])) {
                    foreach ($variantData['images'] as $image) {
                        $imagePath = $image->store('product_variants', 'public');
                        VariantImage::create([
                            'product_variant_id' => $variant->id,
                            'image_path' => $imagePath,
                        ]);
                    }
                }
            }

            // Commit transaction
            DB::commit();
            // dd("Completed");

            return redirect()->back()->with('success', 'Product added successfully!');
        } catch (\Exception $e) {
            // Rollback transaction if error occurs
            // dd("error");

            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
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
        $units = DefaultAttribute::all();
        // $brands = Brand::all();
        // $categories = Category::all();

        return view('vendor.product.edit', compact('product', 'units',));
    }

    public function update_product(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Validate
        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sku' => 'nullable|string',
            'tax_rate' => 'nullable|numeric',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'variants' => 'required|array',
            'variants.*.flavor' => 'required|string|max:255',
            'variants.*.size' => 'required|string|max:255',
            'variants.*.prices' => 'required|array',
            'variants.*.prices.*.unit' => 'required|integer|exists:default_attributes,id',
            'variants.*.prices.*.price' => 'required|numeric|min:0',
            'variants.*.prices.*.stock' => 'required|integer|min:0',
        ]);
    
        // Update product
        $product->update([
            'name' => $request->product_name,
            'description' => $request->description,
            'sku' => $request->sku,
            'tax_rate' => $request->tax_rate,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);
    
        // Collect kept image IDs BEFORE deleting old variants
        $keepImageIds = [];
        foreach ($request->variants as $variantData) {
            if (!empty($variantData['existing_images'])) {
                $keepImageIds = array_merge($keepImageIds, $variantData['existing_images']);
            }
        }


    
        // Delete removed images BEFORE deleting variants
        foreach ($product->variants as $variant) {
            foreach ($variant->images as $image) {
                if (!in_array($image->image_path, $keepImageIds)) {
                    Storage::disk('public')->delete($image->image_path);
                    $image->delete();
                }
            }
        }
    
        // Remove old variants & prices
        foreach ($product->variants as $oldVariant) {
            $oldVariant->prices()->delete();
            $oldVariant->delete(); // This will also delete images (if cascade is set), but we already handled image deletion above
        }
    
        // Add new variants
        foreach ($request->variants as $variantData) {
            $variant = $product->variants()->create([
                'variant_name' => $variantData['flavor'] ?? null,
                'size' => $variantData['size'] ?? null,
            ]);
    
            // Add prices
            foreach ($variantData['prices'] as $priceData) {
                $variant->prices()->create([
                    'unit_id' => $priceData['unit'],
                    'price' => $priceData['price'],
                    'stock' => $priceData['stock'],
                ]);
            }

            // dd($variantData['existing_images']);
            // Re-attach preserved images
            if (!empty($variantData['existing_images'])) {
                foreach ($variantData['existing_images'] as $imageId) {
                    $image =  VariantImage::create([
                        'product_variant_id' => $variant->id,
                        'image_path' => $imageId,
                    ]);
                }
            }
    
            // Handle new images
            if (isset($variantData['images'])) {
                foreach ($variantData['images'] as $image) {
                    $imagePath = $image->store('product_variants', 'public');
                    $variant->images()->create(['image_path' => $imagePath]);
                }
            }
        }
    
        return back()->with('success', 'Product updated successfully!');
    }






    // //variant 
    // public function index_variant()
    // {
    //     $products = Product::where('vendor_id', Auth::user()->id)->get();
    //     $attributes = DefaultAttribute::all();
    //     return view('vendor.product.variant.create', compact('products', 'attributes'));
    // }


    // public function manage_variant()
    // {
    //     $product_variants = ProductVariant::whereHas('product', function ($query) {
    //         $query->where('vendor_id', Auth::user()->id);
    //     })->get();
    //     return view('vendor.product.variant.manage', compact('product_variants'));
    // }

    // public function store_product_variant(Request $request)
    // {
    //     $validate = $request->validate([
    //         'product_id' => 'required|exists:products,id',
    //         'attribute_id' => 'required|exists:default_attributes,id',
    //         'regular_price' => 'required|numeric|min:0',
    //         'discounted_price' => 'nullable|numeric|lt:regular_price',
    //         'stock_quantity' => 'required|integer|min:0',
    //         'product_id' => [
    //             'required',
    //             'integer',
    //             Rule::unique('product_variants')->where(function ($query) use ($request) {
    //                 return $query->where('attribute_id', $request->attribute_id);
    //             })
    //         ]
    //     ]);

    //     ProductVariant::create([
    //         'product_id' => $validate['product_id'],
    //         'attribute_id' => $validate['attribute_id'],
    //         'regular_price' => $validate['regular_price'],
    //         'discounted_price' => $validate['discounted_price'],
    //         'stock_quantity' => $validate['stock_quantity'],
    //     ]);
    //     return redirect()->back()->with('success', 'Product Variant Added successfully');
    // }

    // public function delete_product_variant($id)
    // {
    //     $product_variant = ProductVariant::findOrFail($id);

    //     // Delete the product variant
    //     $product_variant->delete();

    //     return redirect()->back()->with('success', 'Product Variant Deleted successfully');
    // }

    // public function show_single_product_variant($id)
    // {
    //     $product_variant = ProductVariant::findOrFail($id);
    //     return view('vendor.product.variant.edit', compact('product_variant'));
    // }

    // public function update_product_variant(Request $request, $id)
    // {
    //     $product_variant = ProductVariant::findOrFail($id);
    //     $validate = $request->validate([
    //         // 'product_id' => 'required|exists:products,id',
    //         // 'attribute_id' => 'required|exists:default_attributes,id',
    //         'regular_price' => 'required|numeric|min:0',
    //         'discounted_price' => 'nullable|numeric|lt:regular_price',
    //         'stock_quantity' => 'required|integer|min:0',
    //     ]);

    //     $product_variant->update($validate);
    //     return redirect()->back()->with('success', 'Product Variant Updated successfully');
    // }
}
