<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ReviewController extends Controller
{
    public function review()
    {
        $products = Product::all();

        foreach ($products as $product) {
            echo $product->image.'<br>';
            echo $product->image_hover.'<br>';
            echo '<br>';
            echo '<br>';
        }
    }
}
