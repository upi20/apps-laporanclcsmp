<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Affan - PWA Mobile HTML Template">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="theme-color" content="#0134d4"> -->
    <meta name="theme-color" content="#f1b10f">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- Title-->
    <title>Hutang | JOMLASIELSI</title>
    <!-- Favicon-->
    <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url() ?>assets/favicon/bg-white/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= base_url() ?>assets/favicon/bg-white/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url() ?>assets/favicon/bg-white/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>assets/favicon/bg-white/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url() ?>assets/favicon/bg-white/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= base_url() ?>assets/favicon/bg-white/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= base_url() ?>assets/favicon/bg-white/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= base_url() ?>assets/favicon/bg-white/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>assets/favicon/bg-white/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url() ?>assets/favicon/bg-white/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/favicon/bg-white/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url() ?>assets/favicon/bg-white/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/favicon/bg-white/favicon-16x16.png">
    <link rel="manifest" href="<?= base_url() ?>assets/favicon/bg-white/manifest.json">
    <meta name="msapplication-TileColor" content="#0134d4">
    <meta name="msapplication-TileImage" content="<?= base_url() ?>assets/favicon/bg-white/ms-icon-144x144.png">
    <!-- CSS Libraries-->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/animate.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/ion.rangeSlider.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/apexcharts.css">
    <!-- Core Stylesheet-->
    <link rel="stylesheet" href="<?= base_url() ?>assets/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/js/daterangepicker-master/daterangepicker.css">
    <!-- Web App Manifest-->
    <link rel="manifest" href="<?= base_url() ?>assets/manifest.json">
</head>

<body>
    <?php $this->load->view('element-header'); ?>

    <div class="page-content-wrapper py-3 elements-page">
        <div class="container">
            <div class="d-flex  flex-row justify-content-end w-100">
                <div id="datepicker" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; " class="mx-2">
                    <i class="fa fa-calendar"></i>&nbsp;
                    <span></span> <i class="fa fa-caret-down"></i>
                </div>
                <button id="btn-cari" class="btn btn-warning">Cari</button>
            </div>

            <ul class="ps-0 chat-user-list  my-2 mb-5 " id="list-body">
            </ul>
            <div class="d-flex flex-row-reverse">
                <button type="button" class="btn btn-warning" id="btn-export" style="position:fixed; bottom:70px; z-index:999">
                    <i class="fa fa-file-excel-o" style="margin-right: 8px;" aria-hidden="true"> </i>
                    Export excel
                </button>
            </div>
        </div>
    </div>

    <!-- Footer Nav-->
    <?php $this->load->view('element-footer'); ?>

    <!-- All JavaScript Files-->
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/default/internet-status.js"></script>
    <script src="<?= base_url() ?>assets/js/waypoints.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.easing.min.js"></script>
    <script src="<?= base_url() ?>assets/js/wow.min.js"></script>
    <script src="<?= base_url() ?>assets/js/owl.carousel.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.counterup.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.countdown.min.js"></script>
    <script src="<?= base_url() ?>assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="<?= base_url() ?>assets/js/isotope.pkgd.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.magnific-popup.min.js"></script>
    <script src="<?= base_url() ?>assets/js/default/dark-mode-switch.js"></script>
    <script src="<?= base_url() ?>assets/js/ion.rangeSlider.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/js/default/active.js"></script>
    <script src="<?= base_url() ?>assets/js/default/clipboard.js"></script>

    <!-- PWA-->
    <script src="<?= base_url() ?>assets/js/pwa.js"></script>
    <script>
        const my_acctive_menu = "rekap";
        const base_url = "<?= base_url() ?>";
        const id_cabang = "<?= $id_cabang ?>";
    </script>

    <!-- plugin -->
    <script src="<?= base_url() ?>assets/js/daterangepicker-master/moment.min.js"></script>
    <script src="<?= base_url() ?>assets/js/daterangepicker-master/daterangepicker.js"></script>

    <script src="<?= base_url() ?>assets/js/default/toast.js"></script>
    <script src="<?= base_url() ?>assets/js/default/menu-active.js"></script>
    <script src="<?= base_url() ?>assets/page/rekap/cabang/index.js"></script>
</body>

</html>