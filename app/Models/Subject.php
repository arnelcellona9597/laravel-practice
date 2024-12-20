<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['user_id', 'name', 'address', 'year_level'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}