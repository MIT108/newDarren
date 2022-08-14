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
                                <h3 class="card-title">Conference Informations</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-xl-6 mb-3">
                                        <h3>Name:</h3>
                                        {{ $conference->name }}
                                    </div>
                                    <div class="col-xl-6 mb-3">
                                        <h3>Date:</h3>
                                        @if ($conference->programed == null)
                                            ---
                                        @else
                                            {{ date('Y-m-d H:i', (int) $conference->programed) }}
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-xl-6 mb-3">
                                        <h3>Creator Name:</h3>
                                        {{ $creator->name }}
                                    </div>
                                    <div class="col-xl-6 mb-3">
                                        <h3>Creator Email:</h3>
                                        {{ $creator->email }} ... <a href="/user-view/{{ $creator->id }}">view creator
                                            informations</a>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-xl-12 mb-3">
                                        <h3>Description:</h3>
                                        {{ $conference->description }}
                                    </div>
                                </div>

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
                                <h3 class="card-title">Conference User List</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="file-datatable"
                                        class="table table-bordered text-nowrap key-buttons border-bottom">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">ID</th>
                                                <th class="border-bottom-0">name</th>
                                                <th class="border-bottom-0">email</th>
                                                <th class="border-bottom-0">action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr class="border-bottom">
                                                    <td class="text-center">
                                                        <div class="mt-0 mt-sm-2 d-block">
                                                            <h6 class="mb-0 fs-14 fw-semibold">{{ $user['user']->id }}</h6>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="mt-0 mt-sm-2 d-block">
                                                            <h6 class="mb-0 fs-14 fw-semibold">
                                                                {{ $user['user']->name }}</h6>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="mt-0 mt-sm-3 d-block">
                                                                <h6 class="mb-0 fs-14 fw-semibold">
                                                                    {{ $user['user']->email }}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="g-2">
                                                            <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                                                href="/user-view/{{ $user['user']->id }}"
                                                                data-bs-original-title="View"><span
                                                                    class="fe fe-eye fs-14"></span></a>
                                                            <a class="btn text-danger btn-sm" data-bs-toggle="tooltip"
                                                                href="/delete-users-conference/{{ $user['conference']->id }}/{{ $user['user']->id }}"
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



                <!-- Row -->
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">

                            <form action="/add-users-conference/{{ $conference->id }}" method="post">

                                @csrf
                                <div class="card-header">

                                    <button type="submit" class="btn btn-primary">Add selected</button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="basic-datatable"
                                            class="table table-bordered text-nowrap key-buttons border-bottom">
                                            <thead>
                                                <tr>
                                                    <th class="border-bottom-0">ID</th>
                                                    <th class="border-bottom-0">checkBox</th>
                                                    <th class="border-bottom-0">name</th>
                                                    <th class="border-bottom-0">email</th>
                                                    <th class="border-bottom-0">action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($notUsers as $notUser)
                                                    <tr class="border-bottom">
                                                        <td class="text-center">
                                                            <div class="mt-0 mt-sm-2 d-block">
                                                                <h6 class="mb-0 fs-14 fw-semibold">{{ $notUser->id }}</h6>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                value="1" id="{{ $notUser->id }}" name="{{ $notUser->id }}" >
                                                                <label class="form-check-label"
                                                                    for="{{ $notUser->id }}">Check</label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="mt-0 mt-sm-2 d-block">
                                                                <h6 class="mb-0 fs-14 fw-semibold">
                                                                    {{ $notUser->name }}</h6>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <div class="mt-0 mt-sm-3 d-block">
                                                                    <h6 class="mb-0 fs-14 fw-semibold">
                                                                        {{ $notUser->email }}
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="g-2">
                                                                <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                                                    href="/user-view/{{ $notUser->id }}"
                                                                    data-bs-original-title="View"><span
                                                                        class="fe fe-eye fs-14"></span></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </form>
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
