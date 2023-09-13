@extends('site.template')
@section('content')
<div id="card" style="padding:5px 0">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <br /> <br />
                 <br> <br>
                <h3>Fill the Details</h3><br>
                <form action="{{ route('postform') }}" method="post">
                  @csrf
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                                    <div class="col-md-9">
                                      <label for="validationCustom01" class="form-label"><strong>Full Name:</strong></label>
                                      <input type="text" class="form-control" id="validationCustom01"  name="firstname" required>
                                    </div>
                                    
                                    <div class="col-md-9">
                                        <label for="validationCustom2" class="form-label"><strong>E-mail:</strong></label>
                                      <div class="input-group has-validation">
                                        <input type="mail" class="form-control" id="validationCustomUsername" name="email" aria-describedby="inputGroupPrepend" required>
                                      </div>
                                    </div>

                                    <div class="col-md-9">
                                      <label class="form-label"><strong>State:</strong></label><br>
                                      <select class="form-select" id="validationCustom03" name="State" required>
                                        <option value="">Select your state</option>
                                        @foreach($shipping as $charge)
                                        <option value="{{$charge->id}}" data-charge="{{$charge->charge}}">{{$charge->state}} @NRS {{$charge->charge}}</option>
                                        @endforeach
                                      </select>
                                    </div>

                                    <div class="col-md-9">
                                      <label for="validationCustom03" class="form-label"><strong>City:</strong></label>
                                      <input type="text" class="form-control" id="validationCustom03" name="city" required>
                                    </div>

                                    <div class="col-md-9">
                                      <label for="validationCustom03" class="form-label"><strong>Zip Code:</strong></label>
                                      <input type="text" class="form-control" id="validationCustom03" name="code" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                  @foreach ($carts as $tabledata)
                                  @endforeach
                                    <strong><h3><b>Item OverViews</b></h3></strong>
                                    <div class="d-flex row mb-6">
                                        @foreach ($carts as $tabledata)
                                          @php
                                            $productinfo = App\Models\Product::where('id', $tabledata->product_id)->first();   
                                          @endphp
                                          <img src="{{ asset('site/uploads/product/' . $productinfo->photo) }}" alt="photo"
                                                      class="m-6 col-5">
                                          @endforeach
                                      </div>
                                  <table>
                                    <strong><h3><b>Order Summary</b></h3></strong>
                                      <ul class="d-flex">
                                      <div class="paytable col-md-10">
                                          
                                            <div>SubTotal : </div>
                                            <div>Shipping : </div>
                                            <div>Estimated Tax(13%): </div>
                                            <div><strong>GrandTotal</strong> : </div>
                                          </div>
                                          <div class="paymentprice ">
                                            @php
                                            $subtotal = 0; // Initialize the grand total variable
                                            $shippingCharge = 0;
                                            $taxPercentage = 0.13;
                                            $grandTotal = 0;
                                            @endphp
                            
                                           @foreach ($carts as $tabledata)
                                              @php
                                                $productinfo = App\Models\Product::where('id', $tabledata->product_id)->first();
                                                $itemCost = $tabledata->totalcost;
                                                $subtotal += $itemCost;                                                           
                                                @endphp
                                          @endforeach
                                          <div>{{ $subtotal }}</div>     
                                          <div class="shipping-charge">{{ $shippingCharge }}</div>
                                                      @php
                                                        $taxAmount = $subtotal * $taxPercentage;
                                                        $grandTotal = $subtotal + $shippingCharge + $taxAmount;
                                                      @endphp
                                                  <span class="tax-amount">{{ $taxAmount }}</span><br>
                                                  <strong><span class="grand-total">{{ $grandTotal }}</span></strong>
                                                  @php
                                                    session(['subtotal' => $subtotal]);                                                  
                                                    session(['taxAmount' => $taxAmount]);                                                  
                                                    session(['grandTotal' => $grandTotal]);
                                                  @endphp
                                                </div>
                                              </ul>
                                            </div>
                                            <br>  
                                            <div >
                                              <label  ><strong><h3><b>Payment Method</b></h3></strong></label> <br>
                                              <input type="radio" value="esewa" name="paymethod">
                                              <label id="paymethod" >ESewa</label><br>
                                              <input type="radio" value="cod" name="paymethod">
                                              <label   id="paymethod" >COD</label>
                                          </div>
                                            <div>
                                              <button class=" btn btn-primary" type="pay">Proceed to pay</button>
                                            </div>
                                          </table>
                              </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

  $('.shipping1').ready(function() {
   var newship = {{ $shippingCharge }};
   $('.shipping-charge').text(newship);
 
   $('.shipping1').change(function() {
       var selectedShippingCharge = parseFloat($(this).find(':selected').data('charge'));
       $('.shipping-charge').text(selectedShippingCharge);
 
       // Calculate and update tax amount and grand total
       var subtotal = {{ $subtotal }};
       var taxPercentage = {{ $taxPercentage }};
       var taxAmount = subtotal * taxPercentage;
       var grandTotal = subtotal + parseFloat(selectedShippingCharge) + taxAmount;
       
       $('.tax-amount').text(taxAmount.toFixed(2));
       $('.grand-total').text(grandTotal.toFixed(2));
   });
     });
 </script>
@stop