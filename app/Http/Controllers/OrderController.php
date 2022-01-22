<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PaymentExport;

class OrderController extends Controller
{
    function fetch(Request $request){

        try{

            $shoppings = Payment::with("productPurchases", "productPurchases.productFormat", "productPurchases.productFormat.product", "productPurchases.productFormat.size", "productPurchases.productFormat.color")->has("productPurchases")
            ->has("productPurchases.productFormat")->has( "productPurchases.productFormat.product")->has( "productPurchases.productFormat.size")->orderBy('id', 'desc')->paginate(20);

            return response()->json($shoppings);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function excelExport(){
        return Excel::download(new PaymentExport, 'ventas.xlsx');
    }
}
