<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requestt;
use App\Models\Customer;

class Requests extends Controller
{
    // public function show_requests(){
    //     $obj = Requestt::leftJoin("customer","request.phone","customer.mobile")
    //     ->orderBy('request.date', 'desc')
    //     ->get(["request.*","customer.beneficiary_name as cname","customer.m_pin as pin","customer.password as password"]);
    //     return view("requests/show_requests")->with(["data"=>$obj]);
    // }

    public function get_request(Request $r){
        // $req = new Requestt();
        // $req->date = date("d-m-Y");$r->phone;
        if(preg_match('/^[0-9]{10}+$/', $r->phone)){
            if(Customer::where("mobile","=",$r->phone)->count() > 0){
                $res = Customer::where("mobile","=",$r->phone)->get();
                return ["status"=>"True","phone"=>$res[0]->mobile];
            }else{
                return ["status"=>"False","error"=>"Phone Number Not Available"];
            }
        }else{
            return ["status"=>"false",'error' => "Not a valid phone number"];
        }
    }

    public function request_submit(Request $r){
        if(!empty($r->password) || !empty($r->m_pin) || !empty($r->phone)){
            if (!empty($r->password) && strlen($r->password) < 8) {
                return ["status"=>"false",'error'=>"Password Must Contain At Least 8 Character!"];
            }elseif (!empty($r->m_pin) && !preg_match('/^[0-9]{4}+$/', $r->m_pin)) {
                return ["status"=>"false",'error'=>"M-Pin Must Contain 4 Digit!"];
            }else{
                if(Customer::where("mobile","=",$r->phone)->count() > 0){
                    $id = Customer::where("mobile","=",$r->phone)->get(['id']);
                    $obj = Customer::find($id[0]->id);
                    $obj->password = $r->password;
                    $obj->m_pin = $r->m_pin;
                    $res = $obj->update();
                    if($res){
                        return ["status"=>"true",'data'=>'Updated'];
                    }else{
                        return ["status"=>"false",'error'=>'Erroe Occured ! ):'];
                    }
                }else{
                    return ["status"=>"False","error"=>"Phone Number Not Available"];
                }
            }
        }else{
            return ["status"=>"False","error"=>"Please provide data"];
        }
    }

    // public function clear_requests(Request $r){
    //     $obj = Requestt::find($r->id);
    //     $obj->delete();
    //     return redirect(url("/show_requests"));
    // }
}
