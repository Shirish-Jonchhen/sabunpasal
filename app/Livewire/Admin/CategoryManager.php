<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryManager extends Component
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
        $categories = Category::when($this->search, function ($query) {
                $query->where('category_name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id', 'asc')
            ->paginate(5); // You can adjust the number per page as needed
    
        return view('livewire.admin.category-manager', [
            'categories' => $categories
        ]);
    }
    
}