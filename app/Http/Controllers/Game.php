<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Games;
use App\Models\Times;
use App\Models\On_Game;
use App\Models\Catagorys;
use App\Models\Customer;
use App\Models\History;

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

    public function edit_game(Request $r){
        $obj = Games::find($r->id);
        $time = Times::where("game_id","=",$obj->id)->get();
        return view("game/all_games/edit_game")->with(['game'=>$obj, 'time'=>$time]);
    }

    public function update_game(Request $r){
        $game = Games::find($r->game_id);
        $time = Times::where("game_id","=",$game->id)->get();
        foreach($time as $t){
            // print($t);
            $time = Times::find($t->id);
            $time->delete();
        }
        $game->game_name = $r->outer_group[0]['name'];
        $game->min_entry_fee = $r->outer_group[0]['min_entry'];
        $game->max_entry_fee = $r->outer_group[0]['max_entry'];
        for($i=0;$i<count($r->outer_group[0]['inner_group']); $i++){
            $time = new Times();
            $time->game_id = $game->id;
            $time->baji = "Baji ".$r->outer_group[0]['inner_group'][$i]['baji'];
            $time->start_time = self::convert12($r->outer_group[0]['inner_group'][$i]['st']);
            $time->end_time = self::convert12($r->outer_group[0]['inner_group'][$i]['et']);
            $time->save();
        }
        $game->update();
        // print_r($r->outer_group[0]);
        return redirect(url('/show_game'));
    }

    public function show_timing(Request $r){
        if($r->id != ""){
            if(Times::where("game_id","=",$r->id)->count() > 0){
                $time = Times::where("game_id","=",$r->id)->get();
                return ["status"=>"true",'data' => $time];
            }else{
                return ["status"=>"false","error"=>"Not Avaliable"];
            }
        }else{
            return ["status"=>"false","error"=>"Please put game id in url"];
        }
    }

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

    public function show_on_game(){
        $obj = On_Game::leftJoin("customer","on_game.customer_id","customer.id")
        ->leftJoin("games","on_game.game_id","games.id")
        ->leftJoin("timing","on_game.time_id","timing.id")
        ->leftJoin("catagory","on_game.catagory_id","catagory.id")
        ->orderBy('on_game.date', 'desc')
        ->get(["on_game.*","customer.beneficiary_name as cname","games.game_name as gname","timing.baji","timing.start_time","timing.end_time","catagory.name as cata_name"]);
        return view("play_details/show_play_details")->with(['data' => $obj]);
    }

    public function del_playdetails(Request $r){
        $obj = On_Game::find($r->id);
        $obj->delete();
        return redirect(url('/show_on_game'));
    }


    public function check_have_balance($amount, $customer){
        $flag = false;
        $amo = explode(",",$amount);
        foreach($amo as $a){
            if($customer->wallet_balance < $a){
                $flag = true;
            }
        }
        return $flag;
    }
    public function check_min_balance($amount, $game){
        $flag = false;
        $amo = explode(",",$amount);
        foreach($amo as $a){
            if($game->min_entry_fee > $a){
                $flag = true;
            }
        }
        return $flag;
    }
    public function isAscending($digits) {
        $num = explode(",",$digits);
        $flag = true;
        foreach($num as $number){
            $numberStr = (string)$number;
            $length = strlen($numberStr);
            for ($i = 0; $i < $length - 1; $i++) {
                //echo "numberStr[$i] = ".$numberStr[$i]."< numberStr[$i + 1] = ".$numberStr[$i + 1]." <br>";
                if ($numberStr[$i] < $numberStr[$i + 1] || ($i == $length - 2 && $numberStr[$length - 1] == 0)){
                    $flag = true;
                }else{ $flag = false;break;}
            }
            if($flag == false) break;
        }
        return $flag;
    }
    // $exampleNumber = 12445;
    // if (isAscending($exampleNumber)) {
    //     echo "$exampleNumber is ascending.";
    // } else {
    //     echo "$exampleNumber is not ascending.";
    // }

    public function generateCombinations($arr, $data, $start, $end, $index, &$result) {
        if ($index == count($data)) {
            $str = "";
            foreach($data as $d){
                $str .= (string)$d;
            }
            $result[] = $str;
            return;
        }
        for ($i = $start; $i <= $end && $end - $i + 1 >= count($data) - $index; $i++) {
            $data[$index] = $arr[$i];
            $this->generateCombinations($arr, $data, $i + 1, $end, $index + 1, $result);
        }
    }
    public function combinations($arr, $r) {
        $result = [];
        $n = count($arr);
        $data = array_fill(0, $r, 0);
        $this->generateCombinations($arr, $data, 0, $n - 1, 0, $result);
        return $result;
    }

    public function get_user_play_details(Request $r){
        $res = 0;
        if($r->catagory_id == 1){ //for single catagory
            $obj = new On_Game();
            $game_id = Times::find($r->time_id)->game_id;
            $game = Games::find($game_id);
            $customer = Customer::find($r->customer_id);
            if($game->min_entry_fee != "" && $r->amount == "" || $this->check_min_balance($r->amount, $game)){
                return ["status"=>"False","error"=>"Mininum entry fee is $game->min_entry_fee"];
            }
            elseif($customer->wallet_balance == "" || $this->check_have_balance($r->amount,$customer)){
                return ["status"=>"False","error"=>"Your Wallet balance is too low"];
            }
            else{ 
                $obj->customer_id = $r->customer_id;
                $obj->time_id = $r->time_id;
                $obj->game_id = $game_id;
                $obj->catagory_id = $r->catagory_id;
                // $c = count(explode(",",$r->digits));
                $obj->box_number = $r->digits;
                $sum_amount = abs(array_sum(explode(",",$r->amount)));
                $obj->amount = $r->amount;
                // $customer->wallet_balance -= $c * $r->amount;
                $customer->wallet_balance -= $sum_amount;
                $obj->cutting_amount = $sum_amount;
                $customer->update();
                $res = $obj->save();
                $history = History::where("customer_id","=",$r->customer_id)
                ->where("date","=",date("Y-m-d"))
                ->where("game_id","=",Times::find($r->time_id)->game_id)
                ->count();
                if($history > 0){
                    $data = History::where("customer_id","=",$r->customer_id)
                    ->where("date","=",date("Y-m-d"))
                    ->where("game_id","=",Times::find($r->time_id)->game_id)
                    ->get("id");
                    $objs = History::find($data[0]->id);
                    $objs->payon += $sum_amount;
                    $objs->update();
                }else{
                    $objs = new History();
                    $objs->customer_id = $r->customer_id;
                    $objs->game_id = $game_id;
                    $objs->payon += $sum_amount;
                    $objs->save();
                }
            }
        }elseif($r->catagory_id == 2){ //for jodi catagory
            $obj = new On_Game();
            $game_id = Times::find($r->time_id)->game_id;
            $game = Games::find($game_id);
            $customer = Customer::find($r->customer_id);
            if($game->min_entry_fee != "" && $r->amount == "" || $this->check_min_balance($r->amount, $game)){
                return ["status"=>"False","error"=>"Mininum entry fee is $game->min_entry_fee"];
            }
            elseif($customer->wallet_balance == "" || $this->check_have_balance($r->amount,$customer)){
                return ["status"=>"False","error"=>"Your Wallet balance is too low"];
            }
            else{
                $obj->customer_id = $r->customer_id;
                $obj->time_id = $r->time_id;
                $obj->game_id = $game_id;
                $obj->catagory_id = $r->catagory_id;
                $c = count(explode(",",$r->digits));
                $obj->box_number = $r->digits;
                // $sum_amount = abs(array_sum(explode(",",$r->amount)));
                $obj->amount = $r->amount;
                $customer->wallet_balance -= $c * $r->amount;
                $obj->cutting_amount = $c * $r->amount;
                // $customer->wallet_balance -= $sum_amount;
                $customer->update();
                $res = $obj->save();
                $history = History::where("customer_id","=",$r->customer_id)
                ->where("date","=",date("Y-m-d"))
                ->where("game_id","=",Times::find($r->time_id)->game_id)
                ->count();
                if($history > 0){
                    $data = History::where("customer_id","=",$r->customer_id)
                    ->where("date","=",date("Y-m-d"))
                    ->where("game_id","=",Times::find($r->time_id)->game_id)
                    ->get("id");
                    $objs = History::find($data[0]->id);
                    $objs->payon += $c * $r->amount;
                    $objs->update();
                }else{
                    $objs = new History();
                    $objs->customer_id = $r->customer_id;
                    $objs->game_id = $game_id;
                    $objs->payon += $c * $r->amount;
                    $objs->save();
                }
            }
        }elseif($r->catagory_id == 3){ //for patti catagory
            $obj = new On_Game();
            $game_id = Times::find($r->time_id)->game_id;
            $game = Games::find($game_id);
            $customer = Customer::find($r->customer_id);
            if($game->min_entry_fee != "" && $r->amount == "" || $this->check_min_balance($r->amount, $game)){
                return ["status"=>"False","error"=>"Mininum entry fee is $game->min_entry_fee"];
            }
            elseif(!$this->isAscending($r->digits))    {
                return ["status"=>"False","error"=>"Digit not accepted"];
            }
            elseif($customer->wallet_balance == "" || $this->check_have_balance($r->amount,$customer)){
                return ["status"=>"False","error"=>"Your Wallet balance is too low"];
            }
            else{
                $obj->customer_id = $r->customer_id;
                $obj->time_id = $r->time_id;
                $obj->game_id = $game_id;
                $obj->catagory_id = $r->catagory_id;
                $c = count(explode(",",$r->digits));
                $obj->box_number = $r->digits;
                // $sum_amount = abs(array_sum(explode(",",$r->amount)));
                $obj->amount = $r->amount;
                $customer->wallet_balance -= $c * $r->amount;
                $obj->cutting_amount = $c * $r->amount;
                // $customer->wallet_balance -= $sum_amount;
                $customer->update();
                $res = $obj->save();
                $history = History::where("customer_id","=",$r->customer_id)
                ->where("date","=",date("Y-m-d"))
                ->where("game_id","=",Times::find($r->time_id)->game_id)
                ->count();
                if($history > 0){
                    $data = History::where("customer_id","=",$r->customer_id)
                    ->where("date","=",date("Y-m-d"))
                    ->where("game_id","=",Times::find($r->time_id)->game_id)
                    ->get("id");
                    $objs = History::find($data[0]->id);
                    $objs->payon += $c * $r->amount;
                    $objs->update();
                }else{
                    $objs = new History();
                    $objs->customer_id = $r->customer_id;
                    $objs->game_id = $game_id;
                    $objs->payon += $c * $r->amount;
                    $objs->save();
                }
            }
        }elseif($r->catagory_id == 4){ //for 4 digit cp catagory
            $obj = new On_Game();
            $game_id = Times::find($r->time_id)->game_id;
            $game = Games::find($game_id);
            $customer = Customer::find($r->customer_id);
            if($game->min_entry_fee != "" && $r->amount == "" || $this->check_min_balance($r->amount, $game)){
                return ["status"=>"False","error"=>"Mininum entry fee is $game->min_entry_fee"];
            }
            elseif(!$this->isAscending($r->digits))    {
                return ["status"=>"False","error"=>"Digit not accepted"];
            }
            elseif($customer->wallet_balance == "" || $this->check_have_balance($r->amount,$customer)){
                return ["status"=>"False","error"=>"Your Wallet balance is too low"];
            }
            else{
                $num = str_split($r->digits);
                if(count($num) == 4){
                    $obj->customer_id = $r->customer_id;
                    $obj->time_id = $r->time_id;
                    $obj->game_id = $game_id;
                    $obj->catagory_id = $r->catagory_id;
                    // $c = count($this->combinations($num, 3));
                    $obj->box_number = $r->digits;
                    // $sum_amount = abs(array_sum(explode(",",$r->amount)));
                    $obj->amount = $r->amount;
                    $customer->wallet_balance -= 4 * $r->amount;
                    $obj->cutting_amount = 4 * $r->amount;
                    $customer->update();
                    $res = $obj->save();
                    $history = History::where("customer_id","=",$r->customer_id)
                ->where("date","=",date("Y-m-d"))
                ->where("game_id","=",Times::find($r->time_id)->game_id)
                ->count();
                if($history > 0){
                    $data = History::where("customer_id","=",$r->customer_id)
                    ->where("date","=",date("Y-m-d"))
                    ->where("game_id","=",Times::find($r->time_id)->game_id)
                    ->get("id");
                    $objs = History::find($data[0]->id);
                    $objs->payon += 4 * $r->amount;
                    $objs->update();
                }else{
                    $objs = new History();
                    $objs->customer_id = $r->customer_id;
                    $objs->game_id = $game_id;
                    $objs->payon += 4 * $r->amount;
                    $objs->save();
                }
                }else{
                    return ["error"=>"Wrong Entry, Check digit length"];
                }
            }
        }elseif($r->catagory_id == 5){ //for 5 digit cp catagory
            $obj = new On_Game();
            $game_id = Times::find($r->time_id)->game_id;
            $game = Games::find($game_id);
            $customer = Customer::find($r->customer_id);
            if($game->min_entry_fee != "" && $r->amount == "" || $this->check_min_balance($r->amount, $game)){
                return ["status"=>"False","error"=>"Mininum entry fee is $game->min_entry_fee"];
            }
            elseif(!$this->isAscending($r->digits))    {
                return ["status"=>"False","error"=>"Digit not accepted"];
            }
            elseif($customer->wallet_balance == "" || $this->check_have_balance($r->amount,$customer)){
                return ["status"=>"False","error"=>"Your Wallet balance is too low"];
            }
            else{
                $num = str_split($r->digits);
                if(count($num) == 5){
                    $obj->customer_id = $r->customer_id;
                    $obj->time_id = $r->time_id;
                    $obj->game_id = $game_id;
                    $obj->catagory_id = $r->catagory_id;
                    $obj->box_number = $r->digits;
                    // $sum_amount = abs(array_sum(explode(",",$r->amount)));
                    $obj->amount = $r->amount;
                    $customer->wallet_balance -= 10 * $r->amount;
                    $obj->cutting_amount = 10 * $r->amount;
                    // $customer->wallet_balance -= $sum_amount;
                    $customer->update();
                    $res = $obj->save();
                    $history = History::where("customer_id","=",$r->customer_id)
                ->where("date","=",date("Y-m-d"))
                ->where("game_id","=",Times::find($r->time_id)->game_id)
                ->count();
                if($history > 0){
                    $data = History::where("customer_id","=",$r->customer_id)
                    ->where("date","=",date("Y-m-d"))
                    ->where("game_id","=",Times::find($r->time_id)->game_id)
                    ->get("id");
                    $objs = History::find($data[0]->id);
                    $objs->payon += 10 * $r->amount;
                    $objs->update();
                }else{
                    $objs = new History();
                    $objs->customer_id = $r->customer_id;
                    $objs->game_id = $game_id;
                    $objs->payon += 10 * $r->amount;
                    $objs->save();
                }
                }else{
                    return ["error"=>"Wrong Entry, Check digit length"];
                }
            }
        }
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
            ->get(["on_game.id","on_game.date","on_game.amount","on_game.customer_id","on_game.created_at as bid_time","games.game_name as game_name","timing.baji as baji","timing.start_time", "timing.end_time","catagory.name as catagory_name"]);
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
            ->where("is_completed","=",1)
            ->where("customer_id","=",$r->id)
            ->get(["on_game.id","on_game.date","on_game.amount","on_game.customer_id","on_game.is_winner","games.game_name as game_name","timing.baji as baji","timing.start_time", "timing.end_time","catagory.name as catagory_name"]);
            // return $obj;
            if(count($obj) > 0){
                return ["status"=>"True","data"=>$obj];
            }else{
                return ["status"=>"False","error"=>"data not found"];
            }
        }
    }

    public function show_game_name(){
        $obj = Games::all();
        if(count($obj) > 0){
            return ["status"=>"True","game"=>$obj];
        }else{
            return ["status"=>"False","error"=>"data not found"];
        }
    }
}
