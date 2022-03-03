<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductSecondaryImage;
use App\Models\ProductFormat;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExport;
use PDF;

class ProductController extends Controller
{
    function store(ProductStoreRequest $request){
        foreach($request->productFormatSizes as $test){

            if($test["color"] == null || $test["size"] == null || $test["price"] == null || $test["stock"] == null){
                //return response()->json($test["format"]["name"]);
                return response()->json(["success" => false, "msg" => "Debe completar todos los campos de las presentaciones"]);
            }

        }

        try{

            $slug = str_replace(" ","-", $request->name);
            $slug = str_replace("/", "-", $slug);

            if(Product::where("slug", $slug)->count() > 0){
                $slug = $slug."-".uniqid();
            }

            $product = new Product;
            $product->name = $request->name;
            $product->category_id = $request->category;
            $product->brand_id = $request->brand;
            $product->description = $request->description;
            $product->image = $request->image;
            $product->image_hover = $request->imageHover;
            $product->slug = $slug;
            $product->save();

            foreach($request->workImages as $workImage){

                $image = new ProductSecondaryImage;
                $image->product_id = $product->id;
                $image->image = $workImage['finalName'];
                $image->type = $workImage['type'];
                $image->save();

            }

            foreach($request->productFormatSizes as $productFormatSize){

                $slug = $product->slug."-".$productFormatSize["color"]["color"]."-".$productFormatSize["size"]["size"];

                if(ProductFormat::where("slug", $slug)->count() > 0){
                    $slug = $slug."-".uniqid();
                }

                $productFormatSizeModel = new ProductFormat;
                $productFormatSizeModel->product_id = $product->id;
                $productFormatSizeModel->color_id = $productFormatSize["color"]["id"];
                $productFormatSizeModel->size_id = $productFormatSize["size"]["id"];
                $productFormatSizeModel->slug = $slug;
                $productFormatSizeModel->stock = $productFormatSize["stock"];
                $productFormatSizeModel->price = $productFormatSize["price"];
                $productFormatSizeModel->discount_price = $productFormatSize["discount_price"];
                $productFormatSizeModel->save();

            }

            return response()->json(["success" => true, "msg" => "Producto creado"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "false" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }
    }

    function update(ProductUpdateRequest $request){

        foreach($request->productFormatSizes as $test){

            if($test["color"] == null || $test["size"] == null || $test["price"] == null || $test["stock"] == null){
                //return response()->json($test["format"]["name"]);
                return response()->json(["success" => false, "msg" => "Debe completar todos los campos de las presentaciones"]);
            }

        }

        try{

            $product = Product::find($request->id);
            $product->name = $request->name;
            $product->category_id = $request->category;
            $product->brand_id = $request->brand;
            $product->description = $request->description;
            if($request->get("image") != null){
                $product->image =  $request->image;
            }

            if($request->get("imageHover") != null){
                $product->image_hover = $request->imageHover;
            }
            
            $product->update();

            $productTypeArray = [];
            $productTypes = ProductFormat::where("product_id", $product->id)->get();
            foreach($productTypes as $productType){
                array_push($productTypeArray, $productType->id);
            }

            $requestArray = [];
            foreach($request->productFormatSizes as $productTypeSizeRequest){
                if(array_key_exists("id", $productTypeSizeRequest)){
                    array_push($requestArray, $productTypeSizeRequest["id"]);
                }
            }

            $deleteProductTypes = array_diff($productTypeArray, $requestArray);
            
            foreach($deleteProductTypes as $productDelete){
                ProductFormat::where("id", $productDelete)->delete();
            }

            foreach($request->productFormatSizes as $productTypeSize){
                
                if(array_key_exists("id", $productTypeSize)){

                    if(ProductFormat::where("id", $productTypeSize["id"])->count() > 0){
                        $productType = ProductFormat::find($productTypeSize["id"]);
                        $productType->product_id = $product->id;
                        $productType->color_id = $productTypeSize["color_id"];
                        $productType->size_id = $productTypeSize["size_id"];
                        $productType->price = $productTypeSize["price"];
                        $productType->discount_price = $productTypeSize["discount_price"];
                        $productType->stock = $productTypeSize["stock"];
                        $productType->update();
                    }

                }else{
                   
                    $slug = $product->slug."-".$productTypeSize["color"]["color"];

                    if(ProductFormat::where("slug", $slug)->count() > 0){
                        $slug = $slug."-".uniqid();
                    }

                    $productFormatSizeModel = new ProductFormat;
                    $productFormatSizeModel->product_id = $product->id;
                    $productFormatSizeModel->color_id = $productTypeSize["color"]["id"];
                    $productFormatSizeModel->size_id = $productTypeSize["size"]["id"];
                    $productFormatSizeModel->slug = $slug;
                    $productFormatSizeModel->stock = $productTypeSize["stock"];
                    $productFormatSizeModel->price = $productTypeSize["price"];
                    $productFormatSizeModel->discount_price = $productTypeSize["discount_price"];
                    $productFormatSizeModel->save();
                }
                

            }

            $WorkImagesArray = [];
            $workImages = ProductSecondaryImage::where("product_id", $product->id)->get();
            foreach($workImages as $productSecondaryImage){
                array_push($WorkImagesArray, $productSecondaryImage->id);
            }

            $requestArray = [];
            foreach($request->workImages as $image){
                if(array_key_exists("id", $image)){
                    array_push($requestArray, $image["id"]);
                }
            }

            $deleteWorkImages = array_diff($WorkImagesArray, $requestArray);

            //dd($WorkImagesArray, $requestArray, $deleteWorkImages);
            
            foreach($deleteWorkImages as $imageDelete){
                ProductSecondaryImage::where("id", $imageDelete)->delete();
            }

            foreach($request->workImages as $workImage){
                if(isset($workImage["finalName"])){
                    
                    $image = new ProductSecondaryImage;
                    $image->product_id = $product->id;
                    $image->image = $workImage['finalName'];
                    $image->type = $workImage["type"];
                    $image->save();
                }

            }
       
            return response()->json(["success" => true, "msg" => "Producto actualizado"]);

        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }

    function fetch(){

        try{

            $products = Product::with(['category' => function ($q) {
                $q->withTrashed();
            }])->with(['brand' => function ($q) {
                $q->withTrashed();
            }])
            ->with(['productFormats' => function ($q) {
                $q->withTrashed();
            }])->with(['productFormats.color' => function ($q) {
                $q->withTrashed();
            }])
            ->with(['productFormats.size' => function ($q) {
                $q->withTrashed();
            }])->paginate(20);

            return response()->json($products);

        }catch(\Exception $e){
            return response()->json(["success" => true, "false" => "Error en el servidor", "err" => $e->getMessage(), "ln" => $e->getLine()]);
        }

    }
    
    function edit($id){

        $product = Product::with(['category' => function ($q) {
                        $q->withTrashed();
                    }])->with(['brand' => function ($q) {
                        $q->withTrashed();
                    }])
                    ->with(['productFormats' => function ($q) {
                        $q->withTrashed();
                    }])->with(['productFormats.color' => function ($q) {
                        $q->withTrashed();
                    }])
                    ->with(['productFormats.size' => function ($q) {
                        $q->withTrashed();
                    }])->where("id", $id)->first();
        if(!$product){
            abort(404);
        }else{  
            return view("products.edit.index", ["product" =>$product]);
        }

    }

    function delete(Request $request){

        $product = Product::find($request->id);
        if(!$product){
            
            return response()->json(["success"=> false, "msg" => "Producto no encontrado"]);

        }else{
            $product->delete();
            return response()->json(["success" => true, "msg" => "Producto eliminado"]);

        }
    }

    function search(Request $request){

        $products = ProductFormat::whereHas("product", function($q) use($request){
            $q->where("name", "like", "%".$request->search."%");
        })->with("product", "size", "color")->has("product")->has("size")->has("color")->take(20)->get();
        
        return response()->json(["products" => $products]);

    }

    function searchProducts(Request $request){

        $products = Product::where("name", "like", "%".$request->search."%")->with(['category' => function ($q) {
            $q->withTrashed();
        }])->with(['brand' => function ($q) {
            $q->withTrashed();
        }])
        ->with(['productFormats' => function ($q) {
            $q->withTrashed();
        }])->with(['productFormats.color' => function ($q) {
            $q->withTrashed();
        }])
        ->with(['productFormats.size' => function ($q) {
            $q->withTrashed();
        }])->paginate(20);

        return response()->json($products);

    }

    function excelExport(){
        return Excel::download(new ProductsExport, 'productos.xlsx');
    }

    function csvExport(){
        return Excel::download(new ProductsExport, 'productos.csv');
    }

    function pdfExport(){
        $pdf = PDF::loadView('products.exports.pdf');
        return $pdf->stream();
    }


}
