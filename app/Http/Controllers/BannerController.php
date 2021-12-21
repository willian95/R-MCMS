<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Banner\BannerStoreRequest;
use App\Http\Requests\Banner\BannerUpdateRequest;
use App\Models\Banner;

class BannerController extends Controller
{
    
    function store(BannerStoreRequest $request){

        try{

            $banner = new Banner;
            $banner->name = $request->name;
            $banner->image = $request->image;
            $banner->type = $request->type;
            $banner->link = $request->url;
            $banner->save();

            return response()->json(["success" => true, "msg" => "Banner creado"]);

        }catch(\Exception $e){

            //todeleteinproduction
            return response()->json(["success" => false, "msg" => "Hubo un problema", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

    }

    function update(BannerUpdateRequest $request){

        try{


            $banner = Banner::find($request->id);
            $banner->name = $request->name;
            $banner->link = $request->url;
            if(isset($request->image)){
                $banner->image = $request->image;
                $banner->type = $request->type;
            }
            $banner->update();


            return response()->json(["success" => true, "msg" => "Banner actualizado"]);

        }catch(\Exception $e){

            //todeleteinproduction
            return response()->json(["success" => false, "msg" => "Hubo un problema", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

    }

    function delete(Request $request){

        $banner = Banner::find($request->id);
        if(!$banner){
            
            return response()->json(["success"=> false, "msg" => "Banner no encontrada"]);

        }else{
            $banner->delete();
            return response()->json(["success" => true, "msg" => "Banner eliminado"]);

        }
    }

    function fetch(Request $request){

        $banners = Banner::paginate(20);
        return response()->json($banners);
    }

    function edit($id){

        $banner = Banner::find($id);
        if(!$banner){
            abort(404);
        }else{  
            return view("banners.edit.index", ["banner" =>$banner]);
        }

    }

}
