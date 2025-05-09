<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('customer.wishlist.wishlist');
        }else{
            return redirect()->route('home')->withErrors('Please login to view your wishlist.');
        }
        
    }
}
