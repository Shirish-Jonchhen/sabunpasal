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


    public function mount($slug)
    {
        $this->slug = $slug;
    
        $this->product = Product::where('slug', $this->slug)->first();
        if ($this->product) {
            $this->variants = $this->product->variants;
            $this->selectedVariantId = $this->product->variants()->first()->id;
            $this->unitList = $this->product->variants()->first()->prices()->get();
            $this->selectedUnitID = $this->product->variants()->first()->prices()->first()->id;
            $this->price = $this->product->variants()->first()->prices()->first()->price;
            $this->old_price = $this->product->variants()->first()->prices()->first()->old_price;
            $this->variantImages = $this->product->variants()->first()->images;
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
            $this->price = $firstPrice?->price;
            $this->old_price = $firstPrice?->old_price;
            $this->variantImages = $variant->images;
    
            $firstImage = $variant->images->first();
            if ($firstImage) {
                $firstImagePath = asset('storage/' . $firstImage->image_path);
                $this->dispatch('variantChanged', $firstImagePath);
            }
        }
    }

    public function updatedSelectedUnitID($unitId)
    {
        $this->selectedUnitID = $unitId;
        $this->price = $this->product->variants()->find($this->selectedVariantId)->prices()->find($unitId)->price;
        $this->old_price = $this->product->variants()->find($this->selectedVariantId)->prices()->find($unitId)->old_price;
    }


    
    public function render()
    {
        return view('livewire.product.product-variant');
    }
}
