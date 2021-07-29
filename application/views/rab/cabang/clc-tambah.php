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
    <title>Tambah RAB | JOMLASIELSI</title>
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
    <div id="loader"></div>
    <!-- Toast-->
    <div class="toast toast-autohide custom-toast-1 toast-danger home-page-toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000" data-bs-autohide="true" style="display: none;">
        <div class="toast-body">
            <svg class="bi bi-bookmark-check text-white" width="30" height="30" viewBox="0 0 16 16" fill="currentColor" xmlns="../../www.w3.org/2000/svg.html" id="toast-icon">
                <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z">
                </path>
                <path fill-rule="evenodd" d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z">
                </path>
            </svg>
            <div class="toast-text ms-3 me-2">
                <p class="mb-1 text-white" id="toast-title"></p>
                <small class="d-block" id="toast-fill"></small>
            </div>
            <button class="btn btn-close btn-close-white position-relative p-1 ms-auto" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div class="header-area" id="headerArea">
        <div class="container">
            <!-- Header Content-->
            <div class="header-content position-relative d-flex align-items-center justify-content-between">
                <!-- Back Button-->
                <div class="back-button  loader-class"><a href="<?= base_url('rab') ?>"><svg width="32" height="32" viewBox="0 0 16 16" class="bi bi-arrow-left-short" fill="currentColor" xmlns="../../www.w3.org/2000/svg.html">
                            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                        </svg></a></div>
                <!-- Page Title-->
                <div class="page-heading">
                    <h6 class="mb-0">Tambah RAB</h6>
                </div>
                <div>

                </div>
            </div>
        </div>
    </div>
    <div class="page-content-wrapper py-3 elements-page">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <form action="#" method="POST" id="form">
                        <div class="form-group">
                            <input type="hidden" name="id_cabang" id="id_cabang" value="<?= $id_cabang ?>">
                            <label class="form-label" for="id_aktifitas">Kode Standar</label>
                            <select name="id_aktifitas" id="id_aktifitas" class="form-select"></select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="id_aktifitas_sub">Sub Standar</label>
                            <select name="id_aktifitas_sub" id="id_aktifitas_sub" class="form-select"></select>

                        </div>
                        <div class="form-group">
                            <label class="form-label" for="id_aktifitas_cabang">Sub Standar</label>
                            <select name="id_aktifitas_cabang" id="id_aktifitas_cabang" class="form-select"></select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="kode_isi_1">Sub Standar</label>
                            <select name="kode_isi_1" id="kode_isi_1" class="form-select"></select>

                        </div>
                        <div class="form-group">
                            <label class="form-label" for="kode_isi_2">Sub Standar</label>
                            <select name="kode_isi_2" id="kode_isi_2" class="form-select"></select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="kode">Kode</label>
                            <input type="text" class="form-control" id="kode" name="kode" required readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="nama">Uraian</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="harga_ringgit" class="form-label">Harga (RM)</label>
                                    <input class="form-control" type="number" step="any" name="harga_ringgit" id="harga_ringgit" required>
                                    <input class="form-control" type="hidden" step="any" name="val_harga_ringgit" id="val_harga_ringgit">
                                </div>
                                <div class="col-6">
                                    <label for="harga_rupiah" class="form-label">harga (Rp)</label>
                                    <input class="form-control" type="number" step="any" name="harga_rupiah" id="harga_rupiah" readonly>
                                    <input class="form-control" type="hidden" step="any" name="val_harga_rupiah" id="val_harga_rupiah" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="jumlah_1" class="form-label">Jumlah</label>
                                    <input class="form-control" type="number" name="jumlah_1" value="1" id="jumlah_1" required>
                                </div>
                                <div class="col-6">
                                    <label for="satuan_1" class="form-label">Satuan</label>
                                    <input class="form-control" type="text" name="satuan_1" id="satuan_1">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="jumlah_2" class="form-label">Jumlah</label>
                                    <input class="form-control" type="number" name="jumlah_2" value="1" id="jumlah_2" required>
                                </div>
                                <div class="col-6">
                                    <label for="satuan_2" class="form-label">Satuan</label>
                                    <input class="form-control" type="text" name="satuan_2" id="satuan_2">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="jumlah_3" class="form-label">Jumlah</label>
                                    <input class="form-control" type="number" name="jumlah_3" value="1" id="jumlah_3" required>
                                </div>
                                <div class="col-6">
                                    <label for="satuan_3" class="form-label">Satuan</label>
                                    <input class="form-control" type="text" name="satuan_3" id="satuan_3">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="jumlah_4" class="form-label">Jumlah</label>
                                    <input class="form-control" type="number" name="jumlah_4" value="1" id="jumlah_4" required>
                                </div>
                                <div class="col-6">
                                    <label for="satuan_4" class="form-label">Satuan</label>
                                    <input class="form-control" type="text" name="satuan_4" id="satuan_4">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="total_harga_ringgit" class="form-label">Jumlah (RM)</label>
                                    <input class="form-control" type="text" name="total_harga_ringgit" id="total_harga_ringgit" readonly>
                                    <input class="form-control" type="hidden" name="val_total_harga_ringgit" id="val_total_harga_ringgit" readonly>
                                </div>
                                <div class="col-6">
                                    <label for="total_harga_rupiah" class="form-label">Jumlah (Rp)</label>
                                    <input class="form-control" type="text" name="total_harga_rupiah" id="total_harga_rupiah" readonly>
                                    <input class="form-control" type="hidden" name="val_total_harga_rupiah" id="val_total_harga_rupiah" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                        </div>
                        <button class="btn btn-primary w-100 d-flex align-items-center justify-content-center" type="submit">Submit</button>
                    </form>
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
    <!-- toast -->
    <script src="<?= base_url() ?>assets/js/default/toast.js"></script>
    <script src="<?= base_url() ?>assets/js/default/menu-active.js"></script>
    <script src="<?= base_url() ?>assets/page/rab/cabang/clc-tambah.js"></script>
</body>

</html>