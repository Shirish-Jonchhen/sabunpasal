<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\HomePageSetting;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banners = HomePageSetting::all();
        $categories = Category::all();
        $featured_subcategories = SubCategory::where('is_featured', 1)->get();
        $brands = Brand::all();
        $sale_products = Product::where('is_on_sale', 1)->get();
        $randomCategory = Category::with('subcategories.products')
        ->whereHas('products')
        ->inRandomOrder()
        ->first();
    
        

        return view('home.index', compact('banners', 'categories', 'featured_subcategories','brands','sale_products','randomCategory'));
    }
}
