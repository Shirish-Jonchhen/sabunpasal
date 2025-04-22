<?php

namespace App\Livewire\Vendor;

use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ProductVariantManager extends Component
{
    use WithPagination;

    public $search = '';

    // Reset pagination on search

    
    public function updatedSearch($value)
    {
        $this->resetPage(); // Reset pagination when search query changes
    }
    
    public function render()
    
    {

        $variants = ProductVariant::whereHas('product', function ($query) {
            $query->where('vendor_id', Auth::id())
                  ->when($this->search, function ($q) {
                      $q->where('product_name', 'like', '%' . $this->search . '%');
                  });
        })
        ->with('product') // eager load the product for use in the view
        ->orderBy('id', 'asc')
        ->paginate(5);// You can adjust the number per page as needed
    
        return view('livewire.vendor.product-variant-manager', [
            'variants' => $variants
        ]);
    }

}
