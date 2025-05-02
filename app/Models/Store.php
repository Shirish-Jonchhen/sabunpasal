<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_name',
        'slug',
        'details',
        'user_id',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }



}

// Run this in your terminal to generate models with migrations:
// php artisan make:model Product -m
// php artisan make:model ProductVariant -m
// php artisan make:model VariantPrice -m
// php artisan make:model VariantImage -m