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
use Illuminate\Support\Str;
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
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:sub_categories,id',
            'brand_id' => 'required|exists:brands,id',
            'store_id' => 'required|exists:stores,id',
            'tax_rate' => 'required|numeric',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string',
            'images.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
            'variants.*.flavor' => 'string|max:255',
            'variants.*.size' => 'string|max:255',
            'variants.*.prices.*.unit' => 'required|string|max:50',
            'variants.*.prices.*.price' => 'required|numeric',
            'variants.*.prices.*.old_price' => 'nullable|numeric',
            'variants.*.prices.*.stock' => 'required|integer',
        ]);

        // Validation for old_price being greater than new price
        $validator->after(function ($validator) use ($request) {
            foreach ($request->input('variants', []) as $vIndex => $variant) {
                foreach ($variant['prices'] ?? [] as $pIndex => $price) {
                    $old = $price['old_price'] ?? null;
                    $new = $price['price'] ?? null;

                    if (!is_null($old) && is_numeric($old) && is_numeric($new) && $old <= $new) {
                        $validator->errors()->add(
                            "variants.$vIndex.prices.$pIndex.old_price",
                            "Old price must be greater than the price."
                        );
                    }
                }
            }
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $store = Store::findOrFail($request->store_id);

            // Create product
            $product = Product::create([
                'name' => $request->product_name,
                'description' => $request->description,
                'vendor_id' => Auth::user()->id,
                'slug' => $this->generateSlug($store->slug, $request->product_name),
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'store_id' => $request->store_id,
                'brand_id' => $request->brand_id,
                'tax_rate' => $request->tax_rate,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'status' => 'active',
                'is_on_sale' => false,
            ]);

            // Process variants
            foreach ($request->variants as $variantData) {
                // Generate SKU using the created function
                $sku = $this->generateSku(
                    $store->slug,
                    $request->product_name,
                    $variantData['flavor'] . '-' . $variantData['size']
                );

                // Create product variant
                $variant = ProductVariant::create([
                    'product_id' => $product->id,
                    'size' => $variantData['size'],
                    'variant_name' => $variantData['flavor'],
                    'sku' => $sku,
                ]);

                // Process variant prices
                foreach ($variantData['prices'] as $priceData) {
                    VariantPrice::create([
                        'product_variant_id' => $variant->id,
                        'unit_id' => $priceData['unit'],
                        'old_price' => $priceData['old_price'],
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

            DB::commit();

            return redirect()->back()->with('success', 'Product added successfully!');
        } catch (\Exception $e) {
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
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tax_rate' => 'nullable|numeric',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'variants' => 'required|array',
            'variants.*.flavor' => 'required|string|max:255',
            'variants.*.size' => 'required|string|max:255',
            'variants.*.prices' => 'required|array',
            'variants.*.prices.*.unit' => 'required|integer|exists:default_attributes,id',
            'variants.*.prices.*.old_price' => 'required|numeric|min:0',
            'variants.*.prices.*.price' => 'required|numeric|min:0',
            'variants.*.prices.*.stock' => 'required|integer|min:0',
        ]);

        // Validation for old_price being greater than new price
        $validator->after(function ($validator) use ($request) {
            foreach ($request->input('variants', []) as $vIndex => $variant) {
                foreach ($variant['prices'] ?? [] as $pIndex => $price) {
                    $old = $price['old_price'] ?? null;
                    $new = $price['price'] ?? null;

                    if (!is_null($old) && is_numeric($old) && is_numeric($new) && $old <= $new) {
                        $validator->errors()->add(
                            "variants.$vIndex.prices.$pIndex.old_price",
                            "Old price must be greater than the price."
                        );
                    }
                }
            }
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $product = Product::findOrFail($id);
            $store = Store::findOrFail($request->store_id);

            // Update product details
            $product->update([
                'name' => $request->product_name,
                'description' => $request->description,
                'tax_rate' => $request->tax_rate,
                'meta_title' => $request->meta_title,
                'slug' => $this->generateSlug($store->slug, $request->product_name, $product->id),
                'meta_description' => $request->meta_description,
                'status' => $request->status,
                'is_on_sale' => $request->is_on_sale ? 1 : 0,
                'visibility' => $request->visibility ? 1 : 0,
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
                    'sku' => $this->generateSku(
                        $store->slug,
                        $request->product_name,
                        $variantData['flavor'] . '-' . $variantData['size']
                    ),
                ]);

                // Add prices
                foreach ($variantData['prices'] as $priceData) {
                    $variant->prices()->create([
                        'unit_id' => $priceData['unit'],
                        'old_price' => $priceData['old_price'],
                        'price' => $priceData['price'],
                        'stock' => $priceData['stock'],
                    ]);
                }

                // Re-attach preserved images
                if (!empty($variantData['existing_images'])) {
                    foreach ($variantData['existing_images'] as $imageId) {
                        $image = VariantImage::create([
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

            DB::commit();

            return redirect()->back()->with('success', 'Product updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }












    public function generateSku($storeSlug, $productName, $variantInfo)
    {
        // Abbreviate parts
        $storeAbbr  = strtoupper(Str::slug(Str::words($storeSlug, 2, ''), ''));
        $productAbbr = strtoupper(Str::slug(Str::words($productName, 3, ''), ''));
        $variantAbbr = strtoupper(str_replace(' ', '', $variantInfo)); // Simple clean-up

        // Prefix to search existing SKUs
        $skuPrefix = "$storeAbbr-$productAbbr-$variantAbbr";

        // Check if SKU already exists
        if (ProductVariant::where('sku', 'like', "$skuPrefix%")->exists()) {
            throw new \Exception("This variant of this product already exists in this store.");
        }

        // Find the highest existing SKU with this prefix
        $lastSku = ProductVariant::where('sku', 'like', "$skuPrefix%")
            ->orderByDesc('sku')
            ->value('sku');

        // Extract and increment last numeric ID
        $lastId = 0;
        if ($lastSku) {
            $parts = explode('-', $lastSku);
            $lastId = intval(end($parts));
        }

        $nextId = str_pad($lastId + 1, 3, '0', STR_PAD_LEFT); // e.g. 001, 002
        $sku = "$skuPrefix-$nextId";

        return $sku;
    }





    public function generateSlug($storeSlug, $productName, $productId = null)
    {
        // Convert the product name into a slug
        $productSlug = Str::slug($productName, '-');
    
        // Combine store slug and product slug
        $slug = "{$storeSlug}-{$productSlug}";
    
        // Check if the slug already exists in the database, excluding the current product if an ID is provided
        $existingProduct = Product::where('slug', $slug)
                                  ->when($productId, function ($query) use ($productId) {
                                      return $query->where('id', '!=', $productId);
                                  })
                                  ->first();
    
        // If the slug already exists, throw an exception to prevent duplication
        if ($existingProduct) {
            throw new \Exception("The product with this name already exists in the store.");
        }
    
        return $slug;
    }
}
