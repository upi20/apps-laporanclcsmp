<!-- Preloader-->
<div class="preloader d-flex align-items-center justify-content-center" id="preloader">
    <div class="spinner-grow text-warning" role="status">
        <div class="sr-only">Loading...</div>
    </div>
</div>
<div id="loader"></div>
<!-- Internet Connection Status-->
<div class="internet-connection-status" id="internetStatus"></div>

<!-- Header Area-->
<!-- <div class="header-area" id="headerArea">
  <div class="container">

    <div class="header-content header-style-five position-relative d-flex align-items-center justify-content-between">
      <div class="logo-wrapper"><a href="<?= base_url() ?>home"><img src="<?= base_url() ?>assets/img/core-img/logooo.png" alt=""></a></div>

      <div class="navbar--toggler" id="affanNavbarToggler"><span class="d-block"></span><span class="d-block"></span><span class="d-block"></span></div>
    </div>
  </div>
</div> -->


<div class="bg-warning shadow-sm  header-area" id="headerArea">
    <div class="container">
        <!-- # Header Two Layout-->
        <!-- # Copy the code from here ...-->
        <!-- Header Content-->
        <div
            class="header-content header-style-two position-relative d-flex align-items-center justify-content-between">
            <!-- Logo Wrapper-->
            <div class="logo-wrapper"><a href="<?= base_url() ?>"><img
                        src="<?= base_url() ?>assets/img/core-img/logooo.png" alt=""></a></div>
            <div class="navbar-content-wrapper d-flex align-items-center">
                <!-- Search-->
                <!-- Navbar Toggler-->
                <div class="navbar--toggler" id="affanNavbarToggler">
                    <div class="span-wrap"><span class="d-block"></span><span class="d-block"></span><span
                            class="d-block"></span></div>
                </div>
            </div>
        </div>
        <!-- # Header Two Layout End-->
    </div>
</div>


<!-- Sidenav Black Overlay-->
<div class="sidenav-black-overlay"></div>
<!-- Side Nav Wrapper-->
<div class="sidenav-wrapper" id="sidenavWrapper">
    <!-- Go Back Button-->
    <div class="go-back-btn" id="goBack">
        <svg class="bi bi-x" width="24" height="24" viewBox="0 0 16 16" fill="currentColor"
            xmlns="../../www.w3.org/2000/svg.html">
            <path fill-rule="evenodd"
                d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"></path>
            <path fill-rule="evenodd"
                d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"></path>
        </svg>
    </div>
    <!-- Sidenav Profile-->
    <div class="sidenav-profile bg-warning">
        <div class="sidenav-style1"></div>
        <!-- User Thumbnail-->
        <div class="user-profile"><img src="<?= base_url() ?>assets/img/kinabalu.jpg" alt=""></div>
        <!-- User Info-->
        <div class="user-info">
            <h6 class="user-name mb-0"><?= $this->session->userdata("data")['nama'] ?></h6>
            <span><?= $this->session->userdata("data")['level'] ?></span>
        </div>
    </div>
    <!-- Sidenav Nav-->
    <ul class="sidenav-nav ps-0">
        <li>
            <a href="<?= base_url() ?>home">
                <i class="fa fa-suitcase" aria-hidden="true"></i>
                &nbsp; Dashboard</a>
        </li>
        <?php if ($this->session->userdata("data")['level'] == "Super Admin") : ?>
        <li>
            <a href="<?= base_url() ?>cabang">
                <i class="fa fa-building" aria-hidden="true"></i>
                &nbsp; Cabang</a>
        </li>
        <?php endif ?>
        <li>
            <a href="<?= base_url() ?>rab/rab">
                <i class="fa fa-list-ul" aria-hidden="true"></i>
                &nbsp; RAB</a>
        </li>
        <li>
            <a href="<?= base_url() ?>realisasi">
                <i class="fa fa-usd" aria-hidden="true"></i>
                &nbsp; Realisasi</a>
        </li>
        <?php if ($this->session->userdata("data")['level'] == "Admin Sekolah") : ?>
        <li>
            <a href="<?= base_url() ?>hutang">
                <i class="fa fa-calendar" aria-hidden="true"></i>
                &nbsp; Hutang</a>
        </li>
        <li>
            <a href="<?= base_url() ?>rekap">
                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                &nbsp; Hutang</a>
        </li>
        <?php endif ?>
        <?php if ($this->session->userdata("data")['level'] == "Super Admin") : ?>
        <li>
            <a href="<?= base_url() ?>laporan">
                <i class="fa fa-book" aria-hidden="true"></i>
                &nbsp; Laporan</a>
        </li>
        <?php endif ?>
        <li>
            <a href="<?= base_url() ?>setting/profile">
                <i class="fa fa-user" aria-hidden="true"></i>
                &nbsp; Profile</a>
        </li>
        <li>
            <a href="<?= base_url() ?>login/logout">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                &nbsp; Logout</a>
        </li>
    </ul>



    <!-- Copyright Info-->
    <div class="copyright-info">
        <p>Copyright &copy; 2021 Hak Cipta <b><a style="color: #8480AE;" href="https://infinit.id/">CV. Adikarya
                    Infinit</a> &amp; SIKK </b> </p>
    </div>
</div>

<!-- Toast-->
<div class="toast toast-autohide custom-toast-1 toast-danger home-page-toast" role="alert" aria-live="assertive"
    aria-atomic="true" data-bs-delay="7000" data-bs-autohide="true" style="display: none;">
    <div class="toast-body">
        <svg class="bi bi-bookmark-check text-white" width="30" height="30" viewBox="0 0 16 16" fill="currentColor"
            xmlns="../../www.w3.org/2000/svg.html" id="toast-icon">
            <path fill-rule="evenodd"
                d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z">
            </path>
            <path fill-rule="evenodd"
                d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z">
            </path>
        </svg>
        <div class="toast-text ms-3 me-2">
            <p class="mb-1 text-white" id="toast-title"></p>
            <small class="d-block" id="toast-fill"></small>
        </div>
        <button class="btn btn-close btn-close-white position-relative p-1 ms-auto" type="button"
            data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>