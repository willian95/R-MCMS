<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    function fetch(Request $request){

        try{

            $shoppings = Payment::with("productPurchases", "user", "guest", "productPurchases.productFormat", "productPurchases.productFormat.product", "productPurchases.productFormat.product.brand", "productPurchases.productFormat.size")->has("productPurchases")
            ->has("productPurchases.productFormat")->has( "productPurchases.productFormat.product")->has( "productPurchases.productFormat.product.brand")->has( "productPurchases.productFormat.size")->orderBy('id', 'desc')->paginate(20);

            return response()->json($shoppings);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }
}
