<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ReviewController extends Controller
{
    public function review()
    {
        $product = Product::all();

        dd($product);
    }
}
