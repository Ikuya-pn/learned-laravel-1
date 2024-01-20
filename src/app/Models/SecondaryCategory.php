<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PrimaryCategory;
use App\Models\Product;

class SecondaryCategory extends Model
{
    use HasFactory;

    public function primary()
    {
        return $this->belongsTo(PrimaryCategory::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
