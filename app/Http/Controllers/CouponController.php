<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\CouponUser;
use App\Models\CouponProductFormat;
use App\Models\User;
use App\Http\Requests\Coupon\CouponStoreRequest;
use App\Mail\CouponMail;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CouponsExport;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\PDF;

class CouponController extends Controller
{
    function index(){

        return view("coupons.list.index");

    }

    function create(){

        return view("coupons.create.index");

    }

    function store(CouponStoreRequest $request){

        try{

            $coupon = new Coupon;
            $coupon->discount_type = $request->discountType;
            $coupon->total_discount = $request->totalDiscount;
            $coupon->discount_amount = $request->discountAmount;
            $coupon->end_date = $request->endDate;
            $coupon->all_users = $request->allUsers;
            $coupon->all_products = $request->allProducts;
            $coupon->coupon_code = $request->couponCode;
            $coupon->save();

            $this->addUsers($request, $coupon->id);
            $this->addProducts($request, $coupon->id);

            foreach($request->users as $user){

                $data = [
                    "discount_type" => $request->discountType,
                    "total_discount" => $request->totalDiscount,
                    "discount_amount" => $request->discountAmount,
                    "end_date" => $request->endDate,
                    "all_users" => $request->allUsers,
                    "all_products" => $request->allProducts,
                    "coupon_code" => $request->couponCode,
                    "products" => $request->products,
                    "user_name" => $user["name"],
                    "APP_URL" => env("FRONT_URL")
                ];

                Mail::to($user["email"])->queue(
                    new CouponMail($data)
                );

            }

            return response()->json(["success" => true, "msg" => "Cupón creado"]);

        }catch(\Exception $e){  

            return response()->json(["success" => false, "msg" => "Hubo un problema", "err" => $e->getMessage()]);

        }

    }

    function fetch(){

        $coupons = Coupon::with(["couponUsers", "couponProductFormats", "couponUsers.user", "couponProductFormats.productFormat", "couponProductFormats.productFormat.product", "couponProductFormats.productFormat.size", "couponProductFormats.productFormat.color", "couponProductFormats.productFormat.product.brand"])->orderBy("id", "desc")->paginate(10);
        return response()->json(["coupons" => $coupons]);

    }

    function addUsers($request, $coupon_id){

        if($request->allUsers == false){

            foreach($request->users as $user){
           
                $couponUser = new CouponUser;
                $couponUser->user_id = $user["id"];
                $couponUser->coupon_id = $coupon_id;
                $couponUser->save();

            }

        }

    }

    function addProducts($request, $coupon_id){

        if($request->allProducts == false){

            foreach($request->products as $product){

                $couponProduct = new CouponProductFormat;
                $couponProduct->product_format_id = $product["id"];
                $couponProduct->coupon_id = $coupon_id;
                $couponProduct->save();

            }

        }

    }

    function delete(Request $request){
        try{

            $productFormats = CouponProductFormat::where("coupon_id", $request->id)->get();

            foreach($productFormats as $productFormat){

                $productFormat->delete();

            }

            $couponUsers = CouponUser::where("coupon_id", $request->id)->get();

            foreach($couponUsers as $couponUser){

                $couponUser->delete();

            }

            Coupon::where("id", $request->id)->first()->delete();

            return response()->json(["success" => true, "msg" => "Cupón eliminado"]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Hubo un problema", "err" => $e->getMessage()]);

        }
        

    }

    function excelExport(){
        return Excel::download(new CouponsExport, 'cupones.xlsx');
    }

    function csvExport(){
        return Excel::download(new CouponsExport, 'cupones.csv');
    }

    function pdfExport(){
        $pdf = PDF::loadView('coupons.exports.pdf');
        return $pdf->stream();
    }

}
