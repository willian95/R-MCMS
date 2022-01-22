<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPurchase extends Model
{
    use HasFactory;

    public function payment(){
        return $this->belongsTo(Payment::class);
    }

    public function productFormat(){
        return $this->belongsTo(ProductFormat::class);
    }

}
