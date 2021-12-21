<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Blog\BlogStoreRequest;
use App\Http\Requests\Blog\BlogUpdateRequest;
use App\Models\Blog;

class BlogController extends Controller
{
    function store(BlogStoreRequest $request){

        try{
            $slug = $this->makeSlug($request->title);

            if(Blog::where("slug", $slug)->count() > 0){

                $slug = $slug.uniqid();

            }

            $blog = new Blog;
            $blog->title = $request->title;
            $blog->description = $request->description;
            $blog->image = $request->image;
            $blog->slug = $slug;
            $blog->save();

            return response()->json(["success" => true, "msg" => "Blog creado"]);

        }catch(\Exception $e){

            //todeleteinproduction
            return response()->json(["success" => false, "msg" => "Hubo un problema", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

    }

    function update(BlogUpdateRequest $request){

        try{
            $slug = $this->makeSlug($request->title);

            if(Blog::where("slug", $slug)->count() > 0){

                $slug = $slug.uniqid();

            }

            $blog = Blog::find($request->id);

            if(!$blog){

                return response()->json(["success" => false, "msg" => "Blog no encontrado"]);

            }else{

                $blog->title = $request->title;
                $blog->description = $request->description;
                if(isset($request->image)){
                    $blog->image = $request->image;
                }
                
                $blog->slug = $slug;
                $blog->update();

            }

            return response()->json(["success" => true, "msg" => "Blog actualizado"]);

        }catch(\Exception $e){

            //todeleteinproduction
            return response()->json(["success" => false, "msg" => "Hubo un problema", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

    }

    function makeSlug($title){

        $slug = strtolower($title);
        $slug = str_replace("á", "a", $slug);
        $slug = str_replace("é", "e", $slug);
        $slug = str_replace("í", "i", $slug);
        $slug = str_replace("ó", "o", $slug);
        $slug = str_replace("ú", "u", $slug);
        $slug = str_replace("/", "", $slug);
        $slug = str_replace(" ", "-", $slug);
        $slug = str_replace("?", "", $slug);
        return $slug;
    }

    function fetch(Request $request){

        $blogs = Blog::paginate(20);
        return response()->json($blogs);
    }


    function delete(Request $request){

        $blog = Blog::find($request->id);
        if(!$blog){
            
            return response()->json(["success"=> false, "msg" => "Blog no encontrado"]);

        }else{
            $blog->delete();
            return response()->json(["success" => true, "msg" => "Blog eliminado"]);

        }
    }

    function edit($id){

        $blog = Blog::find($id);
        if(!$blog){
            abort(404);
        }else{  
            return view("blogs.edit.index", ["blog" =>$blog]);
        }

    }
}
