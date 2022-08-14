@extends('layouts.user')
@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Edit Profile</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Pages</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 OPEN -->
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Edit Image</div>
                            </div>

                            <div class="card-body">
                                <form class="text-center chat-image mb-5" action="/edit-profile-image" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf


                                    <input type="file" required name="image" placeholder="Choose image" id="image"
                                        hidden>
                                    {{-- <label for="image" class="text-center" style="width: 100%">
                                        <div class="col-md-12 mb-2 imagePreviewWrapper">
                                            <img id="preview-image-before-upload" src="../assets/default/defaultImage.png"
                                                alt="preview image" style="max-height: 250px;">
                                        </div>
                                    </label> --}}
                                    <label for="image" class="avatar avatar-xxl chat-profile mb-3 brround">
                                        @if ($user->image == 'http://localhost:8000/storage/users/')
                                            <img alt="avatar" id="preview-image-before-upload"
                                                src="../assets/images/users/7.jpg" class="brround"
                                                style='height: 100%; width: 100%; object-fit: contain'>
                                        @else
                                            <img alt="avatar" id="preview-image-before-upload" src="{{ $user->image }}"
                                                class="brround" style='height: 100%; width: 100%; object-fit: contain'>
                                        @endif
                                    </label>
                                    <div class="main-chat-msg-name">
                                        <button type="submit" href="javascript:void(0)"
                                            class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>

                            <div class="card-header">
                                <div class="card-title">Edit Password</div>
                            </div>
                            <form action="/edit-profile-password" method="POST">
                                @csrf
                                <div class="card-body">

                                    <div class="form-group">
                                        <label class="form-label">Current Password</label>
                                        <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                            </a>
                                            <input class="input100 form-control" type="password"  name="oldPassword" required
                                                placeholder="Current Password">
                                        </div>
                                        <!-- <input type="password" class="form-control" value="password"> -->
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">New Password</label>
                                        <div class="wrap-input100 validate-input input-group" id="Password-toggle1">
                                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                            </a>
                                            <input class="input100 form-control" type="password" placeholder="New Password"  name="password" required>
                                        </div>
                                        <!-- <input type="password" class="form-control" value="password"> -->
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Confirm Password</label>
                                        <div class="wrap-input100 validate-input input-group" id="Password-toggle2">
                                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                            </a>
                                            <input class="input100 form-control" type="password" name="cPassword" required
                                                placeholder="Confirm Password">
                                        </div>
                                        <!-- <input type="password" class="form-control" value="password"> -->
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <form class="card" action="/edit-profile-information" method="POST">
                            @csrf
                            <div class="card-header">
                                <h3 class="card-title">Edit Profile</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputname">Name</label>
                                            <input type="text" class="form-control" id="exampleInputname" name="name" required value="{{ $user->name }}"
                                                placeholder="Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Location</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="location" required value="{{ $user->location }}"
                                        placeholder="Location">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputnumber">Contact Number</label>
                                    <input type="text" class="form-control" id="exampleInputnumber"  name="phone" required value="{{ $user->phone }}"
                                        placeholder="Contact number">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">About Me</label>
                                    <textarea class="form-control" rows="6"  name="about_me" required >{{ $user->about_me }}</textarea>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="reset" class="btn btn-secondary my-1">Reset</button>
                                <button type="submit" class="btn btn-success my-1">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- ROW-1 CLOSED -->
            </div>
            <!--CONTAINER CLOSED -->

        </div>
    </div>
    <!--app-content open-->

    <style>
        .imagePreviewWrapper {
            width: 100%;
            height: 250px;
            display: block;
            cursor: pointer;
            margin: 0 auto 30px;
            background-size: cover;
            background-position: center center;
        }
    </style>
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(e) {


        $('#image').change(function() {

            let reader = new FileReader();

            reader.onload = (e) => {

                $('#preview-image-before-upload').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

        });

    });
    $(document).ready(function(e) {


        $('#menu').change(function() {

            let reader = new FileReader();

            reader.onload = (e) => {

                $('#menuPreview').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

        });

    });
</script>
