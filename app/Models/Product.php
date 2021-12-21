<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function secondaryImages(){
        return $this->hasMany(ProductSecondaryImage::class);
    }

    public function productFormats(){
        return $this->hasMany(ProductFormat::class);
    }

    /*public function productPurchase(){
        return $this->hasMany(ProductPurchase::class);
    }*/
}
