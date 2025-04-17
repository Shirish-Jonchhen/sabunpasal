<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        return view('admin.brand.create');
    }

    public function manage()
    {

        $brands = Brand::all();
        return view('admin.brand.manage', compact('brands'));
    }

    // public function edit($id)
    // {
    //     return view('admin.brand.edit', compact('id'));
    // }
}
