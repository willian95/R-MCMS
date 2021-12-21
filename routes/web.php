<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ServiceImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware("guest")->name("login");

Route::post("login", [AuthController::class, "login"]);
Route::get("logout", [AuthController::class, "logout"])->name("logout");

Route::get('/home', function () {
    return view('dashboard');
})->middleware("auth");

Route::post("/ckeditor/upload", [CKEditorController::class, "upload"])->name("ckeditor.upload");
Route::post("upload/picture", [FileController::class, "upload"]);

Route::view("blogs/create", "blogs.create.index")->name("blogs.create")->middleware("auth");
Route::view("blogs/list", "blogs.list.index")->name("blogs.list")->middleware("auth");
Route::post("blogs/store", [BlogController::class, "store"])->name("blogs.store");
Route::post("blogs/update", [BlogController::class, "update"])->name("blogs.update");
Route::post("blogs/delete", [BlogController::class, "delete"])->name("blogs.delete");
Route::get("blogs/fetch", [BlogController::class, "fetch"])->name("blogs.fetch");
Route::get("blogs/edit/{id}", [BlogController::class, "edit"]);

Route::view("categories/create", "categories.create.index")->name("categories.create")->middleware("auth");
Route::view("categories/list", "categories.list.index")->name("categories.list")->middleware("auth");
Route::post("categories/store", [CategoryController::class, "store"])->name("categories.store");
Route::post("categories/update", [CategoryController::class, "update"])->name("categories.update");
Route::post("categories/delete", [CategoryController::class, "delete"])->name("categories.delete");
Route::get("categories/fetch", [CategoryController::class, "fetch"])->name("categories.fetch");
Route::get("categories/all", [CategoryController::class, "all"])->name("categories.all");
Route::get("categories/edit/{id}", [CategoryController::class, "edit"]);
Route::get("categories/excel", [CategoryController::class, "excelExport"]);
Route::get("categories/csv", [CategoryController::class, "csvExport"]);
Route::get("categories/pdf", [CategoryController::class, "pdfExport"]);

Route::view("sizes/create", "sizes.index")->name("sizes.index")->middleware("auth");
Route::post("sizes/store", [SizeController::class, "store"])->name("sizes.store");
Route::post("sizes/update", [SizeController::class, "update"])->name("sizes.update");
Route::post("sizes/delete", [SizeController::class, "delete"])->name("sizes.delete");
Route::get("sizes/all", [SizeController::class, "all"])->name("sizes.all");
Route::get("sizes/fetch", [SizeController::class, "fetch"])->name("sizes.fetch");
Route::get("sizes/excel", [SizeController::class, "excelExport"]);
Route::get("sizes/csv", [SizeController::class, "csvExport"]);
Route::get("sizes/pdf", [SizeController::class, "pdfExport"]);

Route::view("colors/create", "colors.index")->name("colors.index")->middleware("auth");
Route::post("colors/store", [ColorController::class, "store"])->name("colors.store");
Route::post("colors/update", [ColorController::class, "update"])->name("colors.update");
Route::post("colors/delete", [ColorController::class, "delete"])->name("colors.delete");
Route::get("colors/all", [ColorController::class, "all"])->name("colors.all");
Route::get("colors/fetch", [ColorController::class, "fetch"])->name("colors.fetch");
Route::get("colors/excel", [ColorController::class, "excelExport"]);
Route::get("colors/csv", [ColorController::class, "csvExport"]);
Route::get("colors/pdf", [ColorController::class, "pdfExport"]);

Route::view("brands/create", "brands.create.index")->name("brands.create")->middleware("auth");
Route::view("brands/list", "brands.list.index")->name("brands.list")->middleware("auth");
Route::post("brands/store", [BrandController::class, "store"])->name("brands.store");
Route::post("brands/update", [BrandController::class, "update"])->name("brands.update");
Route::post("brands/delete", [BrandController::class, "delete"])->name("brands.delete");
Route::get("brands/fetch", [BrandController::class, "fetch"])->name("brands.fetch");
Route::get("brands/all", [BrandController::class, "all"])->name("brands.all");
Route::get("brands/edit/{id}", [BrandController::class, "edit"]);
Route::get("brands/excel", [BrandController::class, "excelExport"]);
Route::get("brands/csv", [BrandController::class, "csvExport"]);
Route::get("brands/pdf", [BrandController::class, "pdfExport"]);

Route::view("banners/create", "banners.create.index")->name("banners.create")->middleware("auth");
Route::view("banners/list", "banners.list.index")->name("banners.list")->middleware("auth");
Route::post("banners/store", [BannerController::class, "store"])->name("banners.store");
Route::post("banners/update", [BannerController::class, "update"])->name("banners.update");
Route::post("banners/delete", [BannerController::class, "delete"])->name("banners.delete");
Route::get("banners/fetch", [BannerController::class, "fetch"])->name("banners.fetch");
Route::get("banners/edit/{id}", [BannerController::class, "edit"]);

Route::view("products/create", "products.create.index")->name("products.create")->middleware("auth");
Route::view("products/list", "products.list.index")->name("products.list")->middleware("auth");
Route::post("products/store", [ProductController::class, "store"])->name("products.store");
Route::post("banners/update", [ProductController::class, "update"])->name("products.update");
Route::post("products/delete", [ProductController::class, "delete"])->name("products.delete");
Route::get("products/fetch", [ProductController::class, "fetch"])->name("products.fetch");
Route::get("products/edit/{id}", [ProductController::class, "edit"]);
Route::post("products/search", [ProductController::class, "search"])->name("products.search");
Route::get("products/excel", [ProductController::class, "excelExport"]);
Route::get("products/csv", [ProductController::class, "csvExport"]);
Route::get("products/pdf", [ProductController::class, "pdfExport"]);

Route::view("staffs/create", "staffs.create.index")->name("staffs.create")->middleware("auth");
Route::view("staffs/list", "staffs.list.index")->name("staffs.list")->middleware("auth");
Route::post("staffs/store", [StaffController::class, "store"])->name("staffs.store");
Route::post("staffs/update", [StaffController::class, "update"])->name("staffs.update");
Route::post("staffs/delete", [StaffController::class, "delete"])->name("staffs.delete");
Route::get("staffs/fetch", [StaffController::class, "fetch"])->name("staffs.fetch");
Route::get("staffs/all", [StaffController::class, "all"])->name("staffs.all");
Route::get("staffs/edit/{id}", [StaffController::class, "edit"]);
Route::get("staffs/excel", [StaffController::class, "excelExport"]);
Route::get("staffs/csv", [StaffController::class, "csvExport"]);
Route::get("products/pdf", [ProductController::class, "pdfExport"]);

Route::view("orders/index", "orders.index")->name("orders.index")->middleware("auth");
Route::get("orders/fetch", [OrderController::class, "fetch"])->name("orders.fetch");

Route::view("clients/index", "clients.index")->name("clients.index")->middleware("auth");
Route::get("clients/fetch", [ClientController::class, "fetch"])->name("clients.fetch");
Route::post("clients/search", [ClientController::class, "search"])->name("clients.search");
Route::get("clients/excel", [ClientController::class, "excelExport"]);
Route::get("clients/csv", [ClientController::class, "csvExport"]);
Route::get("clients/pdf", [ClientController::class, "pdfExport"]);

Route::get("/coupons/index", [CouponController::class, "index"])->name("coupons.index")->middleware("auth");
Route::get("/coupons/create", [CouponController::class, "create"])->name("coupons.create");
Route::get("/coupons/fetch", [CouponController::class, "fetch"])->name("coupons.fetch");
Route::post("/coupons/store", [CouponController::class, "store"])->name("coupons.store");
Route::post("/coupons/delete", [CouponController::class, "delete"])->name("coupons.delete");
Route::get("coupons/excel", [CouponController::class, "excelExport"]);
Route::get("coupons/csv", [CouponController::class, "csvExport"]);
Route::get("coupons/pdf", [CouponController::class, "pdfExport"]);

Route::view("service-images/index", "serviceImages.index")->name("service-images.index")->middleware("auth");
Route::post("service-images/store", [ServiceImageController::class, "store"])->name("service-images.store");