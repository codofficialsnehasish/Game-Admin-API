<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Subcatagory;
use App\Models\Catagorys;

class Sub_catagory extends Controller
{
        //============================ Catagory ======================

        public function sub_catagory(){
            $obj = Catagorys::all();
            return view("game/sub_catagory/sub_catagory")->with(['catagory'=>$obj]);
        }
    
        public function add_sub_catagory(Request $r){
            $m = new Subcatagory();
            $m->catagory_id = $r->catagory;
            $m->name = $r->subcatagory;
            $m->save();
            return redirect(url('/show_sub_catagory'));
        }
    
        public function show_sub_catagory(Request $request){
            $obj = Subcatagory::leftJoin('catagory','sub_catagory.catagory_id','=','catagory.id')
            ->get(['sub_catagory.id','sub_catagory.name as subcatagory','catagory.name as catagory']);
            if( $request->is('api/*')){
                return $obj;
            }else{
                return view("game/sub_catagory/show_sub_catagory")->with(["subcatagory"=>$obj]);
            }
        }
    
        public function del_sub_catagory(Request $r){
            $obj = Subcatagory::find($r->id);
            $obj->delete();
            return redirect(url('/show_sub_catagory'));
        }
    
        public function edit_sub_catagory(Request $r){
            $obj = Subcatagory::find($r->id);
            $cata = Catagorys::all();
            return view("game/sub_catagory/edit_sub_catagory")->with(["data"=>$obj,"cata"=>$cata]);
        }
    
        public function update_sub_catagory(Request $r){
            $obj = Subcatagory::find($r->id);
            $obj->catagory_id = $r->catagory;
            $obj->name = $r->subcatagory;
            $obj->update();
            return redirect(url('/show_sub_catagory'));
        }
    
    
        //==========xxxxxxx======= End of Catagory ===========xxxxxx=======
}
