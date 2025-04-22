<?php

namespace App\Livewire\Vendor;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ProductManager extends Component
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
        $products = Product::when($this->search, function ($query) {
                $query->where('product_name', 'like', '%' . $this->search . '%');
            })->where('vendor_id', Auth::user()->id)
            ->orderBy('id', 'asc')
            ->paginate(5); // You can adjust the number per page as needed
    
        return view('livewire.vendor.product-manager', [
            'products' => $products
        ]);
    }
}
