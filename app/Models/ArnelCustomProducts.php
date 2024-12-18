<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArnelCustomProducts extends Model
{
    use HasFactory;

    protected $table = 'arnel_custom_products';

    protected $fillable = [
        'product_id', 
        'name', 
        'description', 
        'price', 
        'stock'
    ];

}
