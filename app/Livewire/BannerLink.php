<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Product;
use App\Models\SubCategory;
use Livewire\Component;

class BannerLink extends Component
{

    public $bannerTypes = [];
    public $selectedBannerType;
    public $bannerLinkIds = [];
    public $selectedBannerLinkId;

    public function mount()
    {
        $this->bannerTypes = [
            'product',
            'subcategory',
            'brand'
        ];
    }

    public function updatedSelectedBannerType($bannerType)
    {
        if ($bannerType === 'product') {
            $this->bannerLinkIds = Product::all();
        } elseif ($bannerType === 'subcategory') {
            $this->bannerLinkIds = SubCategory::all();
        } elseif ($bannerType === 'brand') {
            $this->bannerLinkIds = Brand::all();
        } else {
            $this->bannerLinkIds = [];
        }
        $this->selectedBannerLinkId = null; // Reset selected subcategory
    }

    public function render()
    {
        return view('livewire.banner-link');
    }
}
