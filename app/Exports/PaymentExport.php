<?php

namespace App\Exports;

use App\Models\Payment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PaymentExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('orders.exports.excel', [
            'payments' => Payment::with("productPurchases", "productPurchases.productFormat", "productPurchases.productFormat.product", "productPurchases.productFormat.size", "productPurchases.productFormat.color")->has("productPurchases")
            ->has("productPurchases.productFormat")->has( "productPurchases.productFormat.product")->has( "productPurchases.productFormat.size")->orderBy('id', 'desc')->get()
        ]);
    }
}
