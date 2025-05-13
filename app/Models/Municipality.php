<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;

    protected $fillable = [
        'district_id',
        'municipality_name',
    ];
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function wards()
    {
        return $this->hasMany(Ward::class);
    }





    // Schema::create('municipalities', function (Blueprint $table) {
    //     $table->id();
    //     $table->foreignId('district_id')->constrained()->onDelete('cascade');
    //     $table->string('municipality_name');
    //     $table->timestamps();
    // });
}
