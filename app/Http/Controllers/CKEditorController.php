<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CKEditorController extends Controller
{
    function upload(Request $request){

        $validator = Validator::make($request->all(), [
            'upload' =>  'required|file|mimes:jpeg,png,jpg,gif,mp4'
        ]);

        if ($validator->fails()) {
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = ''; 
            $msg = 'Image not supported'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
            exit;
        }

        $originName = $request->file('upload')->getClientOriginalName();
        $fileName = pathinfo($originName, PATHINFO_FILENAME);
        $extension = $request->file('upload')->getClientOriginalExtension();
        $fileName = $fileName.'_'.time().'.'.$extension;
    
        $request->file('upload')->move(public_path('img'), $fileName);

        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        $url = asset('img/'.$fileName); 
        $msg = 'Image uploaded successfully'; 
        $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', ''); window.localStorage.setItem('showCKEditorMsg', '$msg')</script>";
        //$response = "<script>window.localStorage.setItem('showCKEditorMsg', '$msg')</script>";
            
        @header('Content-type: text/html; charset=utf-8'); 
        echo $response;
        exit;

    }
}
