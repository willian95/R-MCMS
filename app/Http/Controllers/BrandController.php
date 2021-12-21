<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Http\Requests\Brand\BrandStoreRequest;
use App\Http\Requests\Brand\BrandUpdateRequest;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BrandsExport;
use PDF;

class BrandController extends Controller
{
    function store(BrandStoreRequest $request){

        try{

            $brand = new Brand;
            $brand->name = $request->name;
            $brand->image = $request->image;
            $brand->save();

            return response()->json(["success" => true, "msg" => "Marca creada"]);

        }catch(\Exception $e){

            //todeleteinproduction
            return response()->json(["success" => false, "msg" => "Hubo un problema", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

    }

    function update(BrandUpdateRequest $request){

        try{


            $brand = Brand::find($request->id);
            $brand->name = $request->name;
            if(isset($request->image)){
                $brand->image = $request->image;
            }
            $brand->update();


            return response()->json(["success" => true, "msg" => "Marca actualizada"]);

        }catch(\Exception $e){

            //todeleteinproduction
            return response()->json(["success" => false, "msg" => "Hubo un problema", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

    }

    function delete(Request $request){

        $brand = Brand::find($request->id);
        if(!$brand){
            
            return response()->json(["success"=> false, "msg" => "Marca no encontrada"]);

        }else{
            $brand->delete();
            return response()->json(["success" => true, "msg" => "Marca eliminada"]);

        }
    }

    function fetch(Request $request){

        $brands = Brand::paginate(20);
        return response()->json($brands);
    }


    function all(){

        $brands = Brand::all();
        return response()->json($brands);
    }

    function edit($id){

        $brand = Brand::find($id);
        if(!$brand){
            abort(404);
        }else{  
            return view("brands.edit.index", ["brand" =>$brand]);
        }

    }

    function excelExport(){
        return Excel::download(new BrandsExport, 'marcas.xlsx');
    }

    function csvExport(){
        return Excel::download(new BrandsExport, 'marcas.csv');
    }

    function pdfExport(){
        $pdf = PDF::loadView('brands.exports.pdf');
        return $pdf->stream();
    }
}
