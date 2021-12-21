<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    public function couponUsers(){

        return $this->hasMany(CouponUser::class);

    }

    public function couponProductFormats(){

        return $this->hasMany(CouponProductFormat::class);

    }
}
