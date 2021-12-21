<?php

namespace App\Exports;

use App\Models\Color;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class ColorsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('colors.exports.excel', [
            'colors' => Color::all()
        ]);
    }
}
