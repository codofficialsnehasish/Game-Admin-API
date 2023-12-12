<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Admin;
use App\Http\Controllers\Sliders;
use App\Http\Controllers\Catagory;
use App\Http\Controllers\Sub_catagory;
use App\Http\Controllers\Game;
use App\Http\Controllers\Result;
use App\Http\Controllers\Requests;
use App\Http\Controllers\Notification;
use App\Http\Controllers\Rate_chart;
use App\Http\Controllers\How_to_play;
use App\Http\Controllers\Settings;



//============================ Customer API Routes ==============================

Route::post("/register",[Admin::class,"addcustomer"]);
Route::get("/showcustomer/{id?}",[Admin::class,"showcustomer"]);
Route::get("/customerdel/{id}",[Admin::class,"customerdel"]);
Route::post("/update_customer",[Admin::class,"update_customer"]);
Route::post("/referral",[Admin::class,"referral_code"]);


Route::post("/login",[Admin::class,"app_login"]);


//==========XXXX============ End of Customer API Routes ============XXXX============


//============================ Slider API Routes ==============================

Route::get("/slider",[Sliders::class,"slider"]); 

//==========XXXX============ End of Slider API Routes ============XXXX============


//============================ Catagory API Routes ==============================

Route::get("/catagory",[Catagory::class,"show_catagory"]);

//==========XXXX============ End of Catagory API Routes ============XXXX============



//============================ Sub Catagory API Routes ==============================

Route::get("/subcatagory",[Sub_catagory::class,"show_sub_catagory"]); 

//==========XXXX============ End of Sub Catagory API Routes ============XXXX============


//============================ Games API Routes ==============================

Route::get("/all_games",[Game::class,"show_game_name"]);
Route::get("/games",[Game::class,"show_game"]);
Route::get("/baji/{id?}",[Game::class,"show_timing"]);
Route::get("/catagory",[Game::class,"show_catagory"]);
Route::post("/play_details",[Game::class,"get_user_play_details"]);
Route::get("/bid_history/{id?}",[Game::class,"bid_history"]);
Route::get("/win_history/{id?}",[Game::class,"win_history"]);

//==========XXXX============ End of Games API Routes ============XXXX============


//============================ Request API Routes ==============================

Route::post("/get_request",[Requests::class,"get_request"]);

//==========XXXX============ End of Request API Routes ============XXXX============


//============================ Notification API Routes ==============================

Route::post("/fund",[Notification::class,"fund"]);

//==========XXXX============ End of Notification API Routes ============XXXX============


//============================ Today Result API Routes ==============================

Route::get("/today_result",[Result::class,"today_result"]);

//==========XXXX============ End of Today Result API Routes ============XXXX============

Route::get("/chart",[Rate_chart::class,"charts"]);


Route::get("/how_to_play",[How_to_play::class,"content"]);
Route::get("/click_add_wallet",[Settings::class,"on_click_add_wallet"]);
Route::get("/on_click_withdraw_wallet",[Settings::class,"on_click_withdraw_wallet"]);


