<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Http\Requests\Staff\StaffStoreRequest;
use App\Http\Requests\Staff\StaffUpdateRequest;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StaffsExport;
use PDF;

class StaffController extends Controller
{
    function store(StaffStoreRequest $request){

        try{

            $staff = new Staff;
            $staff->name = $request->name;
            $staff->image = $request->image;
            $staff->job = $request->job;
            $staff->save();
            return response()->json(["success" => true, "msg" => "Personal creada"]);

        }catch(\Exception $e){

            //todeleteinproduction
            return response()->json(["success" => false, "msg" => "Hubo un problema", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

    }

    function update(StaffUpdateRequest $request){

        try{

            $staff = Staff::find($request->id);
            $staff->name = $request->name;
            $staff->job = $request->job;
            if(isset($request->image)){
                $staff->image = $request->image;
            }
            $staff->update();


            return response()->json(["success" => true, "msg" => "Personal actualizado"]);

        }catch(\Exception $e){

            //todeleteinproduction
            return response()->json(["success" => false, "msg" => "Hubo un problema", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

    }

    function delete(Request $request){

        $staff = Staff::find($request->id);
        if(!$staff){
            
            return response()->json(["success"=> false, "msg" => "Personal no encontrado"]);

        }else{
            $staff->delete();
            return response()->json(["success" => true, "msg" => "Personal eliminado"]);

        }
    }

    function fetch(Request $request){

        $staffs = Staff::paginate(20);
        return response()->json($staffs);
    }

    function all(){

        $staffs = Staff::all();
        return response()->json($staffs);
    }

    function edit($id){

        $staff = Staff::find($id);
        if(!$staff){
            abort(404);
        }else{  
            return view("staffs.edit.index", ["staff" =>$staff]);
        }

    }

    function excelExport(){
        return Excel::download(new StaffsExport, 'personal.xlsx');
    }

    function csvExport(){
        return Excel::download(new StaffsExport, 'personal.csv');
    }

    function pdfExport(){
        $pdf = PDF::loadView('staffs.exports.pdf');
        return $pdf->stream();
    }

}
