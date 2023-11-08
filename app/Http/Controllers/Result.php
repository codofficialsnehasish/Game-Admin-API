<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Games;
use App\Models\Times;

class Result extends Controller
{
    public function add_result(Request $r){
        $obj = Games::all();
        return view("result/add_result")->with(['game'=>$obj]);
    }

    public function get_baji(Request $r){
        $obj = Times::where("game_id","=",$r->id)->get();
        return response()->json($obj);
    }

    public function show_result(Request $r){
        
    }
}
