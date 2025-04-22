<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.create');
    }

    public function manage(Request $request)
    {

        $categories = Category::orderBy('id', 'asc')->paginate(10);

        return view('admin.category.manage', compact('categories'));
    }
}
