<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="managegallery"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Tables"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                    <h6 class="text-white text-capitalize ps-3">Gallery table</h6>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                @if(Session::has('success'))
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-success text-light" role="alert">
                                            <b>Added Successfully.</b>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if(Session::has('editsuccess'))
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-success text-light" role="alert">
                                            <b>Edit Successfully.</b>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Title</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Photo</th>
                                                    <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Upload At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($galleries as $gal)
                                            <tr>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{$gal->title}}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <img src="{{ asset('site/uploads/gallery/'.$gal->photo )}}"
                                                                class="img-fluid w-100 img-thumnail rounded mx-auto d-block"
                                                                alt="user1" style="max-width: 100px; height: 100px;">
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{$gal->created_at}}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <a class="btn btn-success btn-link"
                                                        href="{{route('getEditGallery', $gal->id)}}">
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                    <a  class="btn btn-danger btn-link"
                                                        href="{{route('getDeleteGallery', $gal->id)}}" >
                                                        <i class="material-icons">delete</i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{$galleries->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-footers.auth></x-footers.auth>
            </div>
        </main>
        <x-plugins></x-plugins>

</x-layout>
