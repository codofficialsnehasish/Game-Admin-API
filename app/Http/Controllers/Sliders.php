<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Slider;

class Sliders extends Controller
{
    //============================ Slider ======================

    public function slider(Request $r){
        $s = Slider::all();
        if($r->is('api/*')){
            return $s;
        }else{
            return view("slider/content")->with(['slider'=>$s]);
        }
    }

    public function sliderAdd(){
        return view("slider/add");
    }

    public function slider_submit(Request $r){
        $slider = new Slider();
        $slider->title = $r->name;
        $slider->description = $r->desc;
        $img = $r->file("sliderimg");
        if(isset($img)){
            $img_name = time().$img->getClientOriginalName();
            $img->move(public_path("files/slider_images"),$img_name);
        }else{
            $img_name = "Not provided";
        }
        $slider->image = $img_name;
        $slider->is_visible = $r->is_visible;
        $slider->file_path = env('APP_URL')."files/slider_images/".$img_name;
        $slider->save();
        return redirect(url('/slider'));
    }
    
    public function sliderEdit(Request $r){
        $obj = Slider::find($r->id);
        return view("slider/edit")->with(['slider'=>$obj]);
    }

    public function slider_edit_submit(Request $r){
        $slider = Slider::find($r->id);
        $slider->title = $r->name;
        $slider->description = $r->desc;
        $img = $r->file("sliderimg");
        if(isset($img)){
            if($slider->image != "Not provided"){
                unlink("files/slider_images/".$slider->image);
            }
            $img_name = time().$img->getClientOriginalName();
            $img->move("files/slider_images",$img_name);
        }else{
            $img_name = $slider->image;
        }
        $slider->image = $img_name;
        $slider->is_visible = $r->is_visible;
        $slider->file_path = env('APP_URL')."files/slider_images/".$img_name;
        $slider->update();
        return redirect(url('/slider'));
    }

    public function slider_del(Request $r){
        $obj = Slider::find($r->id);
        if($obj->image != "Not provided"){
            unlink("files/slider_images/".$obj->image);
        }
        $obj->delete();
        return redirect(url('/slider'));
    }

    //==========xxxxxxx======= End of Slider ===========xxxxxx=======
}
