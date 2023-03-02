<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= isset($title) && $title != null ? $title : 'title belum diset' ?></title>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Font Awesome Icons -->
    <script src="/assets/js/fontawesome-kit.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="/assets/css/material-dashboard.css?v=3.0.5" rel="stylesheet" />

    <?= $this->renderSection('topsc') ?>
</head>

<body class="g-sidenav-show  bg-gray-200">

    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-dark" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="/" target="_blank">
                <img src="/assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold text-white">SIAP MAGANG</span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Main</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/tempat">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">apartment</i>
                        </div>
                        <span class="nav-link-text ms-1">Tempat Magang</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/application">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">note_add</i>
                        </div>
                        <span class="nav-link-text ms-1">Pendaftaran Siswa</span>
                    </a>
                </li>
                <hr class="horizontal light">
                <li class="nav-item">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Admin</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/man/tempat">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">corporate_fare</i>
                        </div>
                        <span class="nav-link-text ms-1">Manjemen Tempat</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/man/user">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">supervisor_account</i>
                        </div>
                        <span class="nav-link-text ms-1">Manjemen Pengelola</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/man/siswa">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <span class="nav-link-text ms-1">Manjemen Siswa</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/man/keju">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">class</i>
                        </div>
                        <span class="nav-link-text ms-1">Kelas & Jurusan</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg position-sticky mt-4 top-1 px-0 mx-4 shadow-none border-radius-xl z-index-sticky" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm">
                            <a class="opacity-5 text-dark" href="<?= base_url() ?>">Home</a>
                        </li>
                        <?php $ak = array_keys($breadcrumb); $last_key = end($ak); ?>
                        <?php foreach ($breadcrumb as $k => $b) : ?>
                            <li class="breadcrumb-item text-sm <?= $k == $last_key ? 'text-dark active' : '' ?>" aria-current="page">
                                <a class="<?= $k == $last_key ? '' : 'opacity-5 text-dark' ?>"><?= $b ?></a>
                            </li>
                        <?php endforeach ?>
                    </ol>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-5 right" id="navbar">
                    <div class="ms-auto pe-md-3 d-flex align-items-center">
                        <ul class="navbar-nav  justify-content-end">
                            <li class="nav-item dropdown pe-2 mt-1">
                                <a href="javascript:;" class="nav-link text-body p-0 position-relative" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="material-icons cursor-pointer">
                                        notifications
                                    </i>
                                    <span class="position-absolute top-5 start-100 translate-middle badge rounded-pill bg-danger border border-white small py-1 px-2">
                                        <span class="small">11</span>
                                        <span class="visually-hidden">unread notifications</span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end p-2 me-sm-n4" aria-labelledby="dropdownMenuButton">
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md" href="javascript:;">
                                            <div class="d-flex align-items-center py-1">
                                                <span class="material-icons">email</span>
                                                <div class="ms-2">
                                                    <h6 class="text-sm font-weight-normal my-auto">
                                                        Check new messages
                                                    </h6>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md" href="javascript:;">
                                            <div class="d-flex align-items-center py-1">
                                                <span class="material-icons">podcasts</span>
                                                <div class="ms-2">
                                                    <h6 class="text-sm font-weight-normal my-auto">
                                                        Manage podcast session
                                                    </h6>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item border-radius-md" href="javascript:;">
                                            <div class="d-flex align-items-center py-1">
                                                <span class="material-icons">shopping_cart</span>
                                                <div class="ms-2">
                                                    <h6 class="text-sm font-weight-normal my-auto">
                                                        Payment successfully completed
                                                    </h6>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown mt-1 ps-4">
                                <a href="javascript:;" class="nav-link text-body p-0 position-relative" id="accountMenu" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="material-icons cursor-pointer">
                                        account_circle
                                    </i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end p-2 me-sm-n4" aria-labelledby="accountMenu">
                                    <li class="">
                                        <a class="dropdown-item border-radius-md" href="/profile">
                                            <div class="d-flex align-items-center py-1">
                                                <span class="material-icons">person</span>
                                                <div class="ms-2">
                                                    <h6 class="text-sm font-weight-normal my-auto">
                                                        Profile
                                                    </h6>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a class="dropdown-item border-radius-md" href="/password">
                                            <div class="d-flex align-items-center py-1">
                                                <span class="material-icons">key</span>
                                                <div class="ms-2">
                                                    <h6 class="text-sm font-weight-normal my-auto">
                                                        Password
                                                    </h6>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <hr class="horizontal dark">
                                    <li>
                                        <a class="dropdown-item border-radius-md" href="/logout">
                                            <div class="d-flex align-items-center py-1">
                                                <span class="material-icons text-primary">logout</span>
                                                <div class="ms-2">
                                                    <h6 class="text-sm text-primary font-weight-normal my-auto">
                                                        Log Out
                                                    </h6>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                                <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                    <div class="sidenav-toggler-inner">
                                        <i class="sidenav-toggler-line"></i>
                                        <i class="sidenav-toggler-line"></i>
                                        <i class="sidenav-toggler-line"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->

        <!-- Page-Content -->
        <div class="container-fluid py-4">
            <?= $this->renderSection('content') ;?>
        </div>
        
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-4 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            © <script>
                                document.write(new Date().getFullYear())
                            </script> -
                            Sistem Informasi Siswa PKL
                        </div>
                    </div>
                </div>
        </footer>
    </main>

    <!--   Core JS Files   -->
    <script src="/assets/js/jquery-3.6.3.min.js"></script>
    <script src="/assets/js/core/bootstrap.min.js"></script>
    <script src="/assets/js/material-dashboard.min.js?v=3.0.5"></script>
    <script src="/assets/js/core/popper.min.js"></script>
    <script src="/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="/assets/js/plugins/smooth-scrollbar.min.js"></script>

    <?= $this->renderSection('bottomsc') ;?>
</body>

</html>