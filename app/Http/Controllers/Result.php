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
        // $obj->catagory_id = $r->catagory;
        // $obj->box_number = $r->boxnum;
        $obj->patti_number = $r->pattinum;
        $obj->save();
        $res = On_Game::where("game_id","=",$r->game)
        ->where("time_id","=",$r->baji)
        // ->where("catagory_id","=",$r->catagory)
        // ->where("box_number","=",$r->boxnum)
        ->where("is_completed","=",0)
        ->where("date","=",date("Y-m-d"))
        ->get();
        // echo $res;
        foreach($res as $result){
            $custo = Customer::find($result->customer_id);
            $digit = explode(",",$result->box_number);
            if($result->catagory_id == 1){
                $cata = Catagorys::find($result->catagory_id);
                $ongame = On_Game::find($result->id);
                $single_res = abs($this->sum($r->pattinum) % 10);
                foreach($digit as $d){
                    if($d == $single_res){
                        $custo->is_winner = 1;
                        $custo->wallet_balance += $result->amount * $cata->payment;
                        $custo->update();
                        $ongame->is_completed = 1;
                        $ongame->is_winner = 1;
                        $ongame->update();
                    }
                }
            }elseif($result->catagory_id == 3){
                
            }
            // if(strlen($digit[0]) >3)
            // $str = "2345";
            // $arr = str_split($str);
            // $n = sizeof($arr);
            // printCombination($arr, $n, 3);
            
            // $custo->is_winner = 1;
            // $custo->wallet_balance += $result->amount * 9;
            // $custo->update();
            // $ongame = On_Game::find($result->id);
            // $ongame->is_completed = 1;
            // $ongame->is_winner = 1;
            // $ongame->update();
        }

        return redirect(url('/show_result'));
    }
    public function sum($num) { 
        $sum = 0; 
        for ($i = 0; $i < strlen($num); $i++){ 
            $sum += $num[$i]; 
        } 
        return $sum; 
    }
    public function printCombination($arr, $n, $r){
        $data = Array();
        combinationUtil($arr, $n, $r, 0, $data, 0);
    }
    public function combinationUtil($arr, $n, $r, $index, $data, $i){
        if ($index == $r){
            for ($j = 0; $j < $r; $j++){
                echo $data[$j], " ";
            }
            echo "<br>";
            return;
        }
        if ($i >= $n) return;
        $data[$index] = $arr[$i];
        combinationUtil($arr, $n, $r, $index + 1, $data, $i + 1);
        combinationUtil($arr, $n, $r, $index, $data, $i + 1);
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
