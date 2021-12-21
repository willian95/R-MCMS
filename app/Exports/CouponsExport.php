<?php

namespace App\Exports;

use App\Models\Coupon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CouponsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('coupons.exports.excel', [
            'coupons' => Coupon::all()
        ]);
    }
}
