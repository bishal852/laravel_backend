@extends('site.template')
@section('content')
<div id="card" style="padding: 50px 0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Edit Cart</h3>
                <form action="{{ route('updatecart', $cart->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <table class="table table-bordered">
                        <thead>
                            <tr>  
                                <th scope="col">Photo</th>
                                <th scope="col">Product</th>
                                <th scope="col">Cost</th>
                                <th scope="col">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                               <td></td>
                                <td></td>
                                <td></td>
                                <td><input style="width:200px" type="number" class="form-control" name="qty" value="{{ $cart->qty }}" min="1"></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary" {{ $cart->qty >= 1 ? '' : 'disabled' }}>Update Quantity</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection