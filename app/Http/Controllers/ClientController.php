<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use PDF;

class ClientController extends Controller
{
    function fetch(Request $request){

        $clients = User::where("role_id", 2)->paginate(20);
        return response()->json($clients);
    }

    function search(Request $request){

        $users = User::where("name", "like", '%'.$request->search.'%')->orWhere("email", "like", '%'.$request->search.'%')->take(20)->where("role_id", 2)->get();
        
        return response()->json(["users" => $users]);

    }

    function excelExport(){
        return Excel::download(new UsersExport, 'clientes.xlsx');
    }

    function csvExport(){
        return Excel::download(new UsersExport, 'clientes.csv');
    }

    function pdfExport(){
        $pdf = PDF::loadView('clients.exports.pdf');
        return $pdf->stream();
    }

    
}
