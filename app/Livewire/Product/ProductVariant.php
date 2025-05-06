<?php

namespace App\Livewire\Product;

use App\Models\Product;
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


    public function mount($slug)
    {
        $this->slug = $slug;
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

    // public function updatedQuantity($value)
    // {
    //     if ($value < 1) {
    //         $this->quantity = 1;
    //     }
    // }


    public function render()
    {
        return view('livewire.product.product-variant');
    }
}
