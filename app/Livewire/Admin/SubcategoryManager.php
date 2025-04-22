<?php

namespace App\Livewire\Admin;

use App\Models\SubCategory;
use Livewire\Component;
use Livewire\WithPagination;

class SubcategoryManager extends Component
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
        $subcategories = SubCategory::when($this->search, function ($query) {
                $query->where('subcategory_name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id', 'asc')
            ->paginate(5); // You can adjust the number per page as needed
    
        return view('livewire.admin.subcategory-manager', [
            'subcategories' => $subcategories
        ]);
    }
}
