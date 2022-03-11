<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ReviewController extends Controller
{
    public function review()
    {
        $products = Product::all();

        foreach ($products as $product) {
            echo str_replace('https://adminrmvet2.sytes.net', 'https://cms.rymveterinaria.com', $product->image);
            echo '<br>';
        }
    }
}
