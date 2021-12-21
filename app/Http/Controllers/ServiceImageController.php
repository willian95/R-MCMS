<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceImage;
use App\Http\Requests\ServiceImage\ServiceImageStoreRequest;

class ServiceImageController extends Controller
{
    
    function store(ServiceImageStoreRequest $request){

        if(ServiceImage::count() == 0){

            $serviceImage = new ServiceImage;
            if(isset($request->image1)){
                $serviceImage->image1 = $request->image1;
                $serviceImage->type1 = $request->type1;
            }

            if(isset($request->image2)){
                $serviceImage->image2 = $request->image2;
                $serviceImage->type2 = $request->type2;
            }

            if(isset($request->image3)){
                $serviceImage->image3 = $request->image3;
                $serviceImage->type3 = $request->type3;
            }

            $serviceImage->save();
            

        }else{

            $serviceImage = ServiceImage::first();
            if(isset($request->image1)){
                $serviceImage->image1 = $request->image1;
                $serviceImage->type1 = $request->type1;
            }

            if(isset($request->image2)){
                $serviceImage->image2 = $request->image2;
                $serviceImage->type2 = $request->type2;
            }

            if(isset($request->image3)){
                $serviceImage->image3 = $request->image3;
                $serviceImage->type3 = $request->type3;
            }

            $serviceImage->update();

        }

        return response()->json(["success" => true, "msg" => "Imágenes de servicios actualizadas"]);

    }

}
