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
    <title>Dana Sisa | JOMLASIELSI</title>
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
                        <a href="<?= base_url() ?>realisasi" class="btn   loader-class">Dana RAB</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="<?= base_url() ?>realisasi/danaSisa"
                            class="btn bg-warning shadow-sm  loader-class">Dana Sisa</a>
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
                <div class="list-group pb-5 mb-4 pt-2" id="list-body">
                    <label class="list-group-item d-flex" for="listCheckbox24">
                    </label>
                </div>

                <div class="d-flex flex-row-reverse">
                    <button type="submit" class="btn btn-warning" href="#"
                        style="position:fixed; bottom:75px; z-index:999">
                        <i class="fa fa-exchange" aria-hidden="true"> </i>
                        Alihkan
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
                    <h6 class="modal-title" id="fullscreenModalLabel">Realisasi Dana Sisa</h6>
                    <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post" enctype="multipart/form-data" id="form-belanja">
                        <div class="list-group pt-2" id="list-body">
                            <label>Uraian</label>
                            <div id="modal-uraian" class="mb-2">

                            </div>
                            <div class="form-group" style="display:none">
                                <label class="form-label" for="pilihan-tambahan">Kategori Pengalihan</label>
                                <select class="form-select" id="pilihan-tambahan" name="pilihan-tambahan"
                                    aria-label="Kategori Pemilihan">
                                    <option value="rab"> RAB</option>
                                    <option value="non-rab"> Non-RAB</option>
                                </select>
                            </div>

                            <div id="form-rab">
                                <hr>
                                <div class="form-group">
                                    <label for="val-kode"> Kode Standar</label>
                                    <select id="val-kode" class="form-select" name="val-kode">
                                        <option value="">Pilih Kode</option>
                                        <?php foreach ($kodeNPSN as $key) : ?>
                                        <option value="<?= $key['kode'] ?>"><?= $key['kode'] ?> <?= $key['nama'] ?>
                                        </option>
                                        <?php endforeach ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Kode standar wajib dipilih
                                    </div>
                                </div>

                                <!-- total -->
                                <div class="form-group">
                                    <label for="jumlah-total-ringgit"> Total Ringgit</label>
                                    <input type="hidden" name="total_ringgit" id="total-ringgit">
                                    <input type="text" class="form-control" id="jumlah-total-ringgit" readonly="" />
                                </div>

                                <div class="form-group">
                                    <label for="jumlah-total-rupiah"> Total Rupiah</label>
                                    <input type="hidden" name="total_rupiah" id="total-rupiah">
                                    <input type="text" class="form-control" id="jumlah-total-rupiah" readonly="" />
                                </div>

                                <hr>
                                <!-- dana sisa -->
                                <div class="form-group">
                                    <label for="jumlah-sisa-ringgit"> Jumlah Dana Sisa Ringgit</label>
                                    <input type="hidden" name="sisa_ringgit" id="sisa-ringgit">
                                    <input type="text" class="form-control" id="jumlah-sisa-ringgit"
                                        name="jumlah_sisa_ringgit" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="jumlah-sisa-rupiah"> Jumlah Dana Sisa Rupiah</label>
                                    <input type="hidden" name="sisa_rupiah" id="sisa-rupiah">
                                    <input type="text" class="form-control" id="jumlah-sisa-rupiah"
                                        name="jumlah_sisa_rupiah" readonly="">
                                </div>

                                <hr>
                                <!-- total + sisa -->
                                <div class="form-group">
                                    <label for="jumlah-sisa-total-ringgit"> Jumlah Dana Sisa Total Ringgit
                                        Ditambahkan</label>
                                    <input type="hidden" name="sisa_total_ringgit" id="sisa-total-ringgit">
                                    <input type="text" class="form-control" id="jumlah-sisa-total-ringgit"
                                        name="jumlah-sisa-total-ringgit" readonly="">
                                </div>
                                <div class="form-group">
                                    <label for="jumlah-sisa-total-rupiah"> Jumlah Dana Sisa Total Rupiah
                                        Ditambahkan</label>
                                    <input type="hidden" name="sisa_total_rupiah" id="sisa-total-rupiah">
                                    <input type="hidden" name="id_rab" id="id_rab">
                                    <input type="text" class="form-control" id="jumlah-sisa-total-rupiah"
                                        name="jumlah-sisa-total-rupiah" readonly="">
                                </div>
                            </div>
                        </div>
                        <div id="form-non-rab" style="display:none">
                            <div class="form-group">
                                <input type="hidden" name="id_cabang" id="id_cabang" value="<?= $id_cabang ?>">
                                <label class="form-label" for="id_aktifitas">Kode Standar</label>
                                <select name="id_aktifitas" id="id_aktifitas" class="form-select"></select>
                                <div class="invalid-feedback">
                                    Kode standar wajib dipilih
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="id_aktifitas_sub">Sub Standar</label>
                                <select name="id_aktifitas_sub" id="id_aktifitas_sub" class="form-select"></select>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="id_aktifitas_cabang">Sub Standar</label>
                                <select name="id_aktifitas_cabang" id="id_aktifitas_cabang"
                                    class="form-select"></select>
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
                                <input type="text" class="form-control" id="kode" name="kode">
                                <div class="invalid-feedback">
                                    Kode wajib dipilih
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="nama">Uraian</label>
                                <input type="text" class="form-control" id="nama" name="nama">
                                <div class="invalid-feedback">
                                    Uraian wajib dipilih
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="harga_ringgit" class="form-label">Harga (RM)</label>
                                        <input class="form-control" type="text" step="any" name="harga_ringgit"
                                            id="harga_ringgit" readonly>
                                        <input class="form-control" type="hidden" step="any" name="val_harga_ringgit"
                                            id="val_harga_ringgit" readonly>
                                    </div>
                                    <div class="col-6">
                                        <label for="harga_rupiah" class="form-label">harga (Rp)</label>
                                        <input class="form-control" type="text" step="any" name="harga_rupiah"
                                            id="harga_rupiah" readonly>
                                        <input class="form-control" type="hidden" step="any" name="val_harga_rupiah"
                                            id="val_harga_rupiah" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="jumlah_1" class="form-label">Jumlah</label>
                                        <input class="form-control" type="number" name="jumlah_1" value="1"
                                            id="jumlah_1">
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
                                        <input class="form-control" type="number" name="jumlah_2" value="1"
                                            id="jumlah_2">
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
                                        <input class="form-control" type="number" name="jumlah_3" value="1"
                                            id="jumlah_3">
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
                                        <input class="form-control" type="number" name="jumlah_4" value="1"
                                            id="jumlah_4">
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
                                        <input class="form-control" type="text" name="total_harga_ringgit"
                                            id="total_harga_ringgit" readonly>
                                        <input class="form-control" type="hidden" name="val_total_harga_ringgit"
                                            id="val_total_harga_ringgit" readonly>
                                    </div>
                                    <div class="col-6">
                                        <label for="total_harga_rupiah" class="form-label">Jumlah (Rp)</label>
                                        <input class="form-control" type="text" name="total_harga_rupiah"
                                            id="total_harga_rupiah" readonly>
                                        <input class="form-control" type="hidden" name="val_total_harga_rupiah"
                                            id="val_total_harga_rupiah" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!-- keterangan -->
                        <div class="form-group">
                            <label for="keterangan"> Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                            <div class="invalid-feedback">
                                Keterangan wajib diisi
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
    </script>
    <script src="<?= base_url() ?>assets/js/default/menu-active.js"></script>
    <script src="<?= base_url() ?>assets/page/realisasi/cabang/danasisa.js"></script>
</body>

</html>