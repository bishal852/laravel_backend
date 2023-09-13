@extends('site.template')
@section('content')
<div id="card" style="padding:50px 0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{route('getCart')}}"></a>
                <br>
                <h3>Carts</h3>
                
                @if(Session::has('editsuccess'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success text-dark" role="alert">
                            <b>Edit Successfully.</b>
                        </div>
                    </div>
                </div>
                @endif

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Photo</th>
                            <th scope="col">Product</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Cost</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    @foreach ($carts as $tabledata)
                    @php 
                    $productinfo = App\Models\Product::where('id', $tabledata->product_id)->limit(1)->first();
                    @endphp
                    <tbody>
                        <tr>
                            <td><img src="{{ asset('site/uploads/product/' . $productinfo->photo) }}" alt="" width="100"></td>
                            <td>{{ $productinfo->product_title }}</td>
                            <td>{{ $tabledata->qty }}</td>
                            <td>{{ $tabledata->cost }}</td>
                            <td>{{ $tabledata->totalcost }}</td>
                            <td style="text-align: center;"> 
                            <a href="{{route('editcarts', $tabledata->id)}}"
                            class="text-secondary btn text-light btn-primary font-weight-bold text-xs"><b>Edit</b>
                            </a>
                            <a href="{{route('deletecarts', $tabledata->id)}}"
                            class="text-secondary btn text-light btn-primary font-weight-bold text-xs"><b>Delete</b>
                            </a></td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                
                <div class="row">
                    <div class="col-md-20">
                        <a href="{{route('getCheckOut',$tabledata->id)}}" class="btn btn-danger">Checkout</a>
                    </div>
                </div>
                <div class="seemore_bt"><a href="{{route('getProduct')}}">Add More</a></div>
            </div>
        </div>
    </div>
</div>
@stop