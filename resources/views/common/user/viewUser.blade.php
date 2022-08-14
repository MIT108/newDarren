@extends('layouts.user')
@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Profile</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Pages</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 OPEN -->
                <div class="row" id="user-profile">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="wideget-user mb-2">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="row">
                                                <div class="panel profile-cover">
                                                    <div class="profile-cover__action bg-img"></div>
                                                    <div class="profile-cover__img">
                                                        <div class="profile-img-1">
                                                            @if ($user->image == 'http://localhost:8000/storage/users/')
                                                                <img alt="avatar" id="preview-image-before-upload"
                                                                    src="../assets/images/users/7.jpg" class="brround"
                                                                    style='height: 100%; width: 100%; object-fit: contain'>
                                                            @else
                                                                <img alt="avatar" id="preview-image-before-upload" src="{{ $user->image }}"
                                                                    class="brround" style='height: 100%; width: 100%; object-fit: contain'>
                                                            @endif
                                                        </div>
                                                        <div class="profile-img-content text-dark text-start">
                                                            <div class="text-dark">
                                                                <h3 class="h3 mb-2">{{ $user->name }}</h3>
                                                                <h5 class="text-muted">{{ $user->email }}</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="btn-profile">
                                                        @if (Auth::user()->id == $user->id)
                                                            <a class="btn btn-secondary mt-1 mb-1" href="/user-edit"> <i class="fe fe-edit-3 mx-2"></i>
                                                                <span>Edit User</span></a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="">
                                                    <div class="social social-profile-buttons mt-5 float-end">
                                                        <div class="mt-3">
                                                            <a class="social-icon text-primary" href=""><i
                                                                    class="fa fa-facebook"></i></a>
                                                            <a class="social-icon text-primary" href=""><i
                                                                    class="fa fa-twitter"></i></a>
                                                            <a class="social-icon text-primary" href=""><i
                                                                    class="fa fa-youtube"></i></a>
                                                            <a class="social-icon text-primary" href=""><i
                                                                    class="fa fa-rss"></i></a>
                                                            <a class="social-icon text-primary" href=""><i
                                                                    class="fa fa-linkedin"></i></a>
                                                            <a class="social-icon text-primary" href=""><i
                                                                    class="fa fa-google-plus"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">About</div>
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <p>
                                                {{ $user->about_me }}
                                            </p>
                                        </div>
                                        <hr>
                                        <div class="d-flex align-items-center mb-3 mt-3">
                                            <div class="me-4 text-center text-primary">
                                                <span><i class="fe fe-map-pin fs-20"></i></span>
                                            </div>
                                            <div>
                                                <strong>{{ $user->location }}</strong>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-3 mt-3">
                                            <div class="me-4 text-center text-primary">
                                                <span><i class="fe fe-phone fs-20"></i></span>
                                            </div>
                                            <div>
                                                <strong>{{ $user->phone }}</strong>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-3 mt-3">
                                            <div class="me-4 text-center text-primary">
                                                <span><i class="fe fe-mail fs-20"></i></span>
                                            </div>
                                            <div>
                                                <strong>{{ $user->email }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- COL-END -->
                </div>
                <!-- ROW-1 CLOSED -->
            </div>
            <!-- CONTAINER CLOSED -->

        </div>
    </div>
    <!--app-content closed-->
@endsection
