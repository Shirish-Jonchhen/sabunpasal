<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\SubCategory;

class CategorySubcategory extends Component
{
    public $categories=[];
    public $selectedCategory;
    public $subcategories=[];
    public $selectedSubcategory;

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function updatedSelectedCategory($categoryId)
    {
        $this->subcategories = SubCategory::where('category_id', $categoryId)->get();
        $this->selectedSubcategory = null; 
    }

    public function render()
    {
        return view('livewire.category-subcategory');
    }
}
