
@extends('layouts.user')
@section('content')

            <!--app-content open-->
            <div class="main-content app-content mt-0">
                <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        <!-- PAGE-HEADER -->
                        <div class="page-header">
                            <h1 class="page-title">Dashboard 01</h1>
                            <div>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard 01</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <!-- ROW-1 -->
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                        <div class="card overflow-hidden">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="mt-2">
                                                        <h6 class="">Total Users</h6>
                                                        <h2 class="mb-0 number-font">44,278</h2>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="chart-wrapper mt-1">
                                                            <canvas id="saleschart"
                                                                class="h-8 w-9 chart-dropshadow"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="text-muted fs-12"><span class="text-secondary"><i
                                                            class="fe fe-arrow-up-circle  text-secondary"></i> 5%</span>
                                                    Last week</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                        <div class="card overflow-hidden">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="mt-2">
                                                        <h6 class="">Total Profit</h6>
                                                        <h2 class="mb-0 number-font">67,987</h2>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="chart-wrapper mt-1">
                                                            <canvas id="leadschart"
                                                                class="h-8 w-9 chart-dropshadow"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="text-muted fs-12"><span class="text-pink"><i
                                                            class="fe fe-arrow-down-circle text-pink"></i> 0.75%</span>
                                                    Last 6 days</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                        <div class="card overflow-hidden">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="mt-2">
                                                        <h6 class="">Total Expenses</h6>
                                                        <h2 class="mb-0 number-font">$76,965</h2>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="chart-wrapper mt-1">
                                                            <canvas id="profitchart"
                                                                class="h-8 w-9 chart-dropshadow"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="text-muted fs-12"><span class="text-green"><i
                                                            class="fe fe-arrow-up-circle text-green"></i> 0.9%</span>
                                                    Last 9 days</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                        <div class="card overflow-hidden">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="mt-2">
                                                        <h6 class="">Total Cost</h6>
                                                        <h2 class="mb-0 number-font">$59,765</h2>
                                                    </div>
                                                    <div class="ms-auto">
                                                        <div class="chart-wrapper mt-1">
                                                            <canvas id="costchart"
                                                                class="h-8 w-9 chart-dropshadow"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="text-muted fs-12"><span class="text-warning"><i
                                                            class="fe fe-arrow-up-circle text-warning"></i> 0.6%</span>
                                                    Last year</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ROW-1 END -->

                        <!-- ROW-2 -->
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Sales Analytics</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex mx-auto text-center justify-content-center mb-4">
                                            <div class="d-flex text-center justify-content-center me-3"><span
                                                    class="dot-label bg-primary my-auto"></span>Total Sales</div>
                                            <div class="d-flex text-center justify-content-center"><span
                                                    class="dot-label bg-secondary my-auto"></span>Total Orders</div>
                                        </div>
                                        <div class="chartjs-wrapper-demo">
                                            <canvas id="transactions" class="chart-dropshadow"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- COL END -->
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3">
                                <div class="card overflow-hidden">
                                    <div class="card-body pb-0 bg-recentorder">
                                        <h3 class="card-title text-white">Recent Orders</h3>
                                        <div class="chartjs-wrapper-demo">
                                            <canvas id="recentorders" class="chart-dropshadow"></canvas>
                                        </div>
                                    </div>
                                    <div id="flotback-chart" class="flot-background"></div>
                                    <div class="card-body">
                                        <div class="d-flex mb-4 mt-3">
                                            <div
                                                class="avatar avatar-md bg-secondary-transparent text-secondary bradius me-3">
                                                <i class="fe fe-check"></i>
                                            </div>
                                            <div class="">
                                                <h6 class="mb-1 fw-semibold">Delivered Orders</h6>
                                                <p class="fw-normal fs-12"> <span class="text-success">3.5%</span>
                                                    increased </p>
                                            </div>
                                            <div class=" ms-auto my-auto">
                                                <p class="fw-bold fs-20"> 1,768 </p>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="avatar  avatar-md bg-pink-transparent text-pink bradius me-3">
                                                <i class="fe fe-x"></i>
                                            </div>
                                            <div class="">
                                                <h6 class="mb-1 fw-semibold">Cancelled Orders</h6>
                                                <p class="fw-normal fs-12"> <span class="text-success">1.2%</span>
                                                    increased </p>
                                            </div>
                                            <div class=" ms-auto my-auto">
                                                <p class="fw-bold fs-20 mb-0"> 3,675 </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- COL END -->
                        </div>
                        <!-- ROW-2 END -->


                <!-- Row -->
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">User list</h3>
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
                                                <th class="border-bottom-0">Role</th>
                                                <th class="border-bottom-0">created</th>
                                                <th class="border-bottom-0">status</th>
                                                <th class="border-bottom-0">action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($users as $user)
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
                                                        <span class="fw-semibold mt-sm-2 d-block">{{ $user['role']->name }}</span>
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
                                                                href="/user-profile/{{ $user->id }}"
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
                    <!-- CONTAINER END -->
                </div>
            </div>
            <!--app-content close-->

@endsection
