<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Customer;
use App\Models\Slider;
use App\Models\Catagory;
use App\Models\On_Game;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;

class Admin extends Controller
{
    // =====================login functions=================

    // public function register_user(){
    //     $obj = new User();
    //     $obj->name = "Snehasish Bhurisrestha";
    //     $obj->email  = "admin@demo.com";
    //     $obj->password  = bcrypt("admin");
    //     $obj->save();
    // }

    public function login(){
        return view("authentication/login");
    }

    public function checkuser(Request $r){
        if(Auth::attempt(["email"=>$r->email,"password"=>$r->pass])){
            return redirect(url('/dashboard'));
        }else{
            return redirect(url('/'))->with(["msg"=>"Invalid Login"]);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect(url('/'));
    }

    public function change_password(){
        return view("authentication/change_pass");
    }

    public function change_pass(Request $r){
        $cp = $r->cp;
        $np = $r->np;
        $conpass = $r->conpass;
        if (Hash::check($cp, Auth::user()->password)) {
            if($np == $conpass){
                $obj = User::find(Auth::user()->id);
                $obj->password = bcrypt($np);
                $obj->update();
                Auth::logout();
                return redirect(url('/'));
            } else{
                return redirect(url('/changepass'))->with(["msg"=>"Not Matched Confirm Password"]);
            }
        } else {
            return redirect(url('/changepass'))->with(["msg"=>"Not Matched Current Password"]);
        }
    }
    // ====================end of login & logout functions====================


    // ===================== API login functions =================

    public static function app_login(Request $r){
        $phone = $r->phone;
        $pass = $r->password;
        $m_pin = $r->m_pin;
        if($phone != "" && $pass != "" && $m_pin == ""){
            if(Customer::where("mobile","=",$r->phone)->count() > 0){
                $obj = Customer::where("mobile","=",$r->phone)->get();
                // $hashed = Hash::make($pass, ['rounds' => 15,]);
                if(Hash::check($pass, $obj[0]->password)) {
                    return ["status"=>"true","data"=>$obj[0]];
                } else {
                    return ["status"=>"false",'error' => "Invalid Password"];
                }
                // return $obj[0];
            }else{ 
                return ["status"=>"false",'error' => "Phone number is not avaliable"];
            }
        }elseif($phone != "" && $pass == "" && $m_pin != ""){
            if(Customer::where("mobile","=",$r->phone)->count() > 0){
                $obj = Customer::where("mobile","=",$r->phone)->get();
                if($m_pin == $obj[0]->m_pin) {
                    return ["status"=>"true","data"=>$obj[0]];
                } else {
                    return ["status"=>"false",'error' => "Invalid M-pin"];
                }
                // return $obj[0];
            }else{ 
                return ["status"=>"false",'error' => "Phone number is not avaliable"];
            }
        }
        //elseif($phone != "" && $pass != "" && $m_pin != ""){
        //     $obj = Customer::where("mobile","=",$r->phone)
        //     ->where("password","=",$r->password)
        //     ->where("m_pin","=",$r->m_pin)
        //     ->count();
        //     if($obj > 0){
        //         $obj = Customer::where("mobile","=",$r->phone)
        //             ->where("password","=",$r->password)
        //             ->where("m_pin","=",$r->m_pin)
        //             ->get();
        //         return $obj[0];
        //     }else{ 
        //         return ['massage' => "Invalid Login"];
        //     }
        // }
        else{
            return ["status"=>"false",'error' => "Invalid Login"];
        }
    }


    // ====================end of API login & logout functions====================



    //============================Dashboard======================

    public function dashboard(){
        $customer = Customer::all()->count();
        return view("dashboard")->with(["customer"=>$customer]);;
    }

    //==========xxxxxxx=======End of Dashboard===========xxxxxx=======


    //========================= Customer ======================

    public function customer(){
        return view("customer/addcustomer");
    }

    public function addcustomer(Request $r){
        if( Customer::where("mobile","=",$r->phone)->count() > 0){ 
            if($r->is('api/*')){ 
                return ["status"=>"false",'error' => "Phone number is avalible"];
            }else{
                return redirect()->back()->with('error', 'Phone number is avalible, try another.');
            }
        }
        $customer = new Customer();
        $customer->reg_date = date('Y-d-m');
        $customer->beneficiary_name = $r->name;
        if(preg_match('/^[0-9]{10}+$/', $r->phone)){
            $customer->mobile = $r->phone;
        }else{
            if($r->is('api/*')){
                return ["status"=>"false",'error' => "Not a valid phone number"];
            }else{
                return redirect()->back()->with('error', 'Please enter valid phone number.');
            }
        }
        $customer->wallet_balance = $r->balance;
        $customer->google_pay_no = $r->gpay;
        $customer->paytm_no = $r->paytm;
        $customer->email = $r->email;
        // if($r->password == $r->confirm_password){
        //     $customer->password = bcrypt($r->password);
        // }else{
        //     if( $r->is('api/*')){
        //         return ['massage'=>"Confirm Password Not Mached"];
        //     }else{
        //         return redirect()->back()->with('error', 'Confirm Password Not Mached.');
        //     }
        // }

        if($r->password == $r->confirm_password) {
            if (strlen($r->password) < 8) {
                if( $r->is('api/*')){
                    return ["status"=>"false",'error'=>"Password Must Contain At Least 8 Character!"];
                }else{
                    return redirect()->back()->with('error', 'Password Must Contain At Least 8 Characters!.');
                }
            }else{
                $customer->password = bcrypt($r->password);
            }
        }else{
            if( $r->is('api/*')){
                return ["status"=>"false",'error'=>"Confirm Password Not Mached"];
            }else{
                return redirect()->back()->with('error', 'Confirm Password Not Mached.');
            }
        }

        // $customer->m_pin = bcrypt($r->m_pin);
        // if (strlen($r->m_pin) < 4 && strlen($r->m_pin) > 4) {
        if (preg_match('/^[0-9]{4}+$/', $r->m_pin)) {
            // $customer->m_pin = bcrypt($r->m_pin);
            $customer->m_pin = $r->m_pin;
        }else{
            if( $r->is('api/*')){
                return ["status"=>"false",'error'=>"M-Pin Must Contain 4 Digit!"];
            }else{
                return redirect()->back()->with('error', 'M-Pin Must Contain 4 Digit!.');
            }
        }
        if($r->is('api/*')){ $customer->adding_mode = "App"; }
        $result = $customer->save();
        if( $r->is('api/*')){
            if($result){ return ["status"=>"true",'data'=>'Success']; }else{ return ["status"=>"false",'error'=>'Failed']; }
        }else{
            return redirect(url('/showcustomer'));
        }
    }

    public function showcustomer(Request $request,$id = null){
        // $id = $request->id ? ;
        if( $request->is('api/*')){
            $data = $id? Customer::find($id) : Customer::all();
            if(count($data) > 0){
                return ["status"=>"true",'data'=>$data];
            }else{
                return ["status"=>"false",'error'=>'No customer found'];
            }
        }else{
            $c = Customer::all();
            return view("customer/showcustomer")->with(["customer"=>$c]);
        }
    }

    public function edit_customer(Request $r){
        $obj = Customer::find($r->id);
        return view("customer/edit_customer")->with(["customer"=>$obj]);
    }

    public function update_customer(Request $r){
        $obj = Customer::find($r->customer_id);
        // $customer->reg_date = $r->date;
        $obj->beneficiary_name = $r->name ? $r->name : $obj->beneficiary_name;
        $obj->mobile = $r->phone ? $r->phone : $obj->mobile;
        $obj->wallet_balance = $r->balance ? $r->balance : $obj->wallet_balance;
        $obj->google_pay_no = $r->gpay ? $r->gpay : $obj->google_pay_no;
        $obj->paytm_no = $r->paytm ? $r->paytm : $obj->paytm_no;
        $obj->email = $r->email ? $r->email : $obj->email;
        // $customer->adding_mode = $r->mode;
        $res = $obj->update();
        if($r->is('api/*')){
            if($res){
                return ["status"=>"true",'massage'=>'Customer Updated'];
            }else{
                return ["status"=>"false",'massage'=>'Update Failed'];
            }
        }else{
            return redirect(url('/showcustomer'));
        }
    }

    public function customerdel(Request $r){
        $custo = Customer::find($r->id);
        $result = $custo->delete();
        if($r->is('api/*')){
            if($result){
                return ['massage'=>'Customer Deleted'];
            }else{
                return ['massage'=>'Failed'];
            }
        }else{
            return redirect(url('/showcustomer'));
        }
    }

    //==========xxxxxxx======= End of Customer ===========xxxxxx=======
}