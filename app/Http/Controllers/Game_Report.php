<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\On_Game;

class Game_Report extends Controller
{
    public function kolkataff(){
        $payments = DB::table('on_game')
        ->select('date','on_game.id as gid', 'timing.baji', 'games.game_name', DB::raw('SUM(cutting_amount) as sum_paying_cash'), DB::raw('SUM(winn_amount) as sum_winning_cash'))
        ->leftJoin('timing','on_game.time_id','=','timing.id')
        ->leftJoin('games','on_game.game_id','=','games.id')
        ->where('on_game.game_id', "=", 1)
        ->where('on_game.date', "=", date("Y-m-d"))
        ->groupBy('time_id')
        ->get();

        return view("game_reports/kolkataff")->with(["data"=>$payments]);
        // return $payments;
    }
    public function del_kolkataff(Request $r){
        $obj = On_Game::find($r->id);
        $obj->delete();
        return redirect(url('/kolkataff'));
    }
    public function cmmmimbai(){
        $payments = DB::table('on_game')
        ->select('date', 'timing.baji', 'games.game_name', DB::raw('SUM(cutting_amount) as sum_paying_cash'), DB::raw('SUM(winn_amount) as sum_winning_cash'))
        ->leftJoin('timing','on_game.time_id','=','timing.id')
        ->leftJoin('games','on_game.game_id','=','games.id')
        ->where('on_game.game_id', "=", 3)
        ->where('on_game.date', "=", date("Y-m-d"))
        ->groupBy('time_id')
        ->get();

        return view("game_reports/cmmmumbai")->with(["data"=>$payments]);
        // return $payments;
    }
    public function del_cmmmimbai(Request $r){
        $obj = On_Game::find($r->id);
        $obj->delete();
        return redirect(url('/cmmmimbai'));
    }
}