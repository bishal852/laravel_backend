<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="managemedia"></x-navbars.sidebar>
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
                                    <h6 class="text-white text-capitalize ps-3">Media table</h6>
                                </div>
                            </div>
                            @if(Session::has('success'))
                            <div class="card-body px-0 pb-2">
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
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Media Name</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Media URL</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Created AT</th>
                                                <th class="text-secondary opacity-7"></th>
                                            </tr>
                                        </thead>
                                        <tbody> 
                                            @foreach($media as $med)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ asset('site/uploads/media/'.$med->icon )}}"
                                                                class="avatar avatar-sm me-3 border-radius-lg"
                                                                alt="user1">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{$med->name}}</h6>
                                                           
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle  text-sm">
                                                <a href="{{$med->url}}" target="_blank">
                                                <span class="badge badge-sm bg-gradient-success">{{$med->url}}</span>

                                                </a></td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{$med->created_at}}</span>
                                                </td>

                                                <td class="align-middle">
                                                    <a class="btn btn-success btn-link"
                                                        href="{{route('getEditMedia', $med->id)}}">
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                    <a  class="btn btn-danger btn-link"
                                                        href="{{route('getDeleteMedia', $med->id)}}" >
                                                        <i class="material-icons">delete</i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{$media->links()}}
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