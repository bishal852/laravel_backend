<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    public function AddCategory(){
        return view('admin.category.addcategory');
    }

    public function postAddCategory(Request $request){
        $title=$request->title;
        $photo=$request->photo;
        $details=$request->details;

        if($photo){
            $time = (md5(time()).'.'.$photo->getClientOriginalExtension());
            $photo->move('site/uploads/category/', $time);
        }
        else{
            $time=Null;
        }
        $category= new Category;
        $category->title = $title;
        $category->photo = $time;
        $category->details = $details;
        $category->save();
        return redirect()->route('ManageCategory')->with('success','Category Added Successfully');




    }
    public function ManageCategory(){
        return view('admin.category.managecategory',  [ 'categories' => Category::paginate(5)]);
    }
    
    public function getDeleteCategory(Category $category){
        $category->delete();
        return view('admin.category.managecategory',  [ 'categories' => Category::paginate(5)]);
    }

    public function geteditcategory(Category $category){
        $data = ['category' => $category];
        return view('admin.category.editcategory', $data);
    }
    
    public function postEditCategory(Category $category, Request $request){
        $photo = $request->file('photo');
        $category->title=$request->input('title');
        $category->details=$request->input('details');
        if($photo){
            $time= md5(time()).'.'.$photo->getClientOriginalExtension();
            $photo->move('site/uploads/category/',$time);

            $category->photo = $time;
            $category->save();
        }
        else{
            $category->save();
        }
        return redirect()->route('ManageCategory')->with('editsuccess',' Edit Successfully');
    }
    

}
