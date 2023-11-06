<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Customer;
use App\Models\Slider;
use App\Models\Catagory;
use App\Models\Area;
use App\Models\Bill;
use App\Models\ExpenceCatagory;
use App\Models\Expences;
use App\Models\Payment;
use App\Models\Creditnotes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Login extends Controller
{
    public function login(Request $r){
        $phone = $r->phone;
        $pass = $r->password;
        if(Customer::where("mobile","=",$r->phone)->count() > 0){
            $obj = Customer::where("mobile","=",$r->phone)->get();
            return $obj;
        }else{ 
            return ['massage' => "Phone number is not avaliable"];
        }
    }

    public function m_pin_login(Request $r){
        
    }
}