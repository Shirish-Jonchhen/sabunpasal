<?php

namespace App\Livewire\Wishlist;

use App\Models\WishlistItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistComponent extends Component
{

    public $wishlistItems;

    public function mount()
    {
        $this->wishlistItems = WishlistItem::with('product')
            ->where('user_id', Auth::user()->id)
            ->get();
    }

    public function removeFromWishlist($itemId)
    {
        $wishlistItem = WishlistItem::find($itemId);
        if ($wishlistItem) {
            $wishlistItem->delete();
            $this->wishlistItems = WishlistItem::with('products')
                ->where('user_id', Auth::user()->id)
                ->get();
            session()->flash('message', 'Product removed from wishlist successfully.');
        }
    }

    public function render()
    {
        return view('livewire.wishlist.wishlist-component');
    }
}
