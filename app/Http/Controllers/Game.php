<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Games;
use App\Models\Times;
use App\Models\On_Game;
use App\Models\Catagorys;
use App\Models\Customer;

class Game extends Controller
{
    public function games(){
        return view("game/all_games/add_game");
    }

    public function get_game(Request $r){
        $game = new Games();
        $game->game_name = $r->outer_group[0]['name'];
        $game->min_entry_fee = $r->outer_group[0]['min_entry'];
        $game->max_entry_fee = $r->outer_group[0]['max_entry'];
        $game->save();
        for($i=0;$i<count($r->outer_group[0]['inner_group']); $i++){
            $time = new Times();
            $time->game_id = $game->id;
            $time->baji = "Baji ".$r->outer_group[0]['inner_group'][$i]['baji'];
            $time->start_time = self::convert12($r->outer_group[0]['inner_group'][$i]['st']);
            $time->end_time = self::convert12($r->outer_group[0]['inner_group'][$i]['et']);
            $time->save();
        }
        // print_r($r->outer_group[0]);
        return redirect(url('/show_game'));
    }

    public function convert12($str){
        $h1 = $str[0] - '0';
        $h2 = $str[1] - '0';
        $hh = $h1 * 10 + $h2;
        $Meridien;
        if ($hh < 12) {
            $Meridien = "AM";
        }
        else{ $Meridien = "PM"; }
        $hh %= 12;
        $data = '';
        if ($hh == 0) {
            $data = "12";
            for ($i = 2; $i < 5; ++$i){
                $data .= $str[$i];
            }
        }else{
            $data .= $hh;
            for ($i = 2; $i < 5; ++$i) {
                $data .= $str[$i];
            }
        }
        $data .= " " . $Meridien;
        return $data;
    }

    public function show_game(Request $r){
        $obj = Games::all();
        $time = Times::all();
        if( $r->is('api/*')){
            $games_time = Games::join("timing","games.id","timing.game_id")
            ->get(["games.game_name","timing.id as time_id","timing.game_id","timing.start_time","timing.end_time"]);
            // return ["status"=>"true",'games' => $obj, 'timings'=>$time];
            return ["status"=>"true",'games' => $games_time];
        }else{
            return view("game/all_games/show_game")->with(['game'=>$obj,'time'=>$time]);
        }
    }

    // public function show_timing(Request $r){
    //     $cs = CSession::find(1);
    //     $ongame = On_Game::where("customer_id","=",$cs->customer_id)
    //     ->where("date","=",date("Y-d-m"))  
    //     ->get();
    //     return $ongame;
    //     if($r->id != ""){
    //         if(Times::where("game_id","=",$r->id)->count() > 0){
    //             $ongame->game_id = $r->id;
    //             $ongame->update();
    //             $time = Times::where("game_id","=",$r->id)->get();
    //             return ["status"=>"true",'data' => $time];
    //         }else{
    //             return ["status"=>"false","error"=>"Not Avaliable"];
    //         }
    //     }else{
    //         return ["status"=>"false","error"=>"Please put game id in url"];
    //     }
    // }

    public function del_game(Request $r){
        $game = Games::find($r->id);
        $time = Times::where("game_id","=",$game->id);
        $time->delete();
        $game->delete();

        return redirect()->back();
    }

    public function show_catagory(){
        // $obj = Catagory::all();
        return ["status"=>"true",'data' => Catagorys::all()];
    }


    public function get_user_play_details(Request $r){
        $obj = new On_Game();
        $obj->customer_id = $r->customer_id;
        $obj->time_id = $r->time_id;
        $game_id = Times::find($r->time_id)->game_id;
        $obj->game_id = $game_id;
        $obj->catagory_id = $r->catagory_id;
        $obj->box_number = $r->box_number;
        $game = Games::find($game_id);
        $customer = Customer::find($r->customer_id);
        if($game->min_entry_fee != "" && $r->amount == "" || $game->min_entry_fee > $r->amount){
            return ["status"=>"False","error"=>"Mininum entry fee is $game->min_entry_fee"];
        }
        elseif($customer->wallet_balance == "" || $customer->wallet_balance < $r->amount){
            return ["status"=>"False","error"=>"Your Wallet balance is too low"];
        }else{
            $obj->amount = $r->amount;
            $customer->wallet_balance -= $r->amount;
            $customer->update();
        }
        $res = $obj->save();
        if($res){
            return ["status"=>"True","success"=>"Data inserted successfully"];
        }else{
            return ["status"=>"False","error"=>"Data can't inserted"];

        }
    }

    public function bid_history(Request $r){
        if($r->id == null){
            return ["status"=>"False","error"=>"Please provide the customer id"];
        }else{
            // $obj = On_Game::where("customer_id","=",$r->id)
            // ->where("date","=",date("Y-m-d"))
            // ->get();
            $obj = On_Game::leftJoin("games","on_game.game_id","games.id")
            ->leftJoin("timing","on_game.time_id","timing.id")
            ->leftJoin("catagory","on_game.catagory_id","catagory.id")
            ->where("on_game.date","=",date("Y-m-d"))
            ->get(["on_game.id","on_game.date","on_game.amount","on_game.customer_id","games.game_name as game_name","timing.baji as baji","timing.start_time", "timing.end_time","catagory.name as catagory_name"]);
            if(count($obj) > 0){
                return ["status"=>"True","data"=>$obj];
            }else{
                return ["status"=>"False","error"=>"data not found"];
            }
        }
    }

    public function win_history(Request $r){
        if($r->id == null){
            return ["status"=>"False","error"=>"Please provide the customer id"];
        }else{
            // $obj = On_Game::where("customer_id","=",$r->id)
            // ->where("date","=",date("Y-m-d"))
            // ->get();
            $obj = On_Game::leftJoin("games","on_game.game_id","games.id")
            ->leftJoin("timing","on_game.time_id","timing.id")
            ->leftJoin("catagory","on_game.catagory_id","catagory.id")
            ->where("on_game.date","=",date("Y-m-d"))
            ->where("is_winner","=",1)
            ->where("customer_id","=",$r->id)
            ->get(["on_game.id","on_game.date","on_game.amount","on_game.customer_id","on_game.is_winner","games.game_name as game_name","timing.baji as baji","timing.start_time", "timing.end_time","catagory.name as catagory_name"]);
            if(count($obj) > 0){
                return ["status"=>"True","data"=>$obj];
            }else{
                return ["status"=>"False","error"=>"data not found"];
            }
        }
    }
}
