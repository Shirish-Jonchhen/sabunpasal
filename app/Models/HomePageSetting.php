<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePageSetting extends Model
{

    use HasFactory;
     
    protected $fillable = [
        'title',
        'image_path',
        'link_type',
        'link_id',
        'position',
    ];

    public function link()
    {
        return match ($this->link_type) {
            'product' => $this->belongsTo(Product::class, 'link_id'),
            'subcategory' => $this->belongsTo(SubCategory::class, 'link_id'),
            'brand' => $this->belongsTo(Brand::class, 'link_id'),
            default => null
        };
    }
}
