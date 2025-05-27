<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'star',
        'review',
    ];

    // Relationships (optional but useful)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function isVerifiedPurchase(): bool
{
    $user = $this->user;

    // Get all variant IDs of this product
    $productVariantIds = $this->product->variants->pluck('id');

    // Get all variant price IDs of this product
    $variantPriceIds = VariantPrice::whereIn('product_variant_id', $productVariantIds)->pluck('id');

    // Check if this user's orders contain any of those variant_price_ids
    return StoreOrderProduct::whereIn('variant_price_id', $variantPriceIds)
        ->whereHas('storeOrder.order', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })
        ->exists();
}
}
