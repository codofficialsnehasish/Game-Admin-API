<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\How_Play;

class How_to_play extends Controller
{
    public function content(Request $r){
        $data = How_Play::all();
        if( $r->is('api/*')){
            return ["status"=>"true",'data' => $data];
        }
        return view("how_to_play/content")->with(["data"=>$data]);
    }

    public function add_content(){
        return view("how_to_play/add_htp");
    }
    public function submit_content(Request $r){
        $obj = new How_Play();
        $obj->content = $r->content;
        $obj->link = $r->link;
        $obj->save();
        return redirect(url('/how_to_play'));
    }
    public function edit_content(Request $r){
        $data = How_Play::find($r->id);
        return view("how_to_play/edit_htp")->with(["data"=>$data]);
    }
    public function update_content(Request $r){
        $obj = How_Play::find($r->id);
        $obj->content = $r->content;
        $obj->link = $r->link;
        $obj->update();
        return redirect(url('/how_to_play'));
    }
    public function del_content(Request $r){
        $obj = How_Play::find($r->id);
        $obj->delete();
        return redirect(url('/how_to_play'));
    }


    // public function assen(){
    //     return view("form")->with(["data"=>"input please"]);
    // }
    // function isAscending($number) {
    //     // Convert the number to a string to iterate through each digit
    //     $numberStr = (string)$number;
        
    //     // If the number contains 0, treat it as a big number
    //     if (strpos($numberStr, '0') !== false) {
    //         return true;
    //     }
    
    //     // Iterate through each digit to check if it's in ascending order
    //     $length = strlen($numberStr);
    //     for ($i = 0; $i < $length - 1; $i++) {
    //         if ($numberStr[$i] > $numberStr[$i + 1]) {
    //             return false;
    //         }
    //     }
    
    //     return true;
    // }
    // public function submitassn(Request $r){
    //     $ans = "$r->num is " . ($this->isAscending($r->num) ? "ascending" : "not ascending");
    //     // return redirect()->back()->with(["data"=>"not ascending"]);
    //     return view("form")->with(["data"=>$ans]);
    // }
}
