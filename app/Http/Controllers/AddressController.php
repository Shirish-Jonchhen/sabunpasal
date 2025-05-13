<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Municipality;
use App\Models\Ward;
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


    public function create_district(Request $request)
    {
        $request->validate([
            'district_name' => 'required|string|max:255|unique:districts,district_name',
        ]);

        District::create([
            'district_name' => $request->district_name,
        ]);

        return redirect()->back()->with('success', 'District created successfully.');
    }


    public function delete_district($id)
    {
        $district = District::find($id);
        if ($district) {
            $district->delete();
            return redirect()->back()->with('success', 'District deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'District not found.');
        }
    }











    public function index_m()
    {
        $districts = District::all();
        return view('admin.address.municipality.create', compact('districts'));
    }

    public function manage_m()
    {
        $municipalities = Municipality::all();
        return view('admin.address.municipality.manage', compact('municipalities'));
    }

    public function create_municipality(Request $request)
    {
        $request->validate([
            'municipality_name' => 'required|string|max:255|unique:municipalities,municipality_name',
            'district_id' => 'required|exists:districts,id',
            'number_of_wards' => 'required|integer|min:1',
        ]);

        $municipality = Municipality::create([
            'municipality_name' => $request->municipality_name,
            'district_id' => $request->district_id,
        ]);

        for ($i = 1; $i <= $request->number_of_wards; $i++) {
            Ward::create([
                'ward_name' => 'Ward ' . $i,
                'municipality_id' => $municipality->id,
            ]);
        }

        return redirect()->back()->with('success', 'Municipality created successfully with wards.');
    }

    public function delete_municipality($id)
    {
        $municipality = Municipality::find($id);
        if ($municipality) {
            $municipality->delete();
            return redirect()->back()->with('success', 'Municipality deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Municipality not found.');
        }
    }

    public function show_single_municipality($id)
    {
        $municipality = Municipality::find($id);
        $districts = District::all();
                if ($municipality) {
            return view('admin.address.municipality.edit', compact('municipality', 'districts'));
        } else {
            return redirect()->back()->with('error', 'Municipality not found.');
        }
    }

    public function update_municipality(Request $request, $id)
    {
        $request->validate([
            'municipality_name' => 'required|string|max:255|unique:municipalities,municipality_name,' . $id,
            'district_id' => 'required|exists:districts,id',
            'number_of_wards' => 'required|integer|min:1',
        ]);

        $municipality = Municipality::find($id);
        if ($municipality) {
            $municipality->update([
                'municipality_name' => $request->municipality_name,
                'district_id' => $request->district_id,
            ]);
            return redirect()->back()->with('success', 'Municipality updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Municipality not found.');
        }
    }
}
