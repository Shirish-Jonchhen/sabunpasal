<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ward extends Model
{
    //     Schema::create('wards', function (Blueprint $table) {
    //     $table->id();
    //     $table->foreignId('municipality_id')->constrained()->onDelete('cascade');
    //     $table->string('ward_name');
    //     $table->timestamps();
    // });

    use HasFactory;
    protected $fillable = [
        'municipality_id',
        'ward_name',
    ];
}
