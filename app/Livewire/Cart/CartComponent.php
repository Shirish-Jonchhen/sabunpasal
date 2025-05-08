<?php

namespace App\Livewire\Cart;

use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartComponent extends Component
{

    public $cartItems;
    public $totalPrice = 0;
    public $subtotalPrice = 0;
    public $totalDiscount = 0;
    public $totalTax = 0;

    public function mount()
    {
        
        $this->calculateTotals();
    }

    

    public function calculateTotals()
    {
        $this->cartItems = CartItem::with('VariantPrice')
            ->where('user_id', Auth::user()->id)
            ->get();
        $this->subtotalPrice = 0;
        $this->totalDiscount = 0;
        $this->totalTax = 0;
        foreach ($this->cartItems as $item) {
            $this->subtotalPrice += $item->variantPrice->old_price * $item->quantity;
            $this->totalDiscount += ($item->variantPrice->old_price - $item->variantPrice->price) * $item->quantity;
            $this->totalTax += ($item->variantPrice->variant->product->tax_rate/100) * $item->variantPrice->price * $item->quantity;

        }

        $this->totalPrice = ($this->subtotalPrice - $this->totalDiscount) + ($this->totalTax);
    }

    public function updateQuantity($itemId, $quantity)
    {
        $cartItem = CartItem::find($itemId);
        if ($cartItem) {
            $cartItem->quantity = $quantity;
            $cartItem->save();
            $this->calculateTotals();
        }
    }  

    
    public function addQuantity($itemId)
    {
        $cartItem = CartItem::find($itemId);
        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
            $this->calculateTotals();
        }
    }

    public function subtractQuantity($itemId)
    {
        $cartItem = CartItem::find($itemId);
        if ($cartItem && $cartItem->quantity > 1) {
            $cartItem->quantity -= 1;
            $cartItem->save();
            $this->calculateTotals();
        }
    }

    public function removeItem($itemId)
    {
        $cartItem = CartItem::find($itemId);
        if ($cartItem) {
            $cartItem->delete();
            $this->cartItems = CartItem::with('VariantPrice')
                ->where('user_id', Auth::user()->id)
                ->get();
            $this->calculateTotals();
        }
    }


    public function clearCart()
    {
        $cartItems = CartItem::where('user_id', Auth::user()->id)->get();
        foreach ($cartItems as $item) {
            $item->delete();
        }
        $this->cartItems = [];
        $this->calculateTotals();
    }


    public function render()
    {
        return view('livewire.cart.cart-component');
    }
}
