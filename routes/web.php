<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Sliders;
use App\Http\Controllers\Catagory;
use App\Http\Controllers\Sub_catagory;
use App\Http\Controllers\Game;
use App\Http\Controllers\Result;
use App\Http\Controllers\Wallet;
use App\Http\Controllers\Customer_History;
use App\Http\Controllers\Game_Report;
use App\Http\Controllers\Notification;
use App\Http\Controllers\Requests;
use App\Http\Controllers\Rate_chart;
use App\Http\Controllers\How_to_play;


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
Route::get("/edit_game/{id}",[Game::class,"edit_game"]); 
Route::post("/update_game",[Game::class,"update_game"]); 
Route::get("/show_on_game",[Game::class,"show_on_game"]); 
Route::get("/del_playdetails/{id}",[Game::class,"del_playdetails"]); 
Route::get("/ischeck/{id}",[Game::class,"is_check"]); 



//============================ Wallet Routes ========================

Route::get("/add_money",[Wallet::class,"add_money"]); 
Route::get("/cut_money",[Wallet::class,"cut_money"]); 
Route::get("/get_balance/{id}",[Wallet::class,"get_balance"]); 
Route::post("/post_wallet",[Wallet::class,"post_wallet"]); 
Route::get("/show_wallet",[Wallet::class,"show_wallet"]); 


//============================ Result Routes ========================

Route::get("/add_result",[Result::class,"add_result"]); 
Route::get("/get_baji/{id}",[Result::class,"get_baji"]); 
Route::post("/post_result",[Result::class,"post_result"]); 
Route::get("/show_result",[Result::class,"show_result"]); 
Route::get("/del_result/{id}",[Result::class,"del_result"]); 
Route::post("/get_res",[Result::class,"get_res"]); 


//============================ Requests Routes ========================

Route::get("/show_requests",[Requests::class,"show_requests"]);
Route::get("/clear_requests/{id}",[Requests::class,"clear_requests"]);


//============================ Customer History ========================

Route::get("/customer_history",[Customer_History::class,"customer_history"]);
Route::post("/fromcus",[Customer_History::class,"fromcus"]);
Route::get("/direct_history/{id}",[Customer_History::class,"direct_history"]);
Route::get("/clear_history/{id}",[Customer_History::class,"clear_history"]);



Route::get("/kolkataff",[Game_Report::class,"kolkataff"]);
Route::get("/cmmmimbai",[Game_Report::class,"cmmmimbai"]);
Route::get("/del_kolkataff/{id}",[Game_Report::class,"del_kolkataff"]);


Route::get("/show_notification",[Notification::class,"show_notification"]);
Route::get("/approve_add_fund/{id}",[Notification::class,"approve_add_fund"]);
Route::get("/cancel_add_fund/{id}",[Notification::class,"cancel_add_fund"]);
Route::get("/withdraw_fund/{id}",[Notification::class,"withdraw_fund"]);
Route::get("/cancel_withdraw_fund/{id}",[Notification::class,"cancel_withdraw_fund"]);


//============================ Notification ========================

Route::get("/get_noti",[Admin::class,"get_notification"]);
Route::get("/get_req",[Admin::class,"get_request"]);
Route::get("/notifi",[Admin::class,"get_notifi"]);


//============================ Rate Chart ========================

Route::get("/add_chart",[Rate_chart::class,"add_chart"]);
Route::post("/post_chart",[Rate_chart::class,"post_chart"]);
Route::get("/charts",[Rate_chart::class,"charts"]);
Route::get("/del_chart/{id}",[Rate_chart::class,"del_chart"]);
Route::get("/edit_chart/{id}",[Rate_chart::class,"edit_chart"]);
Route::post("/update_chart",[Rate_chart::class,"update_chart"]);


//============================ How to Play ========================

Route::get("/how_to_play",[How_to_play::class,"content"]);
Route::get("/add_content",[How_to_play::class,"add_content"]);
Route::post("/submit_content",[How_to_play::class,"submit_content"]);
Route::get("/edit_content/{id}",[How_to_play::class,"edit_content"]);
Route::post("/update_content",[How_to_play::class,"update_content"]);
Route::get("/del_content/{id}",[How_to_play::class,"del_content"]);
