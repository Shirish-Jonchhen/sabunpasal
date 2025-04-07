<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class VendorStoreController extends Controller
{
    public function index()
    {
        return view('vendor.store.create');
    }

    public function manage()
    {
        $stores = Store::where('user_id', Auth::user()->id)->get();
        return view('vendor.store.manage', compact('stores'));
    }

    public function store(Request $request){
        $validation = $request->validate([
            'store_name' => 'required|unique:stores|string|max:255|min:3',
            'slug' => 'required|string|max:255|min:3|unique:stores',
            'details' => 'required|string',

        ]);

        Store::create([
            'store_name' => $validation['store_name'],
            'slug' => $validation['slug'],
            'details' => $validation['details'],
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->back()->with('success', 'Store Created Successfully');

    }

    public function show_single_store($id){
        $store = Store::find($id);
        return view('vendor.store.edit', compact('store'));
    }

    public function update_store(Request $request, $id){
        $store = Store::findOrFail($id);
        $validation = $request->validate([
            'store_name' => 'required|string|max:255|min:3|unique:stores,store_name,' . $id,
            'slug' => 'required|string|max:255|min:3|unique:stores,slug,' . $id,
            'details' => 'required|string',

        ]);

        $store->update($validation);
        return redirect()->back()->with('success', 'Store Updated Successfully');

    }
    public function delete_store($id){
        $store = Store::findOrFail($id);
        $store->delete();
        return redirect()->back()->with('success', 'Store Deleted Successfully');
    }


}
