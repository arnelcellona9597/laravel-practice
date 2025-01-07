<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WooOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 
        'customer_name', 
        'customer_email', 
        'total', 
        'status'
    ]; 

}
