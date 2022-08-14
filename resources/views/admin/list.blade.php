@extends('layouts.user')
@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Admin</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Admin</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 OPEN -->
                <!-- Row -->
                <div class="row ">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add a new Admin</h3>
                            </div>
                            <div class="card-body">
                                <form method="post" action="/create-user">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-xl-6 mb-3">
                                            <label for="validationDefault01">Name</label>
                                            <input type="text" class="form-control" id="validationDefault01"
                                                name="name" required>
                                        </div>
                                        <div class="col-xl-6 mb-3">
                                            <label for="validationDefault02">Email</label>
                                            <input type="email" class="form-control" id="validationDefault02"
                                                name="email" required>
                                        </div>
                                    </div>
                                    <input type="text" name="role_id" value="1" hidden>
                                    <div class="form-row justify-content-space-between">
                                        <div class="col-xl-6 mb-3">
                                            <button class="btn btn-secondary" type="reset">Reset form</button>
                                        </div>
                                        <div class="col-xl-6 mb-3">
                                            <button class="btn btn-primary" type="submit">Submit form</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Row -->


                <!-- Row -->
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Admin user list</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="file-datatable"
                                        class="table table-bordered text-nowrap key-buttons border-bottom">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">ID</th>
                                                <th class="border-bottom-0">image</th>
                                                <th class="border-bottom-0">name</th>
                                                <th class="border-bottom-0">email</th>
                                                <th class="border-bottom-0">Phone</th>
                                                <th class="border-bottom-0">Location</th>
                                                <th class="border-bottom-0">created</th>
                                                <th class="border-bottom-0">status</th>
                                                <th class="border-bottom-0">action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($admins as $user)
                                                <tr class="border-bottom">
                                                    <td class="text-center">
                                                        <div class="mt-0 mt-sm-2 d-block">
                                                            <h6 class="mb-0 fs-14 fw-semibold">
                                                                {{ $user->id }}</h6>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            @if ($user->image == null)
                                                                <span class="avatar bradius"
                                                                    style="background-image: url(../assets/images/orders/12.jpg)"></span>
                                                            @else
                                                                <span class="avatar bradius"
                                                                    style="background-image: url(../assets/images/orders/12.jpg)"></span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="mt-0 mt-sm-2 d-block">
                                                            <h6 class="mb-0 fs-14 fw-semibold">
                                                                {{ $user->name }}</h6>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="mt-0 mt-sm-3 d-block">
                                                                <h6 class="mb-0 fs-14 fw-semibold">
                                                                    {{ $user->email }}</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="mt-sm-2 d-block">{{ $user->phone }}</span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="fw-semibold mt-sm-2 d-block">{{ $user->location }}</span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="fw-semibold mt-sm-2 d-block">{{ $user->created_at }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="mt-sm-1 d-block">
                                                            @if ($user->status == 'active')
                                                                <span
                                                                    class="badge bg-success-transparent rounded-pill text-success p-2 px-3">active</span>
                                                            @else
                                                                <span
                                                                    class="badge bg-danger-transparent rounded-pill text-danger p-2 px-3">inactive</span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="g-2">
                                                            @if ($user->status == 'active')
                                                                <a class="btn text-primary btn-sm" data-bs-toggle="tooltip" href="/user-suspend/{{ $user->id }}"
                                                                    data-bs-original-title="Suspend"><span
                                                                        class="fe fe-alert-circle fs-14"></span></a>
                                                            @else
                                                                <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"  href="/user-activate/{{ $user->id }}"
                                                                    data-bs-original-title="Activate"><span
                                                                        class="fe fe-check fs-14"></span></a>
                                                            @endif
                                                            <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                                                href="/user-view/{{ $user->id }}"
                                                                data-bs-original-title="View"><span
                                                                    class="fe fe-eye fs-14"></span></a>
                                                            <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"  href="/user-delete/{{ $user->id }}"
                                                                data-bs-original-title="Delete"><span
                                                                    class="fe fe-trash-2 fs-14"></span></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Row -->
            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!--app-content closed-->
@endsection
