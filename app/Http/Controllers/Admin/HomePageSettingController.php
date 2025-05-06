<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomePageSetting;
use Illuminate\Http\Request;

class HomePageSettingController extends Controller
{
    public function index()
    {
        return view('admin.home_settings.create');
    }

    public function manage()
    {
        $banners = HomePageSetting::all();
        return view('admin.home_settings.manage', compact('banners'));
    }

    public function add_home_banner(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|string|max:255',
            'link_type' => 'required|string',
            'link_id' => 'required|integer',
            'image' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:4096',
                function ($attribute, $value, $fail) {
                    $image = getimagesize($value);
                    if (!$image) {
                        return $fail("The uploaded file is not a valid image.");
                    }

                    $width = $image[0];
                    $height = $image[1];
                    $ratio = $width / $height;

                    // Validate against 16:9 ratio (or your desired ratio)
                    $expectedRatio = 3 / 1;
                    $tolerance = 0.01; // small margin for rounding errors

                    if (abs($ratio - $expectedRatio) > $tolerance) {
                        $fail("The $attribute must have a 16:9 aspect ratio.");
                    }
                },
            ],
            'position' => [
                'required',
                function ($attribute, $value, $fail) {
                    $count = HomePageSetting::where('position', $value)->count();

                    if ($value == 1 && $count >= 5) {
                        $fail("The $attribute '$value' has already been used 5 times.");
                    } elseif ($value != 1 && $count >= 1) {
                        $fail("The $attribute '$value' can only be used once.");
                    }
                },
            ],
        ]);

        $imagePath = $request->file('image')->store('home_banners', 'public');

        HomePageSetting::create([
            'title' => $request->title,
            'link_type' => $request->link_type,
            'link_id' => $request->link_id,
            'image_path' => $imagePath,
            'position' => $request->position,
        ]);
        return redirect()->back()->with('success', 'Home banner added successfully.');
    }

    public function delete_home_banner($id)
    {
        $banner = HomePageSetting::findOrFail($id);
        $banner->delete();
        return redirect()->back()->with('success', 'Home banner deleted successfully.');
    }
}
