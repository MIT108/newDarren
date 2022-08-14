@extends('layouts.user')
@section('content')

    {{-- modal --}}


    <!-- MODAL EFFECTS -->

    @foreach ($task['user_task'] as $user)
        <div class="modal fade" id="user{{ $user['user']->id }}">
            <div class="modal-dialog modal-dialog-centered text-center" role="document">
                <div class="modal-content modal-content-demo">
                    <form method="post" action="#">
                        @csrf
                        <div class="modal-header">
                            <h6 class="modal-title">Give a mark to {{ $user['user']->name }}</h6><button aria-label="Close"
                                class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">

                            <div class="row">

                                <div class="col-12">
                                    <input type="number" max="10" min="0" class="form-control w-100"
                                        name="{{ $user['user']->id }}" required>

                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add</button> <button class="btn btn-light"
                                data-bs-dismiss="modal">Close</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    @endforeach


    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <h1 class="page-title">Task</h1>
                    <div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Task</li>
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
                                <h3 class="card-title">Task Informations</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-xl-6 mb-3">
                                        <h3>Name:</h3>
                                        {{ $task->name }}
                                    </div>
                                    <div class="col-xl-6 mb-3">
                                        <h3>Created Date:</h3>
                                        {{ $task->created_at }}
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-xl-6 mb-3">
                                        <h3>Start Date:</h3>
                                        {{ $task->startDate }}
                                    </div>
                                    <div class="col-xl-6 mb-3">
                                        <h3>End Date:</h3>
                                        {{ $task->endDate }}
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-xl-6 mb-3">
                                        <h3>Creator Name:</h3>
                                        {{ $task['user']->name }}
                                    </div>
                                    <div class="col-xl-6 mb-3">
                                        <h3>Creator Email:</h3>
                                        {{ $task['user']->email }} ... <a href="/user-view/{{ $task['user']->id }}">view
                                            creator
                                            informations</a>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-xl-6 mb-3">
                                        <h3>Description:</h3>
                                        {{ $task->description }}
                                    </div>
                                    <div class="col-xl-6 mb-3">
                                        <h5>Status:</h5>
                                        @if ($task->status == 'active')
                                            <span
                                                class="badge bg-success-transparent rounded-pill text-success p-2 px-3">active</span>
                                        @else
                                            <span
                                                class="badge bg-danger-transparent rounded-pill text-danger p-2 px-3">{{ $task->status }}</span>
                                        @endif

                                        <a class="btn text-primary btn-sm" data-bs-toggle="tooltip"
                                            href="{{ $task->pdf }}" download data-bs-original-title="Download"><span
                                                class="fe fe-download fs-14"></span></a>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-xl-12 mb-3">
                                        <h3>Progress:</h3>

                                        <div class="example">
                                            <div class="progress progress-md mb-3">
                                                <div class="progress-bar bg-pink" style="width: 10%;"> 7%</div>
                                            </div>
                                            <div class="progress progress-md mb-3">
                                                <div class="progress-bar bg-green" style="width: 20%;">20%</div>
                                            </div>
                                            <div class="progress progress-md mb-3">
                                                <div class="progress-bar bg-yellow" style="width: 40%;">40%</div>
                                            </div>
                                            <div class="progress progress-md mb-3">
                                                <div class="progress-bar bg-blue" style="width: 60%;">60%</div>
                                            </div>
                                            <div class="progress progress-md ">
                                                <div class="progress-bar bg-orange" style="width: 80%;"> 80%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Row -->


                    <div class="col-lg-12 col-md-12">
                        <div class="card">

                            <div class="card-body">
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default active">
                                        <div class="panel-heading " role="tab" id="headingOne1">
                                            <h4 class="panel-title">
                                                <a role="button" data-bs-toggle="collapse" data-bs-parent="#accordion"
                                                    href="#collapse1" aria-expanded="true" aria-controls="collapse1">

                                                    <h3 class="card-title mr-5">Department Personnel</h3> &nbsp; &nbsp;
                                                    &nbsp;
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse1" class="panel-collapse collapse" role="tabpanel"
                                            aria-labelledby="headingOne1">
                                            <div class="panel-body">

                                                <div class="card">

                                                    <form action="/remove-personnel-task/{{ $task->id }}"
                                                        method="post">
                                                        @csrf
                                                        <div class="card-header">
                                                            <button type="submit" class="btn btn-primary">Remove
                                                                selected</button>
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
                                                                            <th class="border-bottom-0">mark</th>
                                                                            <th class="border-bottom-0">status</th>
                                                                            <th class="border-bottom-0">Role</th>
                                                                            <th class="border-bottom-0">action</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <tbody>
                                                                        @foreach ($task['user_task'] as $user)
                                                                            <tr class="border-bottom">
                                                                                <td class="text-center">
                                                                                    <div class="mt-0 mt-sm-2 d-block">
                                                                                        <h6 class="mb-0 fs-14 fw-semibold">
                                                                                            {{ $user['user']->id }}
                                                                                        </h6>
                                                                                    </div>
                                                                                </td>

                                                                                <td>
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input"
                                                                                            type="checkbox" value="1"
                                                                                            id="{{ $user['user']->id }}"
                                                                                            name="{{ $user['user']->id }}">
                                                                                        <label class="form-check-label"
                                                                                            for="{{ $user['user']->id }}">Check</label>
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
                                                                                            <h6
                                                                                                class="mb-0 fs-14 fw-semibold">
                                                                                                @if ($user->mark != null)
                                                                                                    @if ($user->mark >= 5)
                                                                                                        <span
                                                                                                            class="badge bg-success-transparent rounded-pill text-success p-2 px-3">{{ $user->mark }}</span>
                                                                                                    @else
                                                                                                        <span
                                                                                                            class="badge bg-danger-transparent rounded-pill text-danger p-2 px-3">{{ $user->mark }}</span>
                                                                                                    @endif
                                                                                                @else
                                                                                                    <a class="modal-effect btn btn-primary-light d-grid mb-3"
                                                                                                        data-bs-effect="effect-scale"
                                                                                                        data-bs-toggle="modal"
                                                                                                        href="#user{{ $user['user']->id }}">Give
                                                                                                        Mark</a>
                                                                                                @endif
                                                                                            </h6>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="d-flex">
                                                                                        <div class="mt-0 mt-sm-3 d-block">
                                                                                            <h6
                                                                                                class="mb-0 fs-14 fw-semibold">
                                                                                                @if ($user->status == 1)
                                                                                                    <span
                                                                                                        class="badge bg-success-transparent rounded-pill text-success p-2 px-3">finished</span>
                                                                                                @else
                                                                                                    <span
                                                                                                        class="badge bg-danger-transparent rounded-pill text-danger p-2 px-3">still
                                                                                                        working</span>
                                                                                                @endif
                                                                                            </h6>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="d-flex">
                                                                                        <div class="mt-0 mt-sm-3 d-block">
                                                                                            <h6
                                                                                                class="mb-0 fs-14 fw-semibold">

                                                                                                {{ $user['user']['role']->name }}
                                                                                            </h6>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="g-2">
                                                                                        <a class="btn text-primary btn-sm"
                                                                                            data-bs-toggle="tooltip"
                                                                                            href="/user-view/{{ $user['user']->id }}"
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
                                    </div>

                                    @if (Auth::user()->id == $task->user_id)
                                        <div class="panel panel-default active mt-5">
                                            <div class="panel-heading " role="tab" id="headingOne1">
                                                <h4 class="panel-title">
                                                    <a role="button" data-bs-toggle="collapse"
                                                        data-bs-parent="#accordion" href="#collapse2"
                                                        aria-expanded="true" aria-controls="collapse2">

                                                        User list
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse2" class="panel-collapse collapse" role="tabpanel"
                                                aria-labelledby="headingOne1">
                                                <div class="panel-body">

                                                    <div class="card">

                                                        <form action="/add-personnel-task/{{ $task->id }}"
                                                            method="post">

                                                            @csrf
                                                            <div class="card-header">

                                                                <button type="submit" class="btn btn-primary">Add
                                                                    selected</button>
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
                                                                                            <h6
                                                                                                class="mb-0 fs-14 fw-semibold">
                                                                                                {{ $personnel->id }}
                                                                                            </h6>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input"
                                                                                                type="checkbox"
                                                                                                value="1"
                                                                                                id="{{ $personnel->id }}"
                                                                                                name="{{ $personnel->id }}">
                                                                                            <label class="form-check-label"
                                                                                                for="{{ $personnel->id }}">Check</label>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        <div class="mt-0 mt-sm-2 d-block">
                                                                                            <h6
                                                                                                class="mb-0 fs-14 fw-semibold">
                                                                                                {{ $personnel->name }}</h6>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="d-flex">
                                                                                            <div
                                                                                                class="mt-0 mt-sm-3 d-block">
                                                                                                <h6
                                                                                                    class="mb-0 fs-14 fw-semibold">
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
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Row -->

                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!--app-content closed-->
    @endsection
