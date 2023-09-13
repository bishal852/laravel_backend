<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;

class MediaController extends Controller
{
    public function media(){
        return view('admin.media.addmedia');
    }
    public function postAddMedia(Request  $request){
        $name=$request->name;
        $url=$request->url;
        $icon=$request->icon;
        
        if($icon){
            $time=md5(time()).'.'.$icon->getClientOriginalExtension();
            $icon->move('site/uploads/media/',$time);
           
            $media= new Media;
            $media->icon = $time;
            $media->name = $name;
            $media->url = $url;
        }
        else{
            $time=Null;
        }
        $media->icon = $time;
        $media->save();

        return redirect()->route('ManageMedia')->with('success','Media Added Successfully');
}
public function ManageMedia(){
    return view('admin.media.managemedia' , [ 'media' => Media::paginate(5)]);
}

public function getDeleteMedia(Media $media){
    $media->delete();
    return view('admin.media.managemedia', [ 'media' => Media::paginate(5)]);
}

public function getEditMedia(Media $media){
$data = ['media' => $media];
return view ('admin.media.editmedia', $data);
}

public  function postEditMedia(Media $media, Request $request){
    $media->name=$request->input('name');
    $media->url=$request->input('url');
    $icon =$request->input('icon');
    if($icon){
        $time=md5(time()).'.'.$icon->getClientOriginalExtension();
        $icon->move('site/uploads/media/',$time);

        $media->$icon = $time;
        $media->save();
    }
    else{
        $media->save();
    }
    return redirect()->route('ManageMedia')->with('editsuccess','Edit Successfully');
}

}
