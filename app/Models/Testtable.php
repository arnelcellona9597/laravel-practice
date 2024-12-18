<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testtable extends Model
{
    use HasFactory;

    protected $table = "testtable";

    protected $fillable = [
        'customer_id',
        'first_name', 
        'last_name',
        'email'
    ];
    
}
