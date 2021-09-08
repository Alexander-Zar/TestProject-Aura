<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'test_categories');
    }
}
