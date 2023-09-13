<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function photo(){
        return view('admin.gallery.addgallery');
    }

    public function postAddGallery(Request $request){
            $title=$request->title;
            $photo=$request->photo;

            if($photo){
                $time=md5(time()).'.'.$photo->getClientOriginalExtension();
                $photo->move('site/uploads/gallery/',$time);
                $gallery= new Gallery;
                $gallery->title = $title;
                $gallery->photo = $time;
            }
            else{
                $time=Null;
            }
            $gallery->save();

            return redirect()->route('ManageGallery')->with('success','Gallery Added Successfully');

    
    }

    public function ManageGallery(){
        return view('admin.gallery.managegallery', ['galleries' => Gallery::paginate(5)]);
    }
    public function getDeleteGallery(Gallery $gallery){
        $gallery->delete();
        return view('admin.gallery.managegallery', ['galleries' => Gallery::paginate(5)]);
    }

    public function geteditgallery(Gallery $gallery){
        $data = ['gallery'=> $gallery];
        return view('admin.gallery.editgallery', $data);
    }

    public function postEditGallery(Gallery $gallery, Request $request){
        $gallery->title=$request->input('title');
        $photo = $request->file('photo');
        if($photo){
            $time= md5(time()).'.'.$photo->getClientOriginalExtension();
            $photo->move('site/uploads/gallery/',$time);

            $gallery->photo = $time;
            $gallery->save();
        }
        else{
            $gallery->save();
        }
        return redirect()->route('ManageGallery')->with('editsuccess','Edit Successfully');
    }

    
}