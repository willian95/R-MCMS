<?php

namespace App\Exports;

use App\Models\Size;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class SizesExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('sizes.exports.excel', [
            'sizes' => Size::get()
        ]);
    }
}
