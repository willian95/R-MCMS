<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class FileController extends Controller
{
    function upload(Request $request){

        ini_set('upload_max_size', '20M');
        ini_set('post_max_size', '20M');
        ini_set( 'max_execution_time', '300' );

        $fileType = "";
        $originName = $request->file('file')->getClientOriginalName();
        $extension = $request->file('file')->getClientOriginalExtension();
        $fileName = Carbon::now()->timestamp . '_' . uniqid().'.'.$extension;
    
        $request->file('file')->move(public_path('img'), $fileName);
        $fileRoute = url('/').'/img/'.$fileName;

        if(isset($request->secondaryFileType)){
            $fileType = $request->secondaryFileType;
        }

        //$img = ImageManagerStatic::make('img/'.$fileName);
        //$img->save('img/'.$fileName, 60);

        return response()->json(["fileRoute" => $fileRoute, "originalName" => $originName,"extension" => $extension, "fileType" => $fileType]);

    }
}
