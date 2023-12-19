<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\On_Game;

class Single_digit_payment extends Controller
{
    public function single_cata(){
        $data = On_Game::where("catagory_id","=",1)->get();
        $s1 = $s2 = $s3 = 0;
        foreach($data as $d){

        }
    }
}
