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
    public $layout = 'block';

    public function mount($selectedCategory = null, $selectedSubcategory = null, $layout = 'block')
    {
        $this->categories = Category::all();
        $this->selectedCategory = $selectedCategory;
        $this->layout = $layout ?: 'block';
        if ($selectedCategory) {
            $this->subcategories = SubCategory::where('category_id', $selectedCategory)->get();
            $this->selectedSubcategory = $selectedSubcategory;
        }
    }

    public function updatedSelectedCategory($categoryId)
    {
        if ($categoryId) {
            $this->subcategories = SubCategory::where('category_id', $categoryId)->get();
        } else {
            $this->subcategories = [];
        }
        $this->selectedSubcategory = null;
    }

    public function render()
    {
        return view('livewire.category-subcategory');
    }
}
