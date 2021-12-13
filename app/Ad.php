<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'id', 'name', 'user_id', 'category', 'price', 'description'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
}
