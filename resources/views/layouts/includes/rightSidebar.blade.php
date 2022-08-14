@php
$peers = App\Http\Controllers\PeerController::getPeerRoomNotification();
$conference = App\Http\Controllers\ConferenceController::getConferenceRoomNotification();
$incoming = $peers['incoming'];
$outgoing = $peers['outgoing'];
$incomingConference = $conference['incomingConference'];
$outgoingConference = $conference['outgoingConference'];
@endphp

<!-- Sidebar-right -->
<div class="sidebar sidebar-right sidebar-animate">
    <div class="panel panel-primary card mb-0 shadow-none border-0">
        <div class="tab-menu-heading border-0 d-flex p-3">
            <div class="card-title mb-0"><i class="fe fe-bell me-2"></i><span class=" pulse"></span>Notifications</div>
            <div class="card-options ms-auto">
                <a href="javascript:void(0);" class="sidebar-icon text-end float-end me-3 mb-1"
                    data-bs-toggle="sidebar-right" data-target=".sidebar-right"><i class="fe fe-x text-white"></i></a>
            </div>
        </div>
        <div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
            <div class="tabs-menu border-bottom">
                <!-- Tabs -->
                <ul class="nav panel-tabs">
                    <li class=""><a href="#side1" class="active" data-bs-toggle="tab"><i
                                class="fe fe-play me-1"></i>Peers</a></li>
                    <li><a href="#side2" data-bs-toggle="tab"><i class="fe fe-message-circle"></i> Chat</a></li>
                    <li><a href="#side3" data-bs-toggle="tab"><i class="fe fe-anchor me-1"></i>Timeline</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="side1">
                    <div class="p-3 fw-semibold ps-5">Incoming</div>
                    <div class="card-body pt-2">
                        <div class="browser-stats">
                            @foreach ($incoming as $in)
                                <div class="row mb-4">
                                    <div class="col-sm-2 mb-sm-0 mb-3">
                                        @if ((int) $in->programed > strtotime(\Carbon\Carbon::now()))
                                            <span
                                                class="feeds avatar-circle avatar-circle-success brround bg-success-transparent"><i
                                                    class="fe fe-bell text-success"></i></span>
                                        @else
                                            <span
                                                class="feeds avatar-circle avatar-circle-danger brround bg-danger-transparent"><i
                                                    class="fe fe-bell text-danger"></i></span>
                                        @endif
                                    </div>
                                    <div class="col-sm-10 ps-sm-0">
                                        <div class="d-flex align-items-end justify-content-between ms-2">
                                            @if ($in->programed == null)
                                                <h6 class="">Open meeting <br /> with: {{ $in->sender_name }}</h6>
                                            @else
                                                <h6 class="">{{ $in->sender_name }}<br /> at:
                                                    {{ date('Y-m-d H:i', (int) $in->programed) }}</h6>
                                            @endif
                                            <div>
                                                @if ((int) $in->programed <= strtotime(\Carbon\Carbon::now()))
                                                    <a href="/peer-video/1/{{ $in->id }}"><i
                                                            class="fe fe-play me-1"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="p-3 fw-semibold ps-5">Outgoing</div>
                    <div class="card-body pt-2">
                        <div class="browser-stats">
                            @foreach ($outgoing as $in)
                                <div class="row mb-4">
                                    <div class="col-sm-2 mb-sm-0 mb-3">
                                        @if ((int) $in->programed > strtotime(\Carbon\Carbon::now()))
                                            <span
                                                class="feeds avatar-circle avatar-circle-success brround bg-success-transparent"><i
                                                    class="fe fe-bell text-success"></i></span>
                                        @else
                                            <span
                                                class="feeds avatar-circle avatar-circle-danger brround bg-danger-transparent"><i
                                                    class="fe fe-bell text-danger"></i></span>
                                        @endif
                                    </div>
                                    <div class="col-sm-10 ps-sm-0">
                                        <div class="d-flex align-items-end justify-content-between ms-2">
                                            @if ($in->programed == null)
                                                <h6 class="">Open meeting <br /> with: {{ $in->receiver_name }}
                                                </h6>
                                            @else
                                                <h6 class="">{{ $in->receiver_name }}<br /> at:
                                                    {{ date('Y-m-d H:i', (int) $in->programed) }}</h6>
                                            @endif
                                            <div>
                                                @if ((int) $in->programed <= strtotime(\Carbon\Carbon::now()))
                                                    <a href="/peer-video/1/{{ $in->id }}"><i
                                                            class="fe fe-play me-1"></i></a>
                                                @endif
                                                <a href="/delete-peer/{{ $in->id }}"><i class="fe fe-x me-1"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="side2">
                    <div class="list-group list-group-flush">
                        <div class="pt-3 fw-semibold ps-5">Today</div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-md brround cover-image"
                                    data-bs-image-src="../assets/images/users/2.jpg"></span>
                            </div>
                            <div class="">
                                <a href="chat.html">
                                    <div class="fw-semibold text-dark" data-bs-toggle="modal" data-target="#chatmodel">
                                        Addie Minstra</div>
                                    <p class="mb-0 fs-12 text-muted"> Hey! there I' am available.... </p>
                                </a>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-md brround cover-image"
                                    data-bs-image-src="../assets/images/users/11.jpg"><span
                                        class="avatar-status bg-success"></span></span>
                            </div>
                            <div class="">
                                <a href="chat.html">
                                    <div class="fw-semibold text-dark" data-bs-toggle="modal" data-target="#chatmodel">
                                        Rose Bush</div>
                                    <p class="mb-0 fs-12 text-muted"> Okay...I will be waiting for you </p>
                                </a>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-md brround cover-image"
                                    data-bs-image-src="../assets/images/users/10.jpg"></span>
                            </div>
                            <div class="">
                                <a href="chat.html">
                                    <div class="fw-semibold text-dark" data-bs-toggle="modal" data-target="#chatmodel">
                                        Claude Strophobia</div>
                                    <p class="mb-0 fs-12 text-muted"> Hi we can explain our new project......
                                    </p>
                                </a>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-md brround cover-image"
                                    data-bs-image-src="../assets/images/users/13.jpg"></span>
                            </div>
                            <div class="">
                                <a href="chat.html">
                                    <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                        data-target="#chatmodel">Eileen Dover</div>
                                    <p class="mb-0 fs-12 text-muted"> New product Launching... </p>
                                </a>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-md brround cover-image"
                                    data-bs-image-src="../assets/images/users/12.jpg"><span
                                        class="avatar-status bg-success"></span></span>
                            </div>
                            <div class="">
                                <a href="chat.html">
                                    <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                        data-target="#chatmodel">Willie Findit</div>
                                    <p class="mb-0 fs-12 text-muted"> Okay...I will be waiting for you </p>
                                </a>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-md brround cover-image"
                                    data-bs-image-src="../assets/images/users/15.jpg"></span>
                            </div>
                            <div class="">
                                <a href="chat.html">
                                    <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                        data-target="#chatmodel">Manny Jah</div>
                                    <p class="mb-0 fs-12 text-muted"> Hi we can explain our new project......
                                    </p>
                                </a>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-md brround cover-image"
                                    data-bs-image-src="../assets/images/users/4.jpg"></span>
                            </div>
                            <div class="">
                                <a href="chat.html">
                                    <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                        data-target="#chatmodel">Cherry Blossom</div>
                                    <p class="mb-0 fs-12 text-muted"> Hey! there I' am available....</p>
                                </a>
                            </div>
                        </div>
                        <div class="pt-3 fw-semibold ps-5">Yesterday</div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-md brround cover-image"
                                    data-bs-image-src="../assets/images/users/7.jpg"><span
                                        class="avatar-status bg-success"></span></span>
                            </div>
                            <div class="">
                                <a href="chat.html">
                                    <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                        data-target="#chatmodel">Simon Sais</div>
                                    <p class="mb-0 fs-12 text-muted">Schedule Realease...... </p>
                                </a>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-md brround cover-image"
                                    data-bs-image-src="../assets/images/users/9.jpg"></span>
                            </div>
                            <div class="">
                                <a href="chat.html">
                                    <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                        data-target="#chatmodel">Laura Biding</div>
                                    <p class="mb-0 fs-12 text-muted"> Hi we can explain our new project......
                                    </p>
                                </a>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-md brround cover-image"
                                    data-bs-image-src="../assets/images/users/2.jpg"><span
                                        class="avatar-status bg-success"></span></span>
                            </div>
                            <div class="">
                                <a href="chat.html">
                                    <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                        data-target="#chatmodel">Addie Minstra</div>
                                    <p class="mb-0 fs-12 text-muted">Contact me for details....</p>
                                </a>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-md brround cover-image"
                                    data-bs-image-src="../assets/images/users/9.jpg"></span>
                            </div>
                            <div class="">
                                <a href="chat.html">
                                    <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                        data-target="#chatmodel">Ivan Notheridiya</div>
                                    <p class="mb-0 fs-12 text-muted"> Hi we can explain our new project......
                                    </p>
                                </a>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-md brround cover-image"
                                    data-bs-image-src="../assets/images/users/14.jpg"></span>
                            </div>
                            <div class="">
                                <a href="chat.html">
                                    <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                        data-target="#chatmodel">Dulcie Veeta</div>
                                    <p class="mb-0 fs-12 text-muted"> Okay...I will be waiting for you </p>
                                </a>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-md brround cover-image"
                                    data-bs-image-src="../assets/images/users/11.jpg"></span>
                            </div>
                            <div class="">
                                <a href="chat.html">
                                    <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                        data-target="#chatmodel">Florinda Carasco</div>
                                    <p class="mb-0 fs-12 text-muted">New product Launching...</p>
                                </a>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <div class="me-2">
                                <span class="avatar avatar-md brround cover-image"
                                    data-bs-image-src="../assets/images/users/4.jpg"><span
                                        class="avatar-status bg-success"></span></span>
                            </div>
                            <div class="">
                                <a href="chat.html">
                                    <div class="fw-semibold text-dark" data-bs-toggle="modal"
                                        data-target="#chatmodel">Cherry Blossom</div>
                                    <p class="mb-0 fs-12 text-muted">cherryblossom@gmail.com</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="side3">

                    <div class="p-3 fw-semibold ps-5">Incoming</div>
                    <div class="card-body pt-2">
                        <div class="browser-stats">
                            @foreach ($incomingConference as $in)
                                <div class="row mb-4">
                                    <div class="col-sm-2 mb-sm-0 mb-3">
                                        @if ((int) $in->programed > strtotime(\Carbon\Carbon::now()))
                                            <span
                                                class="feeds avatar-circle avatar-circle-success brround bg-success-transparent"><i
                                                    class="fe fe-bell text-success"></i></span>
                                        @else
                                            <span
                                                class="feeds avatar-circle avatar-circle-danger brround bg-danger-transparent"><i
                                                    class="fe fe-bell text-danger"></i></span>
                                        @endif
                                    </div>
                                    <div class="col-sm-10 ps-sm-0">
                                        <div class="d-flex align-items-end justify-content-between ms-2">
                                            @if ($in->programed == null)
                                                <h6 class="">Open meeting <br /> with: {{ $in->sender_name }}</h6>
                                            @else
                                                <h6 class="">{{ $in->sender_name }}<br /> at:
                                                    {{ date('Y-m-d H:i', (int) $in->programed) }}</h6>
                                            @endif
                                            <div>
                                                @if ((int) $in->programed <= strtotime(\Carbon\Carbon::now()))
                                                    <a href="/peer-video/2/{{ $in->id }}"><i
                                                            class="fe fe-play me-1"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="p-3 fw-semibold ps-5">Outgoing</div>
                    <div class="card-body pt-2">
                        <div class="browser-stats">
                            @foreach ($outgoingConference as $in)
                                <div class="row mb-4">
                                    <div class="col-sm-2 mb-sm-0 mb-3">
                                        @if ((int) $in->programed > strtotime(\Carbon\Carbon::now()))
                                            <span
                                                class="feeds avatar-circle avatar-circle-success brround bg-success-transparent"><i
                                                    class="fe fe-bell text-success"></i></span>
                                        @else
                                            <span
                                                class="feeds avatar-circle avatar-circle-danger brround bg-danger-transparent"><i
                                                    class="fe fe-bell text-danger"></i></span>
                                        @endif
                                    </div>
                                    <div class="col-sm-10 ps-sm-0">
                                        <div class="d-flex align-items-end justify-content-between ms-2">
                                            @if ($in->programed == null)
                                                <h6 class="">Open meeting <br /> with: {{ $in->receiver_name }}
                                                </h6>
                                            @else
                                                <h6 class="">{{ $in->receiver_name }}<br /> at:
                                                    {{ date('Y-m-d H:i', (int) $in->programed) }}</h6>
                                            @endif
                                            <div>
                                                @if ((int) $in->programed <= strtotime(\Carbon\Carbon::now()))
                                                    <a href="/peer-video/2/{{ $in->id }}"><i
                                                            class="fe fe-play me-1"></i></a>
                                                @endif
                                                <a href="/delete-peer/{{ $in->id }}"><i class="fe fe-x me-1"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/Sidebar-right-->
