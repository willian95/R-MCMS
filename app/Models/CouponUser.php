<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponUser extends Model
{
    use HasFactory;

    public function couponUsers(){

        return $this->belongsTo(Coupon::class);

    }

    public function user(){

        return $this->belongsTo(User::class);

    }
}
