<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;
use App\Http\Requests\Size\SizeStoreRequest;
use App\Http\Requests\Size\SizeUpdateRequest;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SizesExport;
use PDF;

class SizeController extends Controller
{
    function store(Request $request){

        try{

            $size = new Size;
            $size->size = $request->size;
            $size->save();

            return response()->json(["success" => true, "msg" => "Talla creada"]);

        }catch(\Exception $e){

            //todeleteinproduction
            return response()->json(["success" => false, "msg" => "Hubo un problema", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

    }

    function update(Request $request){

        try{


            $size = Size::find($request->id);
            $size->size = $request->size;
            $size->update();

            return response()->json(["success" => true, "msg" => "Talla actualizada"]);

        }catch(\Exception $e){

            //todeleteinproduction
            return response()->json(["success" => false, "msg" => "Hubo un problema", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

    }

    function delete(Request $request){

        $size = Size::find($request->id);
        if(!$size){
            
            return response()->json(["success"=> false, "msg" => "Talla no encontrada"]);

        }else{
            $size->delete();
            return response()->json(["success" => true, "msg" => "Talla eliminada"]);

        }
    }

    function fetch(Request $request){

        $sizes = Size::get();
        return response()->json($sizes);
    }

    function all(){

        $sizes = Size::get();
        return response()->json($sizes);
    }

    function excelExport(){
        return Excel::download(new SizesExport, 'tallas.xlsx');
    }

    function csvExport(){
        return Excel::download(new SizesExport, 'tallas.csv');
    }

    function pdfExport(){
        $pdf = PDF::loadView('sizes.exports.pdf');
        return $pdf->stream();
    }
}
