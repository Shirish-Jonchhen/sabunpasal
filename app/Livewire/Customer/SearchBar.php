<?php

namespace App\Livewire\Customer;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class SearchBar extends Component
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
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id', 'asc')
            ->paginate(10); // You can adjust the number per page as needed
    
        return view('livewire.customer.search-bar', [
            'products' => $products
        ]);
    }
}
