<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requestt;

class Requests extends Controller
{
    public function show_requests(){
        $obj = Requestt::leftJoin("customer","request.phone","customer.mobile")
        ->get(["request.*","customer.beneficiary_name as cname","customer.m_pin as pin"]);
        return view("requests/show_requests")->with(["data"=>$obj]);
    }

    public function get_request(Request $r){
        $req = new Requestt();
        $req->date = date("d-m-Y");
        $req->phone = $r->phone;
        $res = $req->save();
        if($res){
            return ["status"=>"True","error"=>"Request Accepted"];
        }else{
            return ["status"=>"False","error"=>"Request Not Accepted"];
        }
    }

    public function clear_requests(Request $r){
        $obj = Requestt::find($r->id);
        $obj->delete();
        return redirect(url("/show_requests"));
    }
}
