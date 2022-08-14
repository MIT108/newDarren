@php
$departments = App\Http\Controllers\DepartmentController::getUserDepartment();
@endphp
<!--APP-SIDEBAR-->
<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="/home">
                {{-- <img src="../assets/images/brand/logo.png" class="header-brand-img desktop-logo" alt="logo">
                            <img src="../assets/images/brand/logo-1.png" class="header-brand-img toggle-logo"
                                alt="logo">
                            <img src="../assets/images/brand/logo-2.png" class="header-brand-img light-logo" alt="logo">
                            <img src="../assets/images/brand/logo-3.png" class="header-brand-img light-logo1"
                                alt="logo"> --}}
                <h1>Darren App</h1>
            </a>
            <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg></div>
            <ul class="side-menu">
                <li class="sub-category">
                    <h3>Main</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="/home"><i
                            class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Dashboard</span></a>
                </li>
                <li class="sub-category">
                    <h3>APPLICATION</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="/list-admin"><i
                            class="side-menu__icon fe fe-slack"></i><span class="side-menu__label">Admin</span><i
                            class="angle fe fe-chevron-right"></i></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="/list-DAG"><i
                            class="side-menu__icon fe fe-slack"></i><span class="side-menu__label">DAG</span><i
                            class="angle fe fe-chevron-right"></i></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="/list-HOS"><i
                            class="side-menu__icon fe fe-slack"></i><span class="side-menu__label">HOS</span><i
                            class="angle fe fe-chevron-right"></i></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="/list-Personnel"><i
                            class="side-menu__icon fe fe-slack"></i><span class="side-menu__label">Personnel</span><i
                            class="angle fe fe-chevron-right"></i></a>
                </li>
                <li class="sub-category">
                    <h3>DEPARTMENT</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="/list-department"><i
                            class="side-menu__icon fe fe-slack"></i><span class="side-menu__label">Add/List</span><i
                            class="angle fe fe-chevron-right"></i></a>
                </li>

                @if (Auth::user()->role_id == 3 || Auth::user()->role_id == 4)
                    <li class="sub-category">
                        <h3>My Department</h3>
                    </li>
                    @foreach ($departments as $d)
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide"
                                href="/view-department/{{ $d->id }}"><i
                                    class="side-menu__icon fe fe-slack"></i><span
                                    class="side-menu__label">{{ $d->name }}</span><i
                                    class="angle fe fe-chevron-right"></i></a>
                    @endforeach
                @endif
                </li>
                <li class="sub-category">
                    <h3>TASK</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="/list-task"><i
                            class="side-menu__icon fe fe-slack"></i><span class="side-menu__label">Task</span><i
                            class="angle fe fe-chevron-right"></i></a>
                </li>
                {{-- <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-package"></i><span
                                        class="side-menu__label">Bootstrap</span><i
                                        class="angle fe fe-chevron-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">Bootstrap</a></li>
                                    <li><a href="alerts.html" class="slide-item"> Alerts</a></li>
                                    <li><a href="buttons.html" class="slide-item"> Buttons</a></li>
                                    <li><a href="colors.html" class="slide-item"> Colors</a></li>
                                    <li class="sub-slide">
                                        <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="javascript:void(0)"><span
                                                class="sub-side-menu__label">Avatars</span><i
                                                class="sub-angle fe fe-chevron-right"></i></a>
                                        <ul class="sub-slide-menu">
                                            <li><a href="avatarsquare.html" class="sub-slide-item"> Avatar-Square</a>
                                            </li>
                                            <li><a href="avatar-round.html" class="sub-slide-item"> Avatar-Rounded</a>
                                            </li>
                                            <li><a href="avatar-radius.html" class="sub-slide-item"> Avatar-Radius</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="dropdown.html" class="slide-item"> Drop downs</a></li>
                                    <li><a href="listgroup.html" class="slide-item"> List Group</a></li>
                                    <li><a href="tags.html" class="slide-item"> Tags</a></li>
                                    <li><a href="pagination.html" class="slide-item"> Pagination</a></li>
                                    <li><a href="navigation.html" class="slide-item"> Navigation</a></li>
                                    <li><a href="typography.html" class="slide-item"> Typography</a></li>
                                    <li><a href="breadcrumbs.html" class="slide-item"> Breadcrumbs</a></li>
                                    <li><a href="badge.html" class="slide-item"> Badges / Pills</a></li>
                                    <li><a href="panels.html" class="slide-item"> Panels</a></li>
                                    <li><a href="thumbnails.html" class="slide-item"> Thumbnails</a></li>
                                    <li><a href="offcanvas.html" class="slide-item"> Offcanvas</a></li>
                                    <li><a href="toast.html" class="slide-item"> Toast</a></li>
                                    <li><a href="scrollspy.html" class="slide-item"> Scrollspy</a></li>
                                    <li><a href="mediaobject.html" class="slide-item"> Media Object</a></li>
                                    <li><a href="accordion.html" class="slide-item"> Accordions</a></li>
                                    <li><a href="tabs.html" class="slide-item"> Tabs</a></li>
                                    <li><a href="modal.html" class="slide-item"> Modal</a></li>
                                    <li><a href="tooltipandpopover.html" class="slide-item"> Tooltip and popover</a>
                                    </li>
                                    <li><a href="progress.html" class="slide-item"> Progress</a></li>
                                    <li><a href="carousel.html" class="slide-item"> Carousels</a></li>
                                </ul>
                            </li> --}}
                <li class="sub-category">
                    <h3>Socials</h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                            class="side-menu__icon fe fe-play"></i><span class="side-menu__label">Video
                            Conference</span><i class="angle fe fe-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li><a href="/peer-video" class="slide-item">Peer Conference</a></li>
                        <li><a href="/conference-video" class="slide-item">Group Conference</a></li>
                    </ul>
                </li>
                {{-- <li class="sub-category">
                                <h3>Others APPs</h3>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="/deleted-users-list"><i
                                        class="side-menu__icon fe fe-layers"></i><span
                                        class="side-menu__label">Deleted Users</span><i
                                        class="angle fe fe-chevron-right"></i></a>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-shopping-bag"></i><span
                                        class="side-menu__label">E-Commerce</span><i
                                        class="angle fe fe-chevron-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">E-Commerce</a></li>
                                    <li><a href="shop.html" class="slide-item"> Shop</a></li>
                                    <li><a href="shop-description.html" class="slide-item"> Product Details</a></li>
                                    <li><a href="cart.html" class="slide-item"> Shopping Cart</a></li>
                                    <li><a href="add-product.html" class="slide-item"> Add Product</a></li>
                                    <li><a href="wishlist.html" class="slide-item"> Wishlist</a></li>
                                    <li><a href="checkout.html" class="slide-item"> Checkout</a></li>
                                </ul>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-folder"></i><span class="side-menu__label">File
                                        Manager</span><span class="badge bg-pink side-badge">4</span><i
                                        class="angle fe fe-chevron-right hor-angle"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">File Manager</a></li>
                                    <li><a href="file-manager.html" class="slide-item"> File Manager</a></li>
                                    <li><a href="filemanager-list.html" class="slide-item"> File Manager List</a></li>
                                    <li><a href="filemanager-details.html" class="slide-item"> File Details</a></li>
                                    <li><a href="file-attachments.html" class="slide-item"> File Attachments</a></li>
                                </ul>
                            </li>
                            <li class="sub-category">
                                <h3>Misc Pages</h3>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-users"></i><span
                                        class="side-menu__label">Authentication</span><i
                                        class="angle fe fe-chevron-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">Authentication</a></li>
                                    <li><a href="login.html" class="slide-item"> Login</a></li>
                                    <li><a href="register.html" class="slide-item"> Register</a></li>
                                    <li><a href="forgot-password.html" class="slide-item"> Forgot Password</a></li>
                                    <li><a href="lockscreen.html" class="slide-item"> Lock screen</a></li>
                                    <li class="sub-slide">
                                        <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="javascript:void(0)"><span
                                                class="sub-side-menu__label">Error Pages</span><i
                                                class="sub-angle fe fe-chevron-right"></i></a>
                                        <ul class="sub-slide-menu">
                                            <li><a href="400.html" class="sub-slide-item"> 400</a></li>
                                            <li><a href="401.html" class="sub-slide-item"> 401</a></li>
                                            <li><a href="403.html" class="sub-slide-item"> 403</a></li>
                                            <li><a href="404.html" class="sub-slide-item"> 404</a></li>
                                            <li><a href="500.html" class="sub-slide-item"> 500</a></li>
                                            <li><a href="503.html" class="sub-slide-item"> 503</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                                    <i class="side-menu__icon fe fe-cpu"></i>
                                    <span class="side-menu__label">Submenu items</span><i
                                        class="angle fe fe-chevron-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">Submenu items</a></li>
                                    <li><a href="javascript:void(0)" class="slide-item">Submenu-1</a></li>
                                    <li class="sub-slide">
                                        <a class="sub-side-menu__item" data-bs-toggle="sub-slide" href="javascript:void(0)"><span
                                                class="sub-side-menu__label">Submenu-2</span><i
                                                class="sub-angle fe fe-chevron-right"></i></a>
                                        <ul class="sub-slide-menu">
                                            <li><a class="sub-slide-item" href="javascript:void(0)">Submenu-2.1</a></li>
                                            <li><a class="sub-slide-item" href="javascript:void(0)">Submenu-2.2</a></li>
                                            <li class="sub-slide2">
                                                <a class="sub-side-menu__item2" href="javascript:void(0)"
                                                    data-bs-toggle="sub-slide2"><span
                                                        class="sub-side-menu__label2">Submenu-2.3</span><i
                                                        class="sub-angle2 fe fe-chevron-right"></i></a>
                                                <ul class="sub-slide-menu2">
                                                    <li><a href="javascript:void(0)" class="sub-slide-item2">Submenu-2.3.1</a></li>
                                                    <li><a href="javascript:void(0)" class="sub-slide-item2">Submenu-2.3.2</a></li>
                                                    <li><a href="javascript:void(0)" class="sub-slide-item2">Submenu-2.3.3</a></li>
                                                </ul>
                                            </li>
                                            <li><a class="sub-slide-item" href="javascript:void(0)">Submenu-2.4</a></li>
                                            <li><a class="sub-slide-item" href="javascript:void(0)">Submenu-2.5</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="sub-category">
                                <h3>General</h3>
                            </li>
                            <li>
                                <a class="side-menu__item" href="widgets.html"><i
                                        class="side-menu__icon fe fe-grid"></i><span
                                        class="side-menu__label">Widgets</span></a>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-map-pin"></i><span
                                        class="side-menu__label">Maps</span><i
                                        class="angle fe fe-chevron-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">Maps</a></li>
                                    <li><a href="maps1.html" class="slide-item">Leaflet Maps</a></li>
                                    <li><a href="maps2.html" class="slide-item">Mapel Maps</a></li>
                                    <li><a href="maps.html" class="slide-item">Vector Maps</a></li>
                                </ul>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-bar-chart-2"></i><span
                                        class="side-menu__label">Charts</span><span
                                        class="badge bg-secondary side-badge">6</span><i
                                        class="angle fe fe-chevron-right hor-angle"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">Charts</a></li>
                                    <li><a href="chart-chartist.html" class="slide-item">Chart Js</a></li>
                                    <li><a href="chart-flot.html" class="slide-item"> Flot Charts</a></li>
                                    <li><a href="chart-echart.html" class="slide-item"> ECharts</a></li>
                                    <li><a href="chart-morris.html" class="slide-item"> Morris Charts</a></li>
                                    <li><a href="chart-nvd3.html" class="slide-item"> Nvd3 Charts</a></li>
                                    <li><a href="charts.html" class="slide-item"> C3 Bar Charts</a></li>
                                    <li><a href="chart-line.html" class="slide-item"> C3 Line Charts</a></li>
                                    <li><a href="chart-donut.html" class="slide-item"> C3 Donut Charts</a></li>
                                    <li><a href="chart-pie.html" class="slide-item"> C3 Pie charts</a></li>
                                </ul>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)"><i
                                        class="side-menu__icon fe fe-wind"></i><span
                                        class="side-menu__label">Icons</span><i
                                        class="angle fe fe-chevron-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1"><a href="javascript:void(0)">Icons</a></li>
                                    <li><a href="icons.html" class="slide-item"> Font Awesome</a></li>
                                    <li><a href="icons2.html" class="slide-item"> Material Design Icons</a></li>
                                    <li><a href="icons3.html" class="slide-item"> Simple Line Icons</a></li>
                                    <li><a href="icons4.html" class="slide-item"> Feather Icons</a></li>
                                    <li><a href="icons5.html" class="slide-item"> Ionic Icons</a></li>
                                    <li><a href="icons6.html" class="slide-item"> Flag Icons</a></li>
                                    <li><a href="icons7.html" class="slide-item"> pe7 Icons</a></li>
                                    <li><a href="icons8.html" class="slide-item"> Themify Icons</a></li>
                                    <li><a href="icons9.html" class="slide-item">Typicons Icons</a></li>
                                    <li><a href="icons10.html" class="slide-item">Weather Icons</a></li>
                                    <li><a href="icons11.html" class="slide-item">Bootstrap Icons</a></li>
                                </ul>
                            </li> --}}
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg></div>
        </div>
    </div>
    <!--/APP-SIDEBAR-->
</div>
