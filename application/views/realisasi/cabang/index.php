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
    <title>Realisasi | JOMLASIELSI</title>
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
    <link rel="icon" type="image/png" sizes="192x192"
        href="<?= base_url() ?>assets/favicon/bg-white/android-icon-192x192.png">
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

    <!-- pilih semua sticky -->
    <style>
    .sticky {
        position: fixed;
        top: 57px;
        z-index: 909;
        border-radius: 0.5rem;
    }
    </style>
</head>

<body>
    <?php $this->load->view('element-header'); ?>
    <div class="page-content-wrapper pt-3 elements-page">
        <div class="container">
            <div class="standard-tab bg-white mb-2" id="tab-main" style="border-radius: .5rem;">
                <ul class="nav rounded-lg mb-2 p-2 shadow-sm" id="affanTabs1" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="<?= base_url() ?>realisasi" class="btn bg-warning shadow-sm  loader-class">Dana RAB</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="<?= base_url() ?>realisasi/danaSisa" class="btn  loader-class">Dana Sisa</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="<?= base_url() ?>realisasi/danaKurang" class="btn  loader-class">Dana Kurang</a>
                    </li>
                </ul>
            </div>
            <div class="header" id="myHeader">
                <div class="list-group">
                    <label class="list-group-item d-flex" id="check-all-container" for="check-all">
                        <input class="form-check-input me-2" id="check-all" onchange="handleSetAllCheckbox(this)"
                            type="checkbox" value=""> Pilih Semua
                    </label>
                </div>
            </div>
            <!-- List Checkbox -->
            <form action="" id="form" method="POST">
                <div class="list-group py-2 pb-5 mb-3" id="list-body">
                    <label class="list-group-item d-flex" for="listCheckbox24">
                    </label>
                </div>

                <div class="d-flex flex-row-reverse">
                    <button type="submit" class="btn btn-warning" href="#"
                        style="position:fixed; bottom:75px; z-index:999">
                        <svg width="18" height="18" viewBox="0 0 16 16" class="bi bi-bag-check" fill="currentColor"
                            xmlns="../../www.w3.org/2000/svg.html">
                            <path fill-rule="evenodd"
                                d="M8 1a2.5 2.5 0 0 0-2.5 2.5V4h5v-.5A2.5 2.5 0 0 0 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5H2z">
                            </path>
                            <path fill-rule="evenodd"
                                d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z">
                            </path>
                        </svg>
                        Belanja
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Fullscreen Modal-->
    <div class="modal fade" id="fullscreenModal" tabindex="-1" aria-labelledby="fullscreenModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-md-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="fullscreenModalLabel">Realisasi Belanja</h6>
                    <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post" enctype="multipart/form-data" id="form-belanja">
                        <div class="list-group pb-5 mb-4 pt-2" id="list-body">
                            <div class="mb-2">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Anggaran</th>
                                            <th>Selisih</th>
                                        </tr>
                                    </thead>
                                    <tbody id="body-realisasi">
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group">
                                <label for="belanja-text-total-ringgit" class="form-label">Anggaran RAB (RM)</label>
                                <input class="form-control" type="text" name="belanja-text-total-ringgit"
                                    id="belanja-text-total-ringgit" readonly>
                            </div>

                            <div class="form-group">
                                <label for="belanja-text-total-rupiah" class="form-label">Anggaran RAB (Rp)</label>
                                <input class="form-control" type="text" name="belanja-text-total-rupiah"
                                    id="belanja-text-total-rupiah" readonly>
                            </div>

                            <div class="form-group">
                                <label for="belanja-nama" class="form-label">Dibayarkan Kepada</label>
                                <input class="form-control" type="text" name="belanja-nama" id="belanja-nama" required>
                            </div>

                            <div class="form-group">
                                <label for="belanja-nama1" class="form-label">Untuk</label>
                                <input class="form-control" type="text" name="belanja-nama1" id="belanja-nama1"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="belanja-keterangan">Keterangan</label>
                                <textarea class="form-control" id="belanja-keterangan" name="belanja-keterangan"
                                    cols="3" rows="5" placeholder="Keterangan" required></textarea>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="belanja-text-harga-ringgit" class="form-label">Harga real
                                            (RM)</label>
                                        <input class="form-control" type="hidden" name="belanja-harga-ringgit"
                                            id="belanja-harga-ringgit" readonly>
                                        <input class="form-control" type="text" name="belanja-text-harga-ringgit"
                                            id="belanja-text-harga-ringgit" readonly required>
                                    </div>
                                    <div class="col-6">
                                        <label for="belanja-text-harga-rupiah" class="form-label">Harga real
                                            (Rp)</label>
                                        <input class="form-control" type="hidden" name="belanja-harga-rupiah"
                                            id="belanja-harga-rupiah" readonly>
                                        <input class="form-control" type="text" name="belanja-text-harga-rupiah"
                                            id="belanja-text-harga-rupiah" readonly required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="file">Photo Resit / Nota / Kwitansi</label>
                                <input type="file" class="form-control" id="file" name="file"
                                    accept="image/png, image/gif, image/jpg, image/jpeg" placeholder="" required />
                            </div>
                            <div class="form-group">
                                <label for="belanja-tanggal" class="form-label">Tanggal</label>
                                <input class="form-control" type="date" name="belanja-tanggal" id="belanja-tanggal"
                                    placeholder="Pilih tanggal" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-sm btn-success" type="submit" form="form-belanja">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Fullscreen Modal-->
    <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-md-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modalDetailLabel">Detail Realisasi Belanja</h6>
                    <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Anggaran</th>
                                <th>Realisasi</th>
                            </tr>
                        </thead>
                        <tbody id="detail-realisasi-modal">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
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
    <script src="<?= base_url() ?>assets/js/default/toast.js"></script>
    <script>
    const my_acctive_menu = "realisasi";
    const base_url = "<?= base_url() ?>";
    const npsn = "<?= $npsn ?>";
    const id_cabang = "<?= $id_cabang ?>";
    const kurs = "<?= $kurs ?>";
    </script>
    <script src="<?= base_url() ?>assets/js/default/menu-active.js"></script>
    <script src="<?= base_url() ?>assets/page/realisasi/cabang/index.js"></script>
</body>

</html>