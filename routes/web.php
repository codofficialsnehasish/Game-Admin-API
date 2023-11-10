<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Sliders;
use App\Http\Controllers\Catagory;
use App\Http\Controllers\Sub_catagory;
use App\Http\Controllers\Game;
use App\Http\Controllers\Result;
use App\Http\Controllers\Wallet;
use App\Http\Controllers\Requests;


//======================= Login Routes =====================

Route::get("/",[Admin::class,"login"])->name("login");
Route::get("/logout",[Admin::class,"logout"]);
Route::get("/register_user",[Admin::class,"register_user"]);
Route::get("/changepass",[Admin::class,"change_password"])->middleware("auth");
Route::post("/changep",[Admin::class,"change_pass"]);


//======================= Dashboard Routes ======================

Route::get("/dashboard",[Admin::class,"dashboard"])->middleware("auth");


//============================ User Routes ==============================

Route::get("/register",[Admin::class,"register"])->middleware("admin");
Route::post("/adduser",[Admin::class,"adduser"]);
Route::get("/showuser",[Admin::class,"show_user"])->middleware("auth");
Route::post("/checkuser",[Admin::class,"checkuser"]);
Route::get("/del_user/{id}",[Admin::class,"del_user"])->middleware("admin");
Route::get("/edit_user/{id}",[Admin::class,"edit_user"])->middleware("admin");
Route::post("/updateuser",[Admin::class,"update_user"]);


//============================ Customer Routes ==============================

Route::get("/customer",[Admin::class,"customer"])->middleware("auth");
Route::post("/addcustomer",[Admin::class,"addcustomer"]);
Route::get("/showcustomer",[Admin::class,"showcustomer"])->middleware("auth");
Route::get("/customerdel/{id}",[Admin::class,"customerdel"])->middleware("auth");
Route::get("/editcustomer/{id}",[Admin::class,"edit_customer"])->middleware("auth");
Route::post("/update_customer",[Admin::class,"update_customer"]);


//============================ Slider Routes ========================

Route::get("/slider",[Sliders::class,"slider"])->middleware("auth"); 
Route::get("/slideradd",[Sliders::class,"sliderAdd"])->middleware("auth"); 
Route::post("/slider_submit",[Sliders::class,"slider_submit"]); 
Route::get("/slideredit/{id}",[Sliders::class,"sliderEdit"])->middleware("auth"); 
Route::post("/slider_edit_submit",[Sliders::class,"slider_edit_submit"]); 
Route::get("/slider_del/{id}",[Sliders::class,"slider_del"])->middleware("auth"); 


//============================ Catagory Routes ========================

Route::get("/catagory",[Catagory::class,"catagory"])->middleware("auth"); 
Route::post("/addcatagory",[Catagory::class,"addcatagory"]); 
Route::get("/show_catagory",[Catagory::class,"show_catagory"])->middleware("auth"); 
Route::get("/del_catagory/{id}",[Catagory::class,"del_catagory"])->middleware("auth"); 
Route::get("/edit_catagory/{id}",[Catagory::class,"edit_catagory"])->middleware("auth"); 
Route::post("/update_catagory",[Catagory::class,"update_catagory"]); 



//============================ Catagory Routes ========================

Route::get("/sub_catagory",[Sub_catagory::class,"sub_catagory"]); 
Route::post("/add_sub_catagory",[Sub_catagory::class,"add_sub_catagory"]); 
Route::get("/show_sub_catagory",[Sub_catagory::class,"show_sub_catagory"]); 
Route::get("/del_sub_catagory/{id}",[Sub_catagory::class,"del_sub_catagory"]); 
Route::get("/edit_sub_catagory/{id}",[Sub_catagory::class,"edit_sub_catagory"]); 
Route::post("/update_sub_catagory",[Sub_catagory::class,"update_sub_catagory"]); 



//============================ Game Routes ========================

Route::get("/add_game",[Game::class,"games"]); 
Route::post("/post_game",[Game::class,"get_game"]); 
Route::get("/show_game",[Game::class,"show_game"]); 
Route::get("/del_game/{id}",[Game::class,"del_game"]); 



//============================ Wallet Routes ========================

Route::get("/add_money",[Wallet::class,"add_money"]); 
Route::get("/get_balance/{id}",[Wallet::class,"get_balance"]); 
Route::post("/post_wallet",[Wallet::class,"post_wallet"]); 
Route::get("/show_wallet",[Wallet::class,"show_wallet"]); 


//============================ Result Routes ========================

Route::get("/add_result",[Result::class,"add_result"]); 
Route::get("/get_baji/{id}",[Result::class,"get_baji"]); 
Route::post("/post_result",[Result::class,"post_result"]); 
Route::get("/show_result",[Result::class,"show_result"]); 
Route::get("/del_result/{id}",[Result::class,"del_result"]); 


//============================ Requests Routes ========================

Route::get("/show_requests",[Requests::class,"show_requests"]);
Route::get("/clear_requests/{id}",[Requests::class,"clear_requests"]);


