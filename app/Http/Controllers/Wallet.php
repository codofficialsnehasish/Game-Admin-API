<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Customer;
use App\Models\Wallets;

class Wallet extends Controller
{
    public function add_money(){
        $obj = Customer::all();
        return view("wallet/add_money")->with(['customer'=>$obj]);
    }
    public function get_balance(Request $r){
        $obj = Customer::where("id","=",$r->id)->get("wallet_balance");
        return response()->json($obj);
    }
    public function cut_money(){
        $obj = Customer::all();
        return view("wallet/cut_money")->with(['customer'=>$obj]);
    }
    public function post_wallet(Request $r){
        $obj = new Wallets();
        $custo = Customer::find($r->customer);
        if($r->action == "cut_money"){
            $custo->wallet_balance -= $r->amount;
            $obj->status = "Debited";
        }
        if($r->action == "add_money"){
            $custo->wallet_balance += $r->amount; 
            $obj->status = "Credited";
        }
        $obj->date = date('d-m-Y');
        $obj->customer_id = $r->customer;
        $obj->amount = $r->amount; 
        $custo->update();
        $obj->save();
        return redirect(url('/show_wallet'));
    }

    public function show_wallet(){
        $obj = Wallets::leftJoin('customer','wallet.customer_id','customer.id')
        ->orderBy('wallet.date', 'desc')
        ->get(["wallet.*","customer.beneficiary_name as name"]);
        return view("wallet/show_wallet")->with(["data"=>$obj]);
    }
}
