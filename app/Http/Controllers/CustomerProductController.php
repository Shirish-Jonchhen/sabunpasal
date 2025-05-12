<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\RecentlyViewedItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class CustomerProductController extends Controller
{
    public function index($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        // Load reviews and user relationships once
        $reviewsQuery = $product->reviews();

        $reviews = $reviewsQuery->with('user')
            ->latest()
            ->take(2)
            ->get();

        $allReviews = $product->reviews();

        $averageReviews = round($allReviews->avg('star'), 2);
        $totalReviews = $allReviews->count();

        // Get count of each star rating in one query
        $starCounts = $allReviews->select('star', DB::raw('count(*) as count'))
            ->groupBy('star')
            ->pluck('count', 'star');


        // Delete the existing view of same product for same user

        if (Auth::user()) {


            $userId = Auth::user()->id;

            RecentlyViewedItem::where('user_id', $userId)
                ->where('product_id', $product->id)
                ->delete();

            // Insert new one (latest)
            RecentlyViewedItem::create([
                'user_id' => $userId,
                'product_id' => $product->id
            ]);

            // Limit to 4 recent items per user
            $recentViews = RecentlyViewedItem::where('user_id', $userId)
                ->latest()
                ->get();

            if ($recentViews->count() > 4) {
                $recentViews->slice(4)->each->delete(); // Delete older ones
                $recentViews = RecentlyViewedItem::where('user_id', $userId)
                    ->latest()
                    ->get();
            }
        } else {
            $recentViews = Collection::make(); // Empty collection if not logged in
        }




        return view('customer.product.show', [
            'product' => $product,
            'reviews' => $reviews,
            'averageReviews' => $averageReviews,
            'totalReviews' => $totalReviews,
            'fiveStars' => $starCounts->get(5, 0),
            'fourStars' => $starCounts->get(4, 0),
            'threeStars' => $starCounts->get(3, 0),
            'twoStars' => $starCounts->get(2, 0),
            'oneStars' => $starCounts->get(1, 0),
            'recentViews' => $recentViews,
        ]);
    }



    public function addReview(Request $request, $slug)
    {
        $request->validate([
            'star' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);

        $product = Product::where('slug', $slug)->firstOrFail();

        $product->reviews()->create([
            'user_id' => Auth::user()->id,
            'product_id' => $product->id,
            'star' => $request->input('star'),
            'review' => $request->input('review'),
        ]);

        return redirect()->back()->with('success', 'Review added successfully!');
    }
}
