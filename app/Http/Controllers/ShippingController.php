<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipping;

class ShippingController extends Controller
{
    public function shipping(){
        return view('admin.Shipping.addshipping');
    }
    public function postAddShipping(Request  $request){
        $text=$request->state;
        $number=$request->number;
        $status=$request->shipping_status;

            $shipping= new shipping;

            $shipping->state = $text;
            $shipping->charge = $number;
            $shipping->shipping_status = $status;
            $shipping->save();
            return redirect()->route('shipping');
    }
}
