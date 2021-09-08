<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'image', 'time_for_solving',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'test_categories');
    }
}
