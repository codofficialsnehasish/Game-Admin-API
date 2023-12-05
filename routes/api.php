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



//============================ Customer API Routes ==============================

Route::post("/register",[Admin::class,"addcustomer"]);
// {
//     "date" : "2023-10-26",
//     "name" : "API testing",
//     "phone" : 7031182870,
//     "balance" : 0,
//     "gpay" : 7031182870,
//     "paytm" : 7031182870,
//     "email" : "snehasish363@gmail.com",
//     "mode" : "App"
// }
// {
//     "name" : "Snehasish",
//     "phone" : 7031182870,
//     "password" : 1234,
//     "confirm_password" : 1234,
//     "m_pin" : 1234
// }

Route::get("/showcustomer/{id?}",[Admin::class,"showcustomer"]);
Route::get("/customerdel/{id}",[Admin::class,"customerdel"]);
Route::post("/update_customer",[Admin::class,"update_customer"]);


Route::post("/login",[Admin::class,"app_login"]);
// {
//     "phone" : 703118280,
//     "password" : 123,
//     "m_pin" : ""
// }


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

Route::post("/add_fund",[Notification::class,"add_fund"]);

//==========XXXX============ End of Notification API Routes ============XXXX============


//============================ Today Result API Routes ==============================

Route::get("/today_result",[Result::class,"today_result"]);

//==========XXXX============ End of Today Result API Routes ============XXXX============
