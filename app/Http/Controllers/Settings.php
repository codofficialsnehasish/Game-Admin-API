<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\General_settings;

class Settings extends Controller
{
    public function content(){
        $obj = General_settings::find(1);
        return view("settings/content")->with(["general_settings"=>$obj]);
    }

    public function add_content(Request $r){
        $obj = General_settings::find(1);
        $obj->contact_phone = $r->phone;
        $obj->contact_phone_opt = $r->phoneopt;
        $obj->contact_email = $r->email;
        $obj->contact_email_opt = $r->emailopt;
        $obj->contact_address = $r->address;
        $obj->wallet_add_txt = $r->wt_text;
        $obj->wallet_withdraw_txt = $r->with_text;
        $obj->update();
        return redirect(url('/content'));
    }
}
