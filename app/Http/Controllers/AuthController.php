<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    function login(Request $request){
        
        try{

            $user = User::where("email", $request->email)->first();
            if($user){

                if (Auth::attempt(['email' => $request->email, 'password' => $request->password], true) && $user->role_id == 1) {
                    $url = redirect()->intended()->getTargetUrl();
                    return response()->json(["success" => true, "msg" => "Usuario autenticado", "role_id" => Auth::user()->role_id, "url" => $url]);
                }

            }else{
                return response()->json(["success" => false, "msg" => "Usuario no encontrado"]);
            }

        }catch(\Exception $e){

            return response()->json(["success" => false, "err" => $e->getMessage(), "ln" => $e->getLine(), "msg" => "Hubo un problema"]);
        }
    }

    function logout(){

        Auth::logout();
        return redirect()->to('/');

    }
}
