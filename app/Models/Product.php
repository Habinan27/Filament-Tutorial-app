<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'sku',
        'description',
        'stock',
        'price',
        'image',
        'is_active',
        'is_featured',

    ];
}
