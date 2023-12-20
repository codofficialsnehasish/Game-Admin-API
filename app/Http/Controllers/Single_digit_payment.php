<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Games;
use App\Models\On_Game;
use App\Models\Times;
use App\Models\Single_catagory_money;

class Single_digit_payment extends Controller
{
    public function content(){
        $games = Games::all();
        return view("single_digit_payment/content")->with(['games'=>$games]);
    }
    public function single_cata(Request $r){
        $game_ids = Times::find($r->id)->game_id;
        $data = On_Game::where("catagory_id","=",1)->where("game_id","=",$game_ids)->where("time_id","=",$r->id)->where("is_calculated","=",0)->where("date","=",date("Y-m-d"))->get();
        if(Single_catagory_money::where("date","=",date("Y-m-d"))->where("game_id","=",$r->id)->count() > 0){
            $obj = Single_catagory_money::where("date","=",date("Y-m-d"))->where("game_id","=",$game_ids)->where("baji_id","=",$r->id)->get(["id"]);
            $obj = Single_catagory_money::find($obj[0]->id);
        }else{
            $obj = new Single_catagory_money();
            $obj->game_id = $game_ids;
            $obj->baji_id = $r->id;
        }
        // print($obj);
        foreach($data as $d){
            $digit = explode(",",$d->box_number);
            $money = explode(",",$d->amount);
            for($i=0;$i<count($digit);$i++){
                if($digit[$i] == 0){
                    $obj->s0 += $money[$i];
                }elseif($digit[$i] == 1){
                    $obj->s1 += $money[$i];
                }elseif($digit[$i] == 2){
                    $obj->s2 += $money[$i];
                }elseif($digit[$i] == 3){
                    $obj->s3 += $money[$i];
                }elseif($digit[$i] == 4){
                    $obj->s4 += $money[$i];
                }elseif($digit[$i] == 5){
                    $obj->s5 += $money[$i];
                }elseif($digit[$i] == 6){
                    $obj->s6 += $money[$i];
                }elseif($digit[$i] == 7){
                    $obj->s7 += $money[$i];
                }elseif($digit[$i] == 8){
                    $obj->s8 += $money[$i];
                }elseif($digit[$i] == 9){
                    $obj->s9 += $money[$i];
                }
                // else{
                //     echo "not well";
                // }
            }
            $cal = On_Game::find($d->id);
            $cal->is_calculated = 1;
            $cal->update();
        }
        $obj->save();



        $show_data = Single_catagory_money::leftJoin("games","single_catagory_money.game_id","games.id")
        ->leftJoin("timing","single_catagory_money.baji_id","timing.id")
        ->where("single_catagory_money.date","=",date("Y-m-d"))
        ->where("single_catagory_money.game_id","=",$game_ids)
        ->where("single_catagory_money.baji_id","=",$r->id)
        ->get(["games.game_name","single_catagory_money.*","timing.baji","timing.start_time","timing.end_time"]);
        // print_r($show_data[0]);
        if(count($show_data) > 0){

            $table = '<h4 class="card-title" style="text-align:center;color:green;">'.$show_data[0]->game_name.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$show_data[0]->baji.'&nbsp;&nbsp;'.$show_data[0]->start_time.'-'.$show_data[0]->end_time.'</h4>
                      <div class="table-responsive">
                      <table class="table table-striped mb-0">
                          <thead>
                            <tr>
                                <th>Box Number</th>
                                <th>Total Amount</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr><td>0</td><td>'.$show_data[0]->s0.'</td></tr>
                            <tr><td>1</td><td>'.$show_data[0]->s1.'</td></tr>
                            <tr><td>2</td><td>'.$show_data[0]->s2.'</td></tr>
                            <tr><td>3</td><td>'.$show_data[0]->s3.'</td></tr>
                            <tr><td>4</td><td>'.$show_data[0]->s4.'</td></tr>
                            <tr><td>5</td><td>'.$show_data[0]->s5.'</td></tr>
                            <tr><td>6</td><td>'.$show_data[0]->s6.'</td></tr>
                            <tr><td>7</td><td>'.$show_data[0]->s7.'</td></tr>
                            <tr><td>8</td><td>'.$show_data[0]->s8.'</td></tr>
                            <tr><td>9</td><td>'.$show_data[0]->s9.'</td></tr>
                          </tbody>
                      </table>
                      </div>';
        }
        if(!empty($table)){
            echo $table;
        }else{
            echo 'No Data avaliable';
        }
    }
}
