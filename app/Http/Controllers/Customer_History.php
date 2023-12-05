<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Games;
use App\Models\Times;
use App\Models\On_Game;
use App\Models\Catagorys;
use App\Models\Customer;
use App\Models\History;

class Customer_History extends Controller
{
    public function customer_history(){
        $obj = Customer::all();
        return view("customer_history/customer_history")->with(["customer"=>$obj]);
    }

    public function fromcus(Request $r){
        $date1 = $r->date1;
        $old_date_timestamp = strtotime($date1);
        $date1 = date('Y-m-d', $old_date_timestamp);   

        $date2 = $r->date2;
        $old_date_timestam = strtotime($date2);
        $date2 = date('Y-m-d', $old_date_timestam);   
        // echo $date1;
        // echo "<br>";
        // echo $date2;
        // $customer = $r->customer;
        // echo $r->customer;
        $obj = Customer::all();
        $obj2 = Customer::find($r->customer);
        $obj3 = History::leftJoin("games","history.game_id","=","games.id")
        ->where("history.customer_id","=",$r->customer)
        ->whereBetween('history.date', [$date1, $date2])
        ->get(["games.game_name as gname","history.*"]);
        // $obj3 = Bill::where("customer_id","=",$r->customer)->get();
        // print_r($obj3);
        // $obj4 = Payment::where("customer_id","=",$r->customer)->get();
        return view('customer_history/custo_histo')->with(["customer"=>$obj,"custo"=>$obj2,"play"=>$obj3]);
    }

    public function direct_history(Request $r){
        $date1 = '2023-10-10';   

        $date2 = date('Y-m-d');  

        $obj = Customer::all();
        $obj2 = Customer::find($r->id);
        $obj3 = History::leftJoin("games","history.game_id","=","games.id")
        ->where("history.customer_id","=",$r->id)
        ->whereBetween('history.date', [$date1, $date2])
        ->get(["games.game_name as gname","history.*"]);
        // $obj3 = Bill::where("customer_id","=",$r->customer)->get();
        // print_r($obj3);
        // $obj4 = Payment::where("customer_id","=",$r->customer)->get();
        return view('customer_history/custo_histo')->with(["customer"=>$obj,"custo"=>$obj2,"play"=>$obj3]);
    }

    public function clear_history(Request $r){
        $obj = History::find($r->id);
        $obj->delete();
        return redirect()->back();
    }
}
