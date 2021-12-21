<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponProductFormat extends Model
{
    use HasFactory;

    public function couponProductFormatss(){

        return $this->belongsTo(Coupon::class);

    }

    public function productFormat(){

        return $this->belongsTo(ProductFormat::class);

    }
}
