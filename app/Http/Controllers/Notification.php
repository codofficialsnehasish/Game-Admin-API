<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Models\Customer;
use App\Models\Wallets;

class Notification extends Controller
{
    public function fund(Request $r){
        $obj = new Notifications();
        $obj->date = date("d-m-Y");
        $obj->customer_id = $r->customer_id;
        $obj->amount = $r->amount;
        $obj->which_for = $r->which_for;
        $obj->mode = $r->mode;
        $res = $obj->save();
        if($res){
            return ["status"=>"true","massage"=>"Successfully Submitted"];
        }else{
            return ["status"=>"flase","massage"=>"Not Submitted"];
        }
    }

    public function show_notification(){
        $obj = Notifications::leftJoin("customer","notification.customer_id","customer.id")
        ->where("notification.seen","=",0)
        ->orderBy('notification.date', 'desc')
        ->get(["notification.*","customer.beneficiary_name as cname"]);
        return view("notification/notification")->with(["data"=>$obj]);
    }

    public function approve_add_fund(Request $r){
        $obj = Notifications::find($r->id);
        $custo = Customer::find($obj->customer_id);
        $custo->wallet_balance += $obj->amount;
        $obj2 = new Wallets();
        $obj2->date = date('d-m-Y');
        $obj2->customer_id = $obj->customer_id;
        $obj2->amount = $obj->amount;
        $custo->update();
        $obj2->save();
        $obj->seen = 1;
        $obj->update();

        return redirect(url("/show_notification"));
    }
    public function cancel_add_fund(Request $r){
        $obj = Notifications::find($r->id);
        // $custo = Customer::find($obj->customer_id);
        // $custo->wallet_balance += $obj->amount;
        // $obj2 = new Wallets();
        // $obj2->date = date('d-m-Y');
        // $obj2->customer_id = $obj->customer_id;
        // $obj2->amount = $obj->amount;
        // $custo->update();
        // $obj2->save();
        $obj->seen = 1;
        $obj->update();

        return redirect(url("/show_notification"));
    }
    public function withdraw_fund(Request $r){
        $obj = Notifications::find($r->id);
        $custo = Customer::find($obj->customer_id);
        $custo->wallet_balance -= $obj->amount;
        $custo->update();
        $obj->seen = 1;
        $obj->update();

        return redirect(url("/show_notification"));
    }
    public function cancel_withdraw_fund(Request $r){
        $obj = Notifications::find($r->id);
        $obj->seen = 1;
        $obj->update();

        return redirect(url("/show_notification"));
    }
}
