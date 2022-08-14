@extends('layouts.user')
@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Peer Conference</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Peer Conference</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->


                <!-- Row -->
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All active users</h3>
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
                                                <th class="border-bottom-0">Role</th>
                                                <th class="border-bottom-0">programe</th>
                                                <th class="border-bottom-0">action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr class="border-bottom">
                                                    <form action="/create-peer" method="post">
                                                        @csrf
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
                                                            <span
                                                                class="fw-semibold mt-sm-2 d-block">{{ $user['role']->name }}</span>
                                                        </td>
                                                        <td>
                                                            <input type="datetime-local" class="form-control w-100"
                                                                name="programed" />
                                                        </td>
                                                        <td>
                                                            <div class="g-2">
                                                                <input type="text" name="receiver_id"
                                                                    value="{{ $user->id }}" hidden>
                                                                <button type="submit" class="btn text-primary btn-sm"
                                                                    data-bs-toggle="tooltip"
                                                                    data-bs-original-title="Create Room"><span
                                                                        class="fe fe-play fs-14"></span></button>
                                                            </div>
                                                        </td>

                                                    </form>
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



                <!-- Row -->
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">

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
