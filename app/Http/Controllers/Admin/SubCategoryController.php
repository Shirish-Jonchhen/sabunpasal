<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;

use App\Models\User;
use Illuminate\Http\Request;


class SubCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.sub_category.create', compact('categories'));
    }

    public function manage(Request $request)
    {
  
        $subcategories = SubCategory::orderBy('id', 'asc')->paginate(10);

        return view('admin.sub_category.manage', compact('subcategories'));
    }
}
