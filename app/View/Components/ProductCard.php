<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductCard extends Component
{
    /**
     * Create a new component instance.
     */

    public $product;
    public $averageReviews;
    public function __construct($product)
    {
        $this->product = $product;
        $this->averageReviews = round($product->reviews()->avg('star'), 2);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-card');
    }
}
