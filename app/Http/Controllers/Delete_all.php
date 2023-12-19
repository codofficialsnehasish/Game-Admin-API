<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallets;
use App\Models\On_Game;
use App\Models\Results;

class Delete_all extends Controller
{
    public function del_wallet(Request $r){
        // print_r($r->arr);
        if(!empty($r->arr)){
            foreach($r->arr as $a){
                $obj = Wallets::find($a);
                $obj->delete();
            }
        }
        return redirect()->back();
    }
    public function del_ongame(Request $r){
        // print_r($r->arr);
        if(!empty($r->arr)){
            foreach($r->arr as $a){
                $obj = On_Game::find($a);
                $obj->delete();
            }
        }
        return redirect()->back();
    }

    public function del_result(Request $r){
        // print_r($r->arr);
        if(!empty($r->arr)){
            foreach($r->arr as $a){
                $obj = Results::find($a);
                $obj->delete();
            }
        }
        // return redirect()->back();
        return redirect(url('/show_result'));
    }
}
