<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSecondaryImage;

class ReviewController extends Controller
{
    public function review()
    {
        /*$products = Product::all();

        foreach ($products as $product) {
            $productModel = Product::where('id', $product->id)->first();
            $productModel->image = str_replace('https://adminrmvet2.sytes.net', 'https://cms.rymveterinaria.com', $product->image);
            $productModel->image_hover = str_replace('https://adminrmvet2.sytes.net', 'https://cms.rymveterinaria.com', $product->image_hover);
            $productModel->update();
        }*/

        $banners = ProductSecondaryImage::all();

        foreach ($banners as $product) {
            $productModel = ProductSecondaryImage::where('id', $product->id)->first();
            $productModel->image = str_replace('https://adminrmvet2.sytes.net', 'https://cms.rymveterinaria.com', $product->image);
            $productModel->update();
        }
    }
}
