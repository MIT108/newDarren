@extends('layouts.user')
@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Department</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Department</li>
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
                                <h3 class="card-title">Department Informations</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-xl-6 mb-3">
                                        <h3>Name:</h3>
                                        {{ $department->name }}
                                    </div>
                                    <div class="col-xl-6 mb-3">
                                        <h3>Created Date:</h3>
                                        {{ $department->created_at }}
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-xl-6 mb-3">
                                        <h3>Head of Service Name:</h3>
                                        {{ $department['user'][0]->name }}
                                    </div>
                                    <div class="col-xl-6 mb-3">
                                        <h3>Head of Service Email:</h3>
                                        {{ $department['user'][0]->email }} ... <a
                                            href="/user-view/{{ $department['user'][0]->id }}">view HOS
                                            informations</a>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-xl-6 mb-3">
                                        <h3>Description:</h3>
                                        {{ $department->description }}
                                    </div>
                                    <div class="col-xl-6 mb-3">
                                        <h5>Status:</h5>
                                        @if ($department->status == 'active')
                                            <span
                                                class="badge bg-success-transparent rounded-pill text-success p-2 px-3">active</span>
                                        @else
                                            <span
                                                class="badge bg-danger-transparent rounded-pill text-danger p-2 px-3">inactive</span>
                                        @endif
                                    </div>
                                    <div class="form-row">
                                        <div class="col-xl-12 mb-3">
                                            <h3>Meeting:</h3>
                                            <button class="btn btn-primary">Start a Metting</button>
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

                            <form action="/remove-personnel-department/{{ $department->id }}" method="post">
                                @csrf
                                <div class="card-header">
                                    <h3 class="card-title mr-5">Department Personnel</h3> &nbsp; &nbsp; &nbsp;
                                    @if (Auth::user()->role_id == 3)
                                    <button type="submit" class="btn btn-primary">Remove selected</button>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="file-datatable"
                                            class="table table-bordered text-nowrap key-buttons border-bottom">
                                            <thead>
                                                <tr>
                                                    <th class="border-bottom-0">ID</th>
                                                    <th class="border-bottom-0">CheckBox</th>
                                                    <th class="border-bottom-0">name</th>
                                                    <th class="border-bottom-0">email</th>
                                                    <th class="border-bottom-0">Role</th>
                                                    <th class="border-bottom-0">action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($department['user'] as $user)
                                                    <tr class="border-bottom">
                                                        <td class="text-center">
                                                            <div class="mt-0 mt-sm-2 d-block">
                                                                <h6 class="mb-0 fs-14 fw-semibold">{{ $user->id }}</h6>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            @if ($user->role_id == 4)
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="1" id="{{ $user->id }}"
                                                                        name="{{ $user->id }}">
                                                                    <label class="form-check-label"
                                                                        for="{{ $user->id }}">Check</label>
                                                                </div>
                                                            @endif
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
                                                                        {{ $user->email }}
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <div class="mt-0 mt-sm-3 d-block">
                                                                    <h6 class="mb-0 fs-14 fw-semibold">
                                                                        @if ($user->role_id == 3)
                                                                            HOS
                                                                        @else
                                                                            Personnel
                                                                        @endif
                                                                    </h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="g-2">
                                                                <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                                                    href="/user-view/{{ $user->id }}"
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



                <!-- Row -->
                @if (Auth::user()->role_id == 3)
                    <div class="row row-sm">
                        <div class="col-lg-12">
                            <div class="card">

                                <form action="/add-personnel-department/{{ $department->id }}" method="post">

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
                                                    @foreach ($personnels as $personnel)
                                                        <tr class="border-bottom">
                                                            <td class="text-center">
                                                                <div class="mt-0 mt-sm-2 d-block">
                                                                    <h6 class="mb-0 fs-14 fw-semibold">{{ $personnel->id }}
                                                                    </h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="1" id="{{ $personnel->id }}"
                                                                        name="{{ $personnel->id }}">
                                                                    <label class="form-check-label"
                                                                        for="{{ $personnel->id }}">Check</label>
                                                                </div>
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="mt-0 mt-sm-2 d-block">
                                                                    <h6 class="mb-0 fs-14 fw-semibold">
                                                                        {{ $personnel->name }}</h6>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <div class="mt-0 mt-sm-3 d-block">
                                                                        <h6 class="mb-0 fs-14 fw-semibold">
                                                                            {{ $personnel->email }}
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="g-2">
                                                                    <a class="btn text-primary btn-sm"
                                                                        data-bs-toggle="tooltip"
                                                                        href="/user-view/{{ $personnel->id }}"
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
                @endif
                <!-- End Row -->
            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!--app-content closed-->
@endsection
