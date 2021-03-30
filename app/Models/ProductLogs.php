<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Products;

class ProductLogs extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'updated_stock',
        'description',
        'updated_by'
    ];

    public function logCreator(){
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function productName(){
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
}
