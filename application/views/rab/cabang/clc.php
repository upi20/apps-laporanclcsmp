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
    <title>RAB CLC | JOMLASIELSI</title>
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
    <!-- Web App Manifest-->
    <link rel="manifest" href="<?= base_url() ?>assets/manifest.json">
    <style>
        .nowrap {
            white-space: nowrap;
        }

        <?php
        for ($i = 5; $i <= 500; $i += 5) {
            echo ".width$i {
				max-width: $i" . "px;
				min-width: $i" . "px;
			}";
        }
        ?>
    </style>
</head>

<body>
    <div class="header-area" id="headerArea">
        <div class="container">
            <!-- Header Content-->
            <div class="header-content position-relative d-flex align-items-center justify-content-between">
                <!-- Back Button-->
                <div class="back-button"><a href="<?= base_url('rab') ?>"><svg width="32" height="32" viewBox="0 0 16 16" class="bi bi-arrow-left-short" fill="currentColor" xmlns="../../www.w3.org/2000/svg.html">
                            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                        </svg></a></div>
                <!-- Page Title-->
                <div class="page-heading">
                    <h6 class="mb-0"><?= $title ?></h6>
                </div>
                <!-- Settings-->
                <div class="setting-wrapper">
                    <a class="btn btn-sm btn-primary" id="settingTriggerBtn" href="<?= base_url('rab/clc/tambah') ?>">
                        Tambah
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content-wrapper py-3 elements-page">
        <div class="container">
            <div class="elements-heading mb-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 py-2 px-3 rounded" id="list-breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('rab') ?>">RAB</a></li>
                        <li class="breadcrumb-item active" aria-current="page">CLC</li>
                    </ol>
                </nav>
            </div>
            <div class="card">
                <div class="card-body">
                    <table class="data-table w-100" id="dataTable">
                        <thead>
                            <tr>
                                <th> Kode Standar</th>
                                <th> Uraian</th>
                                <th> Jumlah</th>
                                <th> Satuan</th>
                                <th> Jumlah</th>
                                <th> Satuan</th>
                                <th> Jumlah</th>
                                <th> Satuan</th>
                                <th> Jumlah</th>
                                <th> Satuan</th>
                                <th> Harga (RM)</th>
                                <th> Harga (Rp)</th>
                                <th> Jumlah (RM)</th>
                                <th> Jumlah (Rp)</th>
                                <th> Keterangan</th>
                                <th> Edit Data</th>
                            </tr>
                        </thead>
                    </table>
                </div>
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
        const my_acctive_menu = "rab";
        const base_url = "<?= base_url() ?>";
    </script>
    <script src="<?= base_url() ?>assets/js/default/menu-active.js"></script>
    <script src="<?= base_url() ?>assets/page/rab/cabang/clc.js"></script>
</body>

</html>