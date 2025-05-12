<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        return view('admin.address.district.create');
    }
    public function manage()
    {
        $districts = District::all();
        return view('admin.address.district.manage', compact('districts'));
    }


    public function create_district(Request $request){
        $request->validate([
            'district_name' => 'required|string|max:255',
        ]);

        District::create([
            'district_name' => $request->district_name,
        ]);

        return redirect()->back()->with('success', 'District created successfully.');
    }


    public function delete_district($id){
        $district = District::find($id);
        if ($district) {
            $district->delete();
            return redirect()->back()->with('success', 'District deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'District not found.');
        }
    }
}
