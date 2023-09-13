<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function product(){
        return view('admin.product.addproduct');
    }
    public function postAddProduct(Request  $request){
        $text=$request->text;
        $title=$request->title;
        $cost=$request->cost;
        $photo=$request->photo;
        $about=$request->about;
        $status=$request->product_status;

        if($photo){
            $time=md5(time()).'.'.$photo->getClientOriginalExtension();
            $photo->move('site/uploads/product/',$time);
           
        }
        else{
            $time=Null;
        }
            $product= new Product;
            $product->category = $text;
            $product->product_title = $title;
            $product->product_cost = $cost;
            $product->photo = $time;
            $product->details = $about;
            $product->product_status = $status;
            $product->save();
            return redirect()->route('ManageProduct')->with('success','Product Added Successfully');
    }


    public function ManageProduct(){
        return view('admin.product.manageproduct', [ 'products' => Product::paginate(5)]);
    }

    public function getDeleteProduct(Product $product){
        $product->delete();
        return view('admin.product.manageproduct', [ 'products' => Product::paginate(5)]);
    }

    public function geteditproduct(Product $product){
        $data = ['product'=>$product];
        return view('admin.product.editproduct', $data);
    }

    
    public function postEditProduct(Product $product, Request $request){
        $product->category=$request->input('text');
        $product->product_title=$request->input('title');
        $product->product_cost=$request->input('cost');
        $product->details=$request->input('details');
        $product->product_status=$request->input('product_status');
        $photo = $request->file('photo');
        if($photo){
            $time=md5(time()).'.'.$photo->getClientOriginalExtension();
            $photo->move('site/uploads/product/',$time);
            $product->$photo = $time;
            $product->save();
        }
        else{
            $product->save();
        }
        return redirect()->route('ManageProduct')->with('editsuccess','Edit Successfully');
    }
}
