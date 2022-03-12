<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ServiceImage;

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

        $banners = ServiceImage::all();

        foreach ($banners as $product) {
            $productModel = ServiceImage::where('id', $product->id)->first();
            $productModel->image_1 = str_replace('https://adminrmvet2.sytes.net', 'https://cms.rymveterinaria.com', $product->image_1);
            $productModel->image_2 = str_replace('https://adminrmvet2.sytes.net', 'https://cms.rymveterinaria.com', $product->image_2);
            $productModel->image_3 = str_replace('https://adminrmvet2.sytes.net', 'https://cms.rymveterinaria.com', $product->image_3);
            $productModel->update();
        }
    }
}
