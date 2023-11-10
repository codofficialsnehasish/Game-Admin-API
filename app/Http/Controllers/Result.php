<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Games;
use App\Models\Times;
use App\Models\Catagorys;
use App\Models\Results;
use App\Models\On_Game;
use App\Models\Customer;

class Result extends Controller
{
    public function add_result(Request $r){
        $obj = Games::all();
        $catagory = Catagorys::all();
        return view("result/add_result")->with(['game'=>$obj,'catagory'=>$catagory]);
    }

    public function get_baji(Request $r){
        $obj = Times::where("game_id","=",$r->id)->get();
        return response()->json($obj);
    }

    public function post_result(Request $r){
        $obj = new Results();
        $obj->date = date("d-m-Y");
        $obj->game_id = $r->game;
        $obj->time_id = $r->baji;
        $obj->catagory_id = $r->catagory;
        $obj->box_number = $r->boxnum;
        $obj->save();
        $res = On_Game::where("game_id","=",$r->game)
        ->where("time_id","=",$r->baji)
        ->where("catagory_id","=",$r->catagory)
        ->where("box_number","=",$r->boxnum)
        ->where("is_completed","=",0)
        ->get();
        // return $res;
        foreach($res as $result){
            $custo = Customer::find($result->customer_id);
            $custo->is_winner = 1;
            $custo->wallet_balance += $result->amount * 9;
            $custo->update();
            $ongame = On_Game::find($result->id);
            $ongame->is_completed = 1;
            $ongame->is_winner = 1;
            $ongame->update();
        }

        return redirect(url('/show_result'));
    }

    public function show_result(Request $r){
        $obj = Results::leftJoin("games","result.game_id","games.id")
        ->leftJoin("timing","result.time_id","timing.id")
        ->leftJoin("catagory","result.catagory_id","catagory.id")
        ->get(["result.*","games.game_name as gname","timing.baji","timing.start_time", "timing.end_time","catagory.name as cname"]);
        return view("result/show_result")->with(['data'=>$obj]);
    }

    public function del_result(Request $r){
        $obj = Results::find($r->id);
        $obj->delete();
        return redirect(url('/show_result'));
    }
}
