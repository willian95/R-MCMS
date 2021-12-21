<?php

namespace App\Http\Requests\Coupon;

use Illuminate\Foundation\Http\FormRequest;

class CouponStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "couponCode" => "required|unique:coupons,coupon_code",
            "endDate" => "required|date|after_or_equal:".date('Y-m-d'),
            "discountAmount" => "required"
        ];
    }
}
