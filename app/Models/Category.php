<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Products;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['category'];

    public function products(){
        return $this->hasMany(Products::class, 'category_id', 'id');
    }
}
