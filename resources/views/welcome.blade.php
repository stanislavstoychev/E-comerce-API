<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="img/logo/logo.png" rel="icon">
    <title>Construction - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" />
    <link href="{{asset('backend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('backend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('backend/css/ruang-admin.min.css')}}" rel="stylesheet">
</head>

<body id="page-top">
    <div id="app">

        <div id="wrapper">

            <!-- Sidebar -->
            <nav id="sidebar"
                v-show="$route.path === '/' || $route.path === '/register' ||  $route.path === '/forget' ? false : true"
                style="display:none;">
                <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
                    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                        <div class="sidebar-brand-icon">
                            <img src="{{asset('backend/img/logo/logo2.png')}}">
                        </div>
                        <div class="sidebar-brand-text mx-3">Construction</div>
                    </a>
                    <hr class="sidebar-divider my-0">
                    <li class="nav-item active">
                        <router-link class="nav-link" to="/home">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </router-link>
                    </li>

                    <li class="nav-item bg-info">
                        <router-link class="nav-link" to="/pos">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>POST</span>
                        </router-link>
                    </li>

                    <hr class="sidebar-divider">
                    <div class="sidebar-heading">
                        Features
                    </div>



                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap1"
                            aria-expanded="true" aria-controls="collapseBootstrap1">
                            <i class="far fa-fw fa-window-maximize"></i>
                            <span>Projects</span>
                        </a>
                        <div id="collapseBootstrap1" class="collapse" aria-labelledby="headingBootstrap"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">

                                <router-link class="collapse-item" to="/store-project">Add Project</router-link>
                                <router-link class="collapse-item" to="/project">All Projects</router-link>

                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap12"
                            aria-expanded="true" aria-controls="collapseBootstrap12">
                            <i class="far fa-fw fa-window-maximize"></i>
                            <span>Issues</span>
                        </a>
                        <div id="collapseBootstrap12" class="collapse" aria-labelledby="headingBootstrap"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">

                                <router-link class="collapse-item" to="/store-issue">Add Issue
                                </router-link>
                                <router-link class="collapse-item" to="/issue">Open Issues</router-link>
                                <router-link class="collapse-item" to="/issueall">All Issues</router-link>

                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap2"
                            aria-expanded="true" aria-controls="collapseBootstrap2">
                            <i class="far fa-fw fa-window-maximize"></i>
                            <span>Sub-contractors</span>
                        </a>
                        <div id="collapseBootstrap2" class="collapse" aria-labelledby="headingBootstrap"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">

                                <router-link class="collapse-item" to="/store-subcontractor">Add Sub-contractor
                                </router-link>
                                <router-link class="collapse-item" to="/subcontractor">All Sub-contractors</router-link>

                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap3"
                            aria-expanded="true" aria-controls="collapseBootstrap3">
                            <i class="far fa-fw fa-window-maximize"></i>
                            <span>Part</span>
                        </a>
                        <div id="collapseBootstrap3" class="collapse" aria-labelledby="headingBootstrap"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">

                                <router-link class="collapse-item" to="/store-part">Add Part
                                </router-link>
                                <router-link class="collapse-item" to="/part">All Parts</router-link>

                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap4"
                            aria-expanded="true" aria-controls="collapseBootstrap4">
                            <i class="far fa-fw fa-window-maximize"></i>
                            <span>Substructure</span>
                        </a>
                        <div id="collapseBootstrap4" class="collapse" aria-labelledby="headingBootstrap"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">

                                <router-link class="collapse-item" to="/store-substructure">Add Substructure
                                </router-link>
                                <router-link class="collapse-item" to="/substructure">All Substuctures</router-link>

                            </div>
                        </div>
                    </li>





                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap11"
                            aria-expanded="true" aria-controls="collapseBootstrap11">
                            <i class="far fa-fw fa-window-maximize"></i>
                            <span>RFI</span>
                        </a>
                        <div id="collapseBootstrap11" class="collapse" aria-labelledby="headingBootstrap"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">

                                <router-link class="collapse-item" to="/store-rfi">Add RFI</router-link>
                                <router-link class="collapse-item" to="/rfi">Sub-contractor's RFI</router-link>
                                <router-link class="collapse-item" to="/inspector-rfi">Inspector's RFI</router-link>
                                <router-link class="collapse-item" to="/inspectorall-rfi">Inspector's all RFI
                                </router-link>
                                <router-link class="collapse-item" to="/status-rfi">Satus RFI</router-link>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap13"
                            aria-expanded="true" aria-controls="collapseBootstrap13">
                            <i class="far fa-fw fa-window-maximize"></i>
                            <span>Step</span>
                        </a>
                        <div id="collapseBootstrap13" class="collapse" aria-labelledby="headingBootstrap"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">

                                <router-link class="collapse-item" to="/store-step">Add Step</router-link>
                                <router-link class="collapse-item" to="/step">All Steps</router-link>

                            </div>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap14"
                            aria-expanded="true" aria-controls="collapseBootstrap14">
                            <i class="far fa-fw fa-window-maximize"></i>
                            <span>Drawings</span>
                        </a>
                        <div id="collapseBootstrap14" class="collapse" aria-labelledby="headingBootstrap"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <router-link class="collapse-item" to="/store-drawing">New Drawing</router-link>
                                <router-link class="collapse-item" to="/drawing">All Drawings</router-link>
                                <router-link class="collapse-item" to="/store-transmittal">New Transmittal</router-link>
                                <router-link class="collapse-item" to="/transmittal">All Transmittal</router-link>

                            </div>
                        </div>
                    <li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap15"
                            aria-expanded="true" aria-controls="collapseBootstrap15">
                            <i class="far fa-fw fa-window-maximize"></i>
                            <span>Tasks</span>
                        </a>
                        <div id="collapseBootstrap15" class="collapse" aria-labelledby="headingBootstrap"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <router-link class="collapse-item" to="/store-task">New Task</router-link>
                                <router-link class="collapse-item" to="/task">All tasks</router-link>
                                <router-link class="collapse-item" to="/taskpic">All tasks with pictures</router-link>

                            </div>
                        </div>
                    <li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable"
                            aria-expanded="true" aria-controls="collapseTable">
                            <i class="fas fa-fw fa-table"></i>
                            <span>Reports</span>
                        </a>
                        <div id="collapseTable" class="collapse" aria-labelledby="headingTable"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Tables</h6>
                                <a class="collapse-item" href="simple-tables.html">Report One</a>
                                <a class="collapse-item" href="datatables.html">Report Two</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ui-colors.html">
                            <i class="fas fa-fw fa-palette"></i>
                            <span>UI Colors</span>
                        </a>
                    </li>
                    <hr class="sidebar-divider">
                    <div class="sidebar-heading">
                        Examples
                    </div>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePage"
                            aria-expanded="true" aria-controls="collapsePage">
                            <i class="fas fa-fw fa-columns"></i>
                            <span>Pages</span>
                        </a>
                        <div id="collapsePage" class="collapse" aria-labelledby="headingPage"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Example Pages</h6>
                                <a class="collapse-item" href="login.html">Login</a>
                                <a class="collapse-item" href="register.html">Register</a>
                                <a class="collapse-item" href="404.html">404 Page</a>
                                <a class="collapse-item" href="blank.html">Blank Page</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="charts.html">
                            <i class="fas fa-fw fa-chart-area"></i>
                            <span>Charts</span>
                        </a>
                    </li>
                    <hr class="sidebar-divider">
                    <div class="version" id="version-ruangadmin"></div>
                </ul>
            </nav>
            <!-- Sidebar -->

            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">

                    <!-- TopBar -->
                    <nav id='topbar'
                        v-show="$route.path === '/' || $route.path === '/register' ||  $route.path === '/forget' ? false : true"
                        class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top"
                        style="display:none;">
                        <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                    aria-labelledby="searchDropdown">
                                    <form class="navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-1 small"
                                                placeholder="What do you want to look for?" aria-label="Search"
                                                aria-describedby="basic-addon2" style="border-color: #3f51b5;">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bell fa-fw"></i>
                                    <span class="badge badge-danger badge-counter">3+</span>
                                </a>
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="alertsDropdown">
                                    <h6 class="dropdown-header">
                                        Alerts Center
                                    </h6>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-primary">
                                                <i class="fas fa-file-alt text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">December 12, 2019</div>
                                            <span class="font-weight-bold">A new monthly report is ready to
                                                download!</span>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-success">
                                                <i class="fas fa-donate text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">December 7, 2019</div>
                                            $290.29 has been deposited into your account!
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-warning">
                                                <i class="fas fa-exclamation-triangle text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">December 2, 2019</div>
                                            Spending Alert: We've noticed unusually high spending for your account.
                                        </div>
                                    </a>
                                    <a class="dropdown-item text-center small text-gray-500" href="#">Show All
                                        Alerts</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-envelope fa-fw"></i>
                                    <span class="badge badge-warning badge-counter">2</span>
                                </a>
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="messagesDropdown">
                                    <h6 class="dropdown-header">
                                        Message Center
                                    </h6>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="{{asset('backend/img/man.png')}}"
                                                style="max-width: 60px" alt="">
                                            <div class="status-indicator bg-success"></div>
                                        </div>
                                        <div class="font-weight-bold">
                                            <div class="text-truncate">Hi there! I am wondering if you can help me with
                                                a
                                                problem I've been
                                                having.</div>
                                            <div class="small text-gray-500">Udin Cilok · 58m</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="{{asset('backend/img/girl.png')}}"
                                                style="max-width: 60px" alt="">
                                            <div class="status-indicator bg-default"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">Am I a good boy? The reason I ask is because
                                                someone
                                                told me that people
                                                say this to all dogs, even if they aren't good...</div>
                                            <div class="small text-gray-500">Jaenab · 2w</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item text-center small text-gray-500" href="#">Read More
                                        Messages</a>
                                </div>
                            </li>
                            <li  class="nav-item dropdown no-arrow mx-1">
                                <router-link to="/register" class="nav-link"
                                    role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fas fa-user-plus"></i>
                                </router-link>

                            </li>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <router-link to="/logout" class="nav-link dropdown-toggle"
                                    id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fas fa-sign-out-alt"></i>

                                </router-link>

                            </li>

                        </ul>
                    </nav>
                    <!-- Topbar -->

                    <!-- Container Fluid-->
                    <div class="container-fluid" id="container-wrapper">

                        <!-- Dynamic area -->
                        <router-view></router-view>
                        <!--/Dynamic area -->

                    </div>
                    <!---Container Fluid-->
                </div>

            </div>
        </div>

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>copyright &copy; 2021 - developed by
                        <b><a href="" target="_blank">SS</a></b>
                    </span>
                </div>
            </div>
        </footer>
        <!-- Footer -->

    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('backend/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('backend/js/ruang-admin.min.js')}}"></script>
    <script src="{{asset('backend/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('backend/js/demo/chart-area-demo.js')}}"></script>
    <script type='text/javascript'>
    let token = localStorage.getItem('token');
    if (token) {
        $("#sidebar").css("display", "")
        $("#topbar").css("display", "")
    }
    </script>

</body>







</html>