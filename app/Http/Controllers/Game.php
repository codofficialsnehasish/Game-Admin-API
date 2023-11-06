<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Games;
use App\Models\Times;
use App\Models\On_Game;
use App\Models\Catagory;

class Game extends Controller
{
    public function games(){
        return view("game/all_games/add_game");
    }

    public function get_game(Request $r){
        $game = new Games();
        $game->game_name = $r->outer_group[0]['name'];
        $game->save();
        // echo $game->id;
        for($i=0;$i<count($r->outer_group[0]['inner_group']); $i++){
            $time = new Times();
            $time->game_id = $game->id;
            $time->start_time = self::convert12($r->outer_group[0]['inner_group'][$i]['st']);
            $time->end_time = self::convert12($r->outer_group[0]['inner_group'][$i]['et']);
            $time->save();
        }
        // print_r($r->outer_group[0]['inner_group'][0]);
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
            // return $obj;
            return ["status"=>"true",'games' => $obj, 'timings'=>$time];
        }else{
            return view("game/all_games/show_game")->with(['game'=>$obj,'time'=>$time]);
        }
    }
    public function show_timing(Request $r){
        $ongame = On_Game::find();
        if($r->id != ""){
            if(Times::where("game_id","=",$r->id)->count() > 0){
                $ongame->game_id = $r->id;
                $ongame->update();
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

    public function show_catagory($id=null){
        $obj = Catagory::all();
        return $obj;
    }
}
