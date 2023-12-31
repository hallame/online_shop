<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Slider;

class SliderController extends Controller
{
    public function saveslider(Request $request){

        $this->validate($request, [
            'description1' => 'required',
            'description2' => 'required',
            'image' => 'image|nullable|max:1999'
        ]);
        // getting file name with extension
        $fileNameWithExt = $request->file('image')->getClientOriginalName();
        // print($request->file('image')->getClientOriginalName());

        // getting file name
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

        // getting file extension
        $ext = $request->file('image')->getClientOriginalExtension();
        
        // file name to store
        $fileNameToStore = $fileName."_".time().".".$ext;

        // uploading image in the laravel file
        $path = $request->file('image')->storeAs("public/slider_images", $fileNameToStore);

        $slider = new Slider();
        $slider->description1 = $request->input('description1');
        $slider->description2 = $request->input('description2');
        $slider->image = $fileNameToStore;
        $slider->save();

        return back()->with("status", "Votre slider a été créé avec succès !!");

        
    }

    public function deleteslider($id){
        $slider = Slider::find($id);
        Storage::delete("public/slider_images/$slider->image");
        $slider->delete();

        return back()->with("status", "Votre slider a été supprimé avec succès !");

    }

    public function editslider($id){
        $slider = Slider::find($id);
        return view('admin.editslider')->with("slider", $slider);
    }
    public function updateslider($id, Request $request){
        $slider = Slider::find($id);
        $slider->description1 = $request->input('description1');
        $slider->description2 = $request->input('description2');

        if($request->file('image')){
            $this->validate($request, [
                'image' => 'image|nullable|max:1999'
            ]);
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $ext = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName."_".time().".".$ext;

            Storage::delete("public/slider_images/$slider->image");

            $path = $request->file('image')->storeAs("public/slider_images", $fileNameToStore);

            $slider->image = $fileNameToStore;
        }
        
        
        $slider->update();
        return redirect('admin/sliders')->with("status", "Votre slider a été modifiée avec succès !!");
    }
    public function unactivateslider($id){
        $slider = Slider::find($id);
        $slider->status = 0;
        $slider->update();
        return back();
    }
    public function activateslider($id){
        $slider = Slider::find($id);
        $slider->status = 1;
        $slider->update();
        return back();
    }

}
