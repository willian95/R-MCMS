<?php

namespace App\Exports;

use App\Models\Brand;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class BrandsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('brands.exports.excel', [
            'brands' => Brand::all()
        ]);
    }
}
