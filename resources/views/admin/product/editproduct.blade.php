<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="manageproduct"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='User Profile'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-3     px-md-5">
                <span class="mask  bg-gradient-primary  opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-3">Edit Product</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        @if (session('status'))
                        <div class="row">
                            <div class="alert alert-success alert-dismissible text-white" role="alert">
                                <span class="text-sm">{{ Session::get('status') }}</span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10"
                                    data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        @endif
                        @if (Session::has('demo'))
                                <div class="row">
                                    <div class="alert alert-danger alert-dismissible text-white" role="alert">
                                        <span class="text-sm">{{ Session::get('demo') }}</span>
                                        <button type="button" class="btn-close text-lg py-3 opacity-10"
                                            data-bs-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                        @endif
                        <form method='POST' action="{{ route('postEditProduct', $product->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Category</label>
                                    <input type="text" value="{{$product->category}}" name="text" class="form-control border border-2 p-2" required>
                                    @error('name')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                                </div>
                               
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Product Title</label>
                                    <input type="title"  value="{{$product->product_title}}" name="title" class="form-control border border-2 p-2" required>
                                    @error('title')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Product Cost</label>
                                    <input type="text" value= "{{$product->product_cost}}" name="cost" class="form-control border border-2 p-2" required>
                                    @error('cost')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Photo</label> 
                                    <input type="file" name="photo" class="form-control border border-2 p-2">
                                    <img src="{{asset('site/uploads/product/'. $product->photo)}}" alt="Error Photo" style="max-width: 180px">
                                    @error('photo')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                
                                
                                <div class="mb-3 col-md-12">
                                    <label for="floatingTextarea2">Details</label>
                                    <textarea class="form-control border border-2 p-2"
                                        placeholder=" Say something about yourself" id="floatingTextarea2" name="details"
                                        rows="4" cols="50">{{$product->details }}</textarea>
                                        @error('about')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Product Status</label><br>
                                    <input type="radio" id="product_status" name="product_status" value="Show"
                                        {{ $product->product_status == 'Show' ? 'checked' : ''  }}>
                                        
                                    <label for="product_status">Show</label><br>
                                    
                                    <input type="radio" id="product_status" name="product_status" value="Hide"
                                        {{ $product->product_status == 'Hide' ? 'checked' : ''  }}>

                                    <label for="product_status">Hide</label><br>
                                    @error('photo')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror
                                </div>
                                
                            </div>
                            <button type="submit" class="btn bg-gradient-dark">Edit</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
        <x-footers.auth></x-footers.auth>
    </div>
    <x-plugins></x-plugins>

</x-layout>
