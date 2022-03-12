<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\ServiceImage;

class ReviewController extends Controller
{
    public function review()
    {
        $brands = Brand::all();

        foreach ($brands as $brand) {
            $productModel = Brand::where('id', $brand->id)->first();
            $productModel->image = str_replace('https://adminrmvet2.sytes.net', 'https://cms.rymveterinaria.com', $brand->image);
            $productModel->update();
        }

        /*$banners = Bran::all();

        foreach ($banners as $product) {
            $productModel = ServiceImage::where('id', $product->id)->first();
            $productModel->image1 = str_replace('adminrmvet2.sytes.net', 'https://cms.rymveterinaria.com', $product->image1);
            $productModel->image2 = str_replace('adminrmvet2.sytes.net', 'https://cms.rymveterinaria.com', $product->image2);
            $productModel->image3 = str_replace('adminrmvet2.sytes.net', 'https://cms.rymveterinaria.com', $product->image3);
            $productModel->update();
        }*/
    }
}
