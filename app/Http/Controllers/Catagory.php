<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Catagorys;

class Catagory extends Controller
{
    //============================ Catagory ======================

    public function catagory(){
        return view("game/catagory/catagory");
    }

    public function addcatagory(Request $r){
        $m = new Catagorys();
        $m->name = $r->catagory;
        $m->save();
        return redirect(url('/show_catagory'));
    }

    public function show_catagory(Request $request){
        $obj = Catagorys::all();
        if( $request->is('api/*')){
            return $obj;
        }else{
            return view("game/catagory/show_catagory")->with(["data"=>$obj]);
        }
    }

    public function del_catagory(Request $r){
        $obj = Catagorys::find($r->id);
        $obj->delete();
        return redirect(url('/show_catagory'));
    }

    public function edit_catagory(Request $r){
        $obj = Catagorys::find($r->id);
        return view("game/catagory/edit_catagory")->with(["data"=>$obj]);
    }

    public function update_catagory(Request $r){
        $obj = Catagorys::find($r->id);
        $obj->name = $r->catagory;
        $obj->update();
        return redirect(url('/show_catagory'));
    }


    //==========xxxxxxx======= End of Catagory ===========xxxxxx=======
}
