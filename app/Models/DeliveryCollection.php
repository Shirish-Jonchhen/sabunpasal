<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryCollection extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * Explicitly set it to 'delivery_collections' to avoid pluralization issues.
     *
     * @var string
     */
    protected $table = 'delivery_collections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'delivery_person_id',
        'amount_collected',
        'collection_date',
        'status',
        'collected_by_user_id',
        'notes',
        'period_start_date',
        'period_end_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'collection_date'      => 'datetime',
        'period_start_date'    => 'date',
        'period_end_date'      => 'date',
        'amount_collected'     => 'decimal:2', // Cast to decimal with 2 places
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Get the delivery person who made this collection.
     */
    public function deliveryPerson()
    {
        // Assuming 'User' model represents both admins and delivery persons
        return $this->belongsTo(User::class, 'delivery_person_id');
    }

    /**
     * Get the admin user who recorded this collection.
     */
    public function collectedBy()
    {
        return $this->belongsTo(User::class, 'collected_by_user_id');
    }

    /**
     * Get the orders that are part of this collection.
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'delivery_collection_id');
    }
}
