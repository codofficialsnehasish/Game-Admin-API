<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Games;
use App\Models\Times;
use App\Models\Catagorys;
use App\Models\Results;
use App\Models\On_Game;
use App\Models\Customer;
use App\Models\History;
use App\Models\Todays_result;

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
    function hasNoRepeatedCharacters($str) {
        $chars = str_split($str);
        $charCount = array_count_values($chars);
        foreach ($charCount as $count) {
            if ($count > 1) { return false; }
        }
        return true;
    }

    function sumOfDigits($number) {
        $sum = 0;
    
        while ($number > 0) {
            $digit = $number % 10; // Get the last digit
            $sum += $digit;        // Add the digit to the sum
            $number = (int)($number / 10); // Remove the last digit
        }
    
        return $sum;
    }

    public function post_result(Request $r){
        $obj = new Results();
        $obj->date = date("d-m-Y");
        $obj->game_id = $r->game;
        $obj->time_id = $r->baji;
        // $obj->catagory_id = $r->catagory;
        // $obj->box_number = $r->boxnum;
        $obj->patti_number = $r->pattinum;
        $obj->single = abs($this->sum($r->pattinum) % 10);
        
        $res = On_Game::where("game_id","=",$r->game)
        ->where("time_id","=",$r->baji)
        // ->where("catagory_id","=",$r->catagory)
        // ->where("box_number","=",$r->boxnum)
        ->where("is_completed","=",0)
        ->where("date","=",date("Y-m-d"))
        ->get();
        // print_r($res);

        //================== for jodi ==================

        $cata = Catagorys::find(2);
        // $ongame = On_Game::find($result->id);
        $jodi = On_Game::where("game_id","=",$r->game)
            ->where("catagory_id","=",2)
            ->where("is_completed","=",0)
            ->where("date","=",date("Y-m-d"))
            ->where("previous_win","=",1)
            ->get();
            // print_r($jodi);
            if(count($jodi) > 0){
                foreach($jodi as $j){
                    $custo = Customer::find($j->customer_id);
                    $digit = explode(",",$j->box_number);
                    $jodi = On_Game::find($j->id);
                    $box = explode(",",$j->box_number);
                    $is_winn = false;
                    foreach($box as $b){
                        // print($b);

                        $sp_data = str_split($b);
                        if($sp_data[1] == abs($this->sum($r->pattinum) % 10)){
                            $custo->wallet_balance += $jodi->amount * $cata->payment;
                            $custo->update();
                            $jodi->winn_amount = $jodi->amount * $cata->payment;
                            $jodi->is_completed = 1;
                            $jodi->is_winner = 1;
                            $is_winn = true;
                            $jodi->update();
                            
                            $data = History::where("customer_id","=",$j->customer_id)
                            ->where("date","=",date("Y-m-d"))
                            ->where("game_id","=",$r->game)
                            ->get("id");
                            $objs = History::find($data[0]->id);
                            $objs->winamount += $jodi->amount * $cata->payment;
                            $objs->update();
                        }else{
                            $jodi->is_completed = 1;
                            $jodi->is_winner = 0;
                            $jodi->previous_win = 0;
                            $jodi->update();
                        }
                    }
                    if($is_winn){
                        $jodi->is_completed = 1;
                        $jodi->is_winner = 1;
                        $jodi->update();
                    }
                }
            }

        //================== for jodi ==================

        foreach($res as $result){
            $custo = Customer::find($result->customer_id);
            $digit = explode(",",$result->box_number);
            // print_r($digit);
            

            
            
            if($result->catagory_id == 1){
                $cata = Catagorys::find($result->catagory_id);
                $ongame = On_Game::find($result->id);
                $single_res = abs($this->sum($r->pattinum) % 10);
                $pay = explode(",",$ongame->amount);
                for($i=0;$i<count($digit);$i++){
                    if($digit[$i] == $single_res){
                        $custo->wallet_balance += $pay[$i] * $cata->payment;
                        $custo->update();
                        $ongame->winn_amount = $pay[$i] * $cata->payment;
                        $ongame->is_completed = 1;
                        $ongame->is_winner = 1;
                        $ongame->update();

                        $data = History::where("customer_id","=",$result->customer_id)
                        ->where("date","=",date("Y-m-d"))
                        ->where("game_id","=",$r->game)
                        ->get("id");
                        $objs = History::find($data[0]->id);
                        $objs->winamount += $pay[$i] * $cata->payment;
                        $objs->update();
                    }
                }
            }elseif($result->catagory_id == 2){
                
                $jodi2 = On_Game::where("game_id","=",$r->game)
                    ->where("time_id","=",$r->baji)
                    ->where("catagory_id","=",2)
                    // ->where("box_number","=",$r->boxnum)
                    // ->where("catagory_id","=",2)
                    ->where("is_completed","=",0)
                    ->where("date","=",date("Y-m-d"))
                    // ->where("previous_win","=",0)
                    ->get();
                    // print_r($jodi2);
                if(count($jodi2) > 0){
                    foreach($jodi2 as $j){
                        $jodi2 = On_Game::find($j->id);
                        $box = explode(",",$j->box_number);
                        $is_winn = false;
                        foreach($box as $b){
                            $sp_data = str_split($b);
                            $n = $this->sum($r->pattinum);
                            
                            if($sp_data[0] == abs($this->sum($r->pattinum) % 10)){
                                // echo abs($this->sum($r->pattinum) % 10);
                                // echo "<br>";
                                $jodi2->previous_win = 1;
                                $is_winn = true;
                                $jodi2->update();
                            }else{
                                $jodi2->is_completed = 1;
                                $jodi2->is_winner = 0;
                                $jodi2->previous_win = 0;
                                $jodi2->update();
                            }
                        }
                        if($is_winn){
                            $jodi2->previous_win = 1;
                            $jodi2->is_completed = 0;
                            $jodi2->update();
                        }
                    }
                }

            }elseif($result->catagory_id == 3){
                $cata = Catagorys::find($result->catagory_id);
                $ongame = On_Game::find($result->id);
                // $patti_num = abs($this->sum($r->pattinum) % 10);
                // $pay = explode(",",$ongame->amount);
                $flag = false;
                for($i=0;$i<count($digit);$i++){
                    if($digit[$i] == $r->pattinum){
                        $custo->wallet_balance += $ongame->amount * $cata->payment;
                        $custo->update();
                        $ongame->winn_amount = $ongame->amount * $cata->payment;
                        $ongame->is_completed = 1;
                        $ongame->is_winner = 1;
                        $flag = true;
                        $ongame->update();
                        
                        $data = History::where("customer_id","=",$result->customer_id)
                        ->where("date","=",date("Y-m-d"))
                        ->where("game_id","=",$r->game)
                        ->get("id");
                        $objs = History::find($data[0]->id);
                        $objs->winamount += $ongame->amount * $cata->payment;
                        $objs->update();
                    }
                }
                if(!$flag){
                    $ongame->is_completed = 1;
                    $ongame->update();
                }
            }
            elseif($result->catagory_id == 4){
                $cata = Catagorys::find($result->catagory_id);
                $ongame = On_Game::find($result->id);
                $p = (string)$r->pattinum;
                if ($this->hasNoRepeatedCharacters($p)) {
                    // $patti_num = abs($this->sum($r->pattinum) % 10);
                    // $pay = explode(",",$ongame->amount);
                    $num = str_split($digit[0]);
                    $result = $this->combinations($num, 3);
                    $c = 0;
                    foreach($result as $res){
                        if($res == $r->pattinum){
                            $c++;
                        }
                    }
                    if($c>0){
                        $custo->wallet_balance += (($ongame->amount * $c) * $cata->payment);
                        $custo->update();
                        $ongame->winn_amount = (($ongame->amount * $c) * $cata->payment);
                        $ongame->is_completed = 1;
                        $ongame->is_winner = 1;
                        $ongame->update();
                        $data = History::where("customer_id","=",$result->customer_id)
                            ->where("date","=",date("Y-m-d"))
                            ->where("game_id","=",$r->game)
                            ->get("id");
                        $objs = History::find($data[0]->id);
                        $objs->winamount += (($ongame->amount * $c) * $cata->payment);
                        $objs->update();
                    }else{
                        $ongame->is_completed = 1;
                        $ongame->update();
                    }
                } else {
                    $ongame->is_completed = 1;
                    $ongame->update();
                }
                
            }
            elseif($result->catagory_id == 5){
                $cata = Catagorys::find($result->catagory_id);
                $ongame = On_Game::find($result->id);
                $p = (string)$r->pattinum;
                if ($this->hasNoRepeatedCharacters($p)) {
                    $num = str_split($digit[0]);
                    $result = $this->combinations($num, 3);
                    $c = 0;
                    foreach($result as $res){
                        if($res == $r->pattinum){
                            $c++;
                        }
                    }
                    if($c>0){
                        $custo->wallet_balance += (($ongame->amount * $c) * $cata->payment);
                        $custo->update();
                        $ongame->winn_amount = (($ongame->amount * $c) * $cata->payment);
                        $ongame->is_completed = 1;
                        $ongame->is_winner = 1;
                        $ongame->update();

                        $data = History::where("customer_id","=",$result->customer_id)
                            ->where("date","=",date("Y-m-d"))
                            ->where("game_id","=",$r->game)
                            ->get("id");
                        $objs = History::find($data[0]->id);
                        $objs->winamount += (($ongame->amount * $c) * $cata->payment);
                        $objs->update();
                    }else{
                        $ongame->is_completed = 1;
                        $ongame->update();
                    }
                }else{
                    $ongame->is_completed = 1;
                    $ongame->update();
                }
            }
        }
        $res = $obj->save();
        if($res){
            return redirect()->back()->with(['msg'=>'Result make successfully']);
        }else{
            return redirect()->back()->with(['msgg'=>'Some Error are occurred! Try Again!']);
        }
    }
    public function sum($num) { 
        $sum = 0; 
        for ($i = 0; $i < strlen($num); $i++){ 
            $sum += $num[$i]; 
        } 
        return $sum; 
    }
    
    // ->orderBy('cname', 'asc')
    public function show_result(Request $r){
        $games = Games::all();
        return view("result/show_result")->with(['games'=>$games]);
    }

    public function del_result(Request $r){
        $obj = Results::find($r->id);
        $obj->delete();
        return redirect(url('/show_result'));
    }
    public function get_res(Request $r){
        // echo $r->gameid;
        $obj = Results::leftJoin("games","result.game_id","games.id")
        ->leftJoin("timing","result.time_id","timing.id")
        ->where("games.id","=",$r->gameid)
        ->orderBy('result.date', 'desc')
        ->get(["result.*","games.game_name as gname","timing.baji","timing.start_time", "timing.end_time"]);
        $games = Games::all();
        return view("result/fromto_result")->with(['data'=>$obj,'games'=>$games]);
    }

    // public function today_result(){
    //     $obj = Results::leftJoin("games","result.game_id","games.id")
    //     ->leftJoin("timing","result.time_id","timing.id")
    //     ->where("result.date","=",date("d-m-Y"))
    //     ->orderBy('result.date', 'desc')
    //     ->get(["result.*","games.game_name as gname","timing.baji","timing.start_time", "timing.end_time"]);

    //     if(count($obj) > 0){
    //         return ["status"=>"True","result"=>$obj];
    //     }else{
    //         return ["status"=>"False","error"=>"data not found"];
    //     }
    // }




    // Todays Result
    public function todays_result(Request $r){
        $obj = Todays_result::all();
        if($r->is('api/*')){ 
            return ["status"=>"true",'data' => $obj];
        }else{
            return view("result/todays_result_content")->with(['data'=>$obj]);
        }
    }
    public function add_todays_result(){
        return view("result/add_today_result");
    }
    public function post_todays_result(Request $r){
        $images = new Todays_result();
        $img = $r->file("file");
        if(isset($img)){
            $img_name = time().$img->getClientOriginalName();
            $img->move(public_path("files/todays_result"),$img_name);
        }else{
            $img_name = "Not provided";
        }
        $images->image = $img_name;
        // $images->is_visible = $r->is_visible;
        $images->file_path = env('APP_URL')."files/todays_result/".$img_name;
        $images->save();
        $res = redirect()->back();
        if($res){
            return redirect()->back()->with(['msg'=>'Image Insert successfully']);
        }else{
            return redirect()->back()->with(['msgg'=>'Some Error are occurred! Try Again!']);
        }
    }

    public function del_res_today(Request $r){
        $obj = Todays_result::find($r->id);
        if($obj->image != "Not provided"){
            unlink("files/todays_result/".$obj->image);
        }
        $obj->delete();
        return redirect()->back();
    }

    public function edit_res_today(Request $r){
        $obj = Todays_result::find($r->id);
        return view("result/edit_today_result")->with(['data'=>$obj]);
    }

    public function update_res_today(Request $r){
        $slider = Todays_result::find($r->id);
        $img = $r->file("file");
        if(isset($img)){
            if($slider->image != "Not provided"){
                unlink("files/todays_result/".$slider->image);
            }
            $img_name = time().$img->getClientOriginalName();
            $img->move("files/todays_result",$img_name);
        }else{
            $img_name = $slider->image;
        }
        $slider->image = $img_name;
        // $slider->is_visible = $r->is_visible;
        $slider->file_path = env('APP_URL')."files/todays_result/".$img_name;
        $slider->update();
        return redirect(url('/todays-result'));
    }
}
