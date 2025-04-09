<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\Product;
use App\Models\ProductImage;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


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

    public function store_product(Request $request){

        $validate = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sku'=> 'required|string|unique:products,sku',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:sub_categories,id',
            'store_id' => 'required|exists:stores,id',
            'regular_price' => 'required|numeric|min:0',
            'discounted_price' => 'nullable|numeric|min:0',
            'tax_rate' => 'required|numeric|min:0|max:100',
            'stock_quantity' => 'required|integer|min:0',
            'images.*'=> 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            'regular_price' => $validate['regular_price'],
            'discounted_price' => $validate['discounted_price'],
            'tax_rate' => $validate['tax_rate'],
            'stock_quantity' => $validate['stock_quantity'],
            'slug'=>$validate['slug'],
            'meta_title'=> $request->meta_title,
            'meta_description'=> $request->meta_description,
        ]);

        if($request->hasFile('images')){
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

    public function delete_product($id){
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('success', 'Product Deleted successfully');
    }

    public function show_single_product($id){
        $product = Product::findOrFail($id);
        return view('vendor.product.edit', compact('product'));
    }
}
