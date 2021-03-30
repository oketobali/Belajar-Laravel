<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\User;
use App\Models\ProductLogs;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'product_name',
        'product_stock',
        'product_price',
        'created_by'
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function creator(){
        return $this->belongsTo(User::class,'created_by', 'id');
    }

    public function logsproduct(){
        return $this->belongsTo(ProductLogs::class,'product_id','id');
    }
}
