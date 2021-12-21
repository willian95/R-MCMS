<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;
use App\Http\Requests\Color\ColorStoreRequest;
use App\Http\Requests\Color\ColorUpdateRequest;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ColorsExport;
use PDF;

class ColorController extends Controller
{
    function store(ColorStoreRequest $request){

        try{

            $color = new Color;
            $color->color = $request->color;
            $color->hex = $request->hex;
            $color->save();

            return response()->json(["success" => true, "msg" => "Color creado"]);

        }catch(\Exception $e){

            //todeleteinproduction
            return response()->json(["success" => false, "msg" => "Hubo un problema", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

    }

    function update(ColorUpdateRequest $request){

        try{


            $color = Color::find($request->id);
            $color->color = $request->color;
            $color->hex = $request->hex;
            $color->update();

            return response()->json(["success" => true, "msg" => "Color actualizado"]);

        }catch(\Exception $e){

            //todeleteinproduction
            return response()->json(["success" => false, "msg" => "Hubo un problema", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

    }

    function delete(Request $request){

        $color = Color::find($request->id);
        if(!$color){
            
            return response()->json(["success"=> false, "msg" => "Color no encontrado"]);

        }else{
            $color->delete();
            return response()->json(["success" => true, "msg" => "Color eliminado"]);

        }
    }

    function fetch(Request $request){

        $colors = Color::get();
        return response()->json($colors);
    }

    function all(){

        $colors = Color::get();
        return response()->json($colors);
    }

    function excelExport(){
        return Excel::download(new ColorsExport, 'colores.xlsx');
    }

    function csvExport(){
        return Excel::download(new ColorsExport, 'colores.csv');
    }

    function pdfExport(){
        $pdf = PDF::loadView('colors.exports.pdf');
        return $pdf->stream();
    }
}
