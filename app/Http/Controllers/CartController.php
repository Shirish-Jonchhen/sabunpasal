<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {

        if (Auth::check()) {
            return view('customer.cart.cart');
        }else{
            return redirect()->route('home')->withErrors('Please login to view your cart.');
        }
    }
}
