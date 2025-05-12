<?php

namespace App\Livewire\Product;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\WishlistItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductVariant extends Component
{

    public $slug;
    public $product;
    public $variants = [];
    public $selectedVariantId = null;
    public $unitList = [];
    public $selectedUnitID = null;
    public $price = null;
    public $old_price = null;
    public $variantImages = [];
    public $quantity = 1;

    public $stock = null;



    public $showMessage = false;
    public $isInWishlist = false;
    public $averageReviews = 0;


    public function mount($slug, $averageReviews)
    {
        $this->slug = $slug;
        $this->averageReviews = $averageReviews;
        $this->product = Product::where('slug', $this->slug)->with('variants.prices', 'variants.images')->first();

        if ($this->product && $this->product->variants->isNotEmpty()) {
            $this->variants = $this->product->variants;

            $firstVariant = $this->product->variants->first();

            $this->selectedVariantId = $firstVariant->id;

            $prices = $firstVariant->prices;
            $firstPrice = $prices->first();

            $this->unitList = $prices;
            $this->selectedUnitID = $firstPrice?->id;
            $this->price = $firstPrice?->price;
            $this->old_price = $firstPrice?->old_price;
            $this->stock = $firstPrice?->stock;
            $this->variantImages = $firstVariant->images;

            if (Auth::check() && $this->product) {
                $this->isInWishlist = WishlistItem::where('user_id', Auth::id())
                    ->where('product_id', $this->product->id)
                    ->exists();
            } else {
                $this->isInWishlist = false;
            };
        }
    }

    public function updatedSelectedVariantId($variantId)
    {
        $this->selectedVariantId = $variantId;

        $variant = $this->product->variants()->find($variantId);

        if ($variant) {
            $prices = $variant->prices;
            $firstPrice = $prices->first();

            $this->unitList = $prices;
            $this->selectedUnitID = $firstPrice?->id;
            $this->stock = $firstPrice?->stock;
            $this->price = $firstPrice?->price;
            $this->old_price = $firstPrice?->old_price ?? 0;
            $this->variantImages = $variant->images;

            $firstImage = $variant->images->first();
            if ($firstImage) {
                $firstImagePath = asset('storage/' . $firstImage->image_path);
                $this->dispatch('variantChanged', imagePath: $firstImagePath);
            }
        }
    }

    public function updatedSelectedUnitID($unitId)
    {
        // Find the selected variant only once
        $variant = $this->product->variants->find($this->selectedVariantId);

        if ($variant) {
            // Get the price and stock for the selected unit
            $unit = $variant->prices->find($unitId);

            if ($unit) {
                $this->selectedUnitID = $unitId;
                $this->price = $unit->price;
                $this->old_price = $unit->old_price;
                $this->stock = $unit->stock;
            }
        }
    }

    // Methods to increase and decrease quantity
    public function increaseQuantity()
    {
        $this->quantity++;
    }

    public function decreaseQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }


    public function addToCart()
    {

        $cartItem = CartItem::where('user_id', Auth::user()->id)
            ->where('variant_price_id', $this->selectedUnitID)
            ->first();


        if ($cartItem) {
            $cartItem->increment('quantity', $this->quantity);
            session()->flash('message', 'Item(s) Quantity increased by ' . $this->quantity . ' in cart.');
            $this->quantity = 1;
            return;
        }

        $this->validate([
            'selectedUnitID' => 'required|exists:variant_prices,id',
            'quantity' => 'required|integer|min:1',
        ]);

        CartItem::create(
            [
                'user_id' => Auth::user()->id,
                'variant_price_id' => $this->selectedUnitID,
                'quantity' => $this->quantity,
            ]
        );

        $this->quantity = 1; // Reset quantity after adding to cart

        session()->flash('message', $this->quantity . ' Item(s) added to cart.');
        $this->showMessage = true;
    }

    public function addToWishlist()
    {
        $wishlistItem = WishlistItem::where('user_id', Auth::user()->id)
            ->where('product_id', $this->product->id)
            ->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            session()->flash('message', 'Item removed from wishlist.');
            $this->isInWishlist = false;
            $this->showMessage = true;
            return;
        } else {
            $this->validate([
                'product.id' => 'required|exists:products,id',
            ]);

            WishlistItem::create(
                [
                    'user_id' => Auth::user()->id,
                    'product_id' => $this->product->id,
                ]
            );
            session()->flash('message', 'Item added to wishlist.');
            $this->isInWishlist = true;
            $this->showMessage = true;
            return;
        }
    }

    public function closeAlert()
    {
        $this->showMessage = false;
    }


    public function render()
    {
        return view('livewire.product.product-variant');
    }
}
