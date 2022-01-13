<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CategoriesExport;
use PDF;

class CategoryController extends Controller
{
    function store(CategoryStoreRequest $request){

        try{

            $category = new Category;
            $category->name = $request->name;
            $category->image = $request->image;
            $category->dog_category = $request->dog_category;
            $category->cat_category = $request->cat_category;
            $category->save();

            return response()->json(["success" => true, "msg" => "Categoría creada"]);

        }catch(\Exception $e){

            //todeleteinproduction
            return response()->json(["success" => false, "msg" => "Hubo un problema", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

    }

    function update(CategoryUpdateRequest $request){

        try{


            $category = Category::find($request->id);
            $category->name = $request->name;
            $category->dog_category = $request->dog_category;
            $category->cat_category = $request->cat_category;
            if(isset($request->image)){
                $category->image = $request->image;
            }
            $category->update();


            return response()->json(["success" => true, "msg" => "Categoría actualizada"]);

        }catch(\Exception $e){

            //todeleteinproduction
            return response()->json(["success" => false, "msg" => "Hubo un problema", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

    }

    function delete(Request $request){

        $category = Category::find($request->id);
        if(!$category){
            
            return response()->json(["success"=> false, "msg" => "Categoría no encontrada"]);

        }else{
            $category->delete();
            return response()->json(["success" => true, "msg" => "Categoría eliminada"]);

        }
    }

    function fetch(Request $request){

        $categories = Category::paginate(20);
        return response()->json($categories);
    }

    function all(){

        $categories = Category::all();
        return response()->json($categories);
    }

    function edit($id){

        $category = Category::find($id);
        if(!$category){
            abort(404);
        }else{  
            return view("categories.edit.index", ["category" =>$category]);
        }

    }

    function excelExport(){
        return Excel::download(new CategoriesExport, 'categorias.xlsx');
    }

    function csvExport(){
        return Excel::download(new CategoriesExport, 'categorias.csv');
    }

    function pdfExport(){
        $pdf = PDF::loadView('categories.exports.pdf');
        return $pdf->stream();
    }
}
