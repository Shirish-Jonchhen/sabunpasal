<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('query');
        $query = Product::where('name', 'like', '%' . $search . '%');
        if ($request->has('brands')) {
            $query->whereHas('brand', function ($q) use ($request) {
                $q->whereIn('slug', $request->brands);
            });
        }

        // Price Range Filter
        if ($request->filled('min_price') || $request->filled('max_price')) {
            $min = $request->min_price ?? 0;
            $max = $request->max_price ?? 999999;
        
            $query->whereHas('variants.prices', function ($q) use ($min, $max) {
                $q->whereBetween('price', [$min, $max]);
            });
        }
        switch ($request->sort) {
            case 'price-asc':
                $query->addSelect([
                    'min_price' => ProductVariant::select('price')
                        ->join('variant_prices', 'product_variants.id', '=', 'variant_prices.product_variant_id')
                        ->whereColumn('product_variants.product_id', 'products.id')
                        ->orderBy('variant_prices.price', 'asc')
                        ->limit(1)
                ])->orderBy('min_price', 'asc');
                break;
            
            case 'price-desc':
                $query->addSelect([
                    'min_price' => ProductVariant::select('price')
                        ->join('variant_prices', 'product_variants.id', '=', 'variant_prices.product_variant_id')
                        ->whereColumn('product_variants.product_id', 'products.id')
                        ->orderBy('variant_prices.price', 'asc')
                        ->limit(1)
                ])->orderBy('min_price', 'desc');
                break;
        
            case 'name-asc':
                $query->orderBy('name', 'asc');
                break;
        
            case 'name-desc':
                $query->orderBy('name', 'desc');
                break;
        
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
        
            default:
                // No sorting (or maybe default by newest)
                break;
        }

        $products = $query->paginate(9)->appends($request->query());

        $brands = Brand ::all();

        return view('customer.all_products.all', compact('products','brands', 'search'));
    }
}
