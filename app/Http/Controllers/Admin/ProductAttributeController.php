<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DefaultAttribute;
use Illuminate\Http\Request;

class ProductAttributeController extends Controller
{
    public function index()
    {
        return view('admin.product_attribute.create');
    }

    public function manage()
    {
        $attributes = DefaultAttribute::all();
        return view('admin.product_attribute.manage', compact('attributes'));
    }

    public function create_attribute(Request $request)
    {
        $validation = $request->validate([
            'attribute_value' => 'required|unique:default_attributes|string|max:255|min:1',
        ]);

        DefaultAttribute::create($validation);
        return redirect()->back()->with('success', 'Default Attribute Created Successfully');
    }

    public function show_single_attribute($id)
    {
        $attribute_info = DefaultAttribute::find($id);
        return view("admin.product_attribute.edit", compact('attribute_info'));
    }

    public function update_attribute(Request $request, $id)
    {
        $attribute = DefaultAttribute::findOrFail($id);
        $validation = $request->validate([
            'attribute_value' => 'required|unique:default_attributes|string|max:255|min:1',
        ]);

        $attribute->update($validation);
        return redirect()->back()->with('success', 'Default Attribute Updated Successfully');
    }

    public function delete_attribute($id)
    {
        $attribute = DefaultAttribute::findOrFail($id);
        $attribute->delete();
        return redirect()->back()->with('success', 'Default Attribute Deleted Successfully');
    }
}
