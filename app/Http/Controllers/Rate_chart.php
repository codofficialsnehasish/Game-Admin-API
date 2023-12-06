<?php

namespace App\Http\Controllers;

use App\Models\Chart_name;
use App\Models\Rate;

use Illuminate\Http\Request;

class Rate_chart extends Controller
{
    public function charts(Request $r){
        if( $r->is('api/*')){
            $rate = Chart_name::join("rate_chart","chart_name.id","rate_chart.chart_name_id")
            ->get(["chart_name.name","rate_chart.*"]);
            return ["status"=>"true",'table_data' => $rate];
        }
        $name = Chart_name::all();
        $rate = Rate::all();
        return view("rate_chart/chart_content")->with(["rate"=>$rate,"name"=>$name]);
    }

    public function add_chart(){
        return view("rate_chart/chart_add");
    }
    public function post_chart(Request $r){
        // print_r($r->outer_group[0]['name']);
        $rate = new Chart_name();
        $rate->name = $r->outer_group[0]['name'];
        $rate->save();
        for($i=0;$i<count($r->outer_group[0]['inner_group']); $i++){
            $rate_c = new Rate();
            $rate_c->chart_name_id = $rate->id;
            $rate_c->type = $r->outer_group[0]['inner_group'][$i]['type'];
            $rate_c->play = $r->outer_group[0]['inner_group'][$i]['play'];
            $rate_c->winning = $r->outer_group[0]['inner_group'][$i]['win'];
            $rate_c->save();
        }
        return redirect(url('/charts'));
    }
    public function del_chart(Request $r){
        $Chart_name = Chart_name::find($r->id);
        $Rate = Rate::where("chart_name_id","=",$Chart_name->id);
        foreach($Rate as $t){
            $ti = Rate::find($t);
            $ti->delete();
        }
        $Chart_name->delete();
        return redirect()->back();
    }
}
