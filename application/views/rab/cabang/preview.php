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
    <title>Preview | JOMLASIELSI</title>
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
</head>

<body>
    <?php $this->load->view('element-header'); ?>

    <div class="page-content-wrapper py-3 elements-page">
        <div class="container">
            <div class="standard-tab bg-white" style="border-radius: .5rem;">
                <ul class="nav rounded-lg mb-2 p-2 shadow-sm" id="affanTabs1" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="<?= base_url() ?>rab" class="btn   loader-class">CLC</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="<?= base_url() ?>rab/preview" class="btn bg-warning shadow-sm   loader-class">Preview</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="<?= base_url() ?>rab/proposal" class="btn   loader-class">Proposal</a>
                    </li>
                </ul>
            </div>
            <?php if ($status == 0) : ?>
                <a href="<?= base_url() ?>rab/preview/tindakan/<?= $npsn ?>/1" class="btn btn-primary btn-sm my-2  loader-class" onclick="return confirm('Apakah anda yakin?');">
                    <i class="fa fa-check"></i> Ajukan ?
                </a>
            <?php elseif ($status == 1) : ?>
                <a href="<?= base_url() ?>rab/preview/tindakan/<?= $npsn ?>/0" class="btn btn-warning btn-sm my-2  loader-class" onclick="return confirm('Apakah anda yakin?');">
                    <i class="fa fa-arrow-left"></i> Batalkan Ajuan
                </a>
                <a href="#" class="btn btn-primary btn-sm my-2">
                    <i class="fa fa-info"></i> Menunggu Konfirmasi
                </a>
            <?php elseif ($status == 2) : ?>
                <a href="#" class="btn btn-primary btn-sm my-2">
                    <i class="fa fa-check"></i> RAB anda telah disetujui
                </a>
            <?php elseif ($status == 3) : ?>
                <a href="<?= base_url() ?>rab/preview/tindakan/<?= $npsn ?>/1" class="btn btn-primary btn-sm my-2  loader-class" onclick="return confirm('Apakah anda yakin?');">
                    <i class="fa fa-check"></i> Ajukan ?
                </a>
                <a href="#" class="btn btn-danger btn-sm my-2">
                    <i class="fa fa-check"></i> Rab anda telah ditolak. harap periksa kembali
                </a>
            <?php endif; ?>

            <ul class="ps-0 chat-user-list  my-2 " id="list-body">
            </ul>
        </div>
    </div>

    <!-- Fullscreen Modal-->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-md-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modalLabel">Detail RAB</h6>
                    <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="form">
                        <div class="form-group">
                            <label class="form-label" for="kode">Kode</label>
                            <input type="text" class="form-control" id="kode" name="kode" required>
                            <input type="hidden" class="form-control" id="id_cabang" name="id_cabang" required>
                            <input type="hidden" class="form-control" id="id_rabs" name="id_rabs" required>
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
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

    <!-- Static Backdrop Modal-->
    <div class="modal fade" id="importModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="importModalLabel">Import RAB dari Excel</h6>
                    <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-import" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="form-label" for="file">File: xlsx atau xls</label>
                            <input type="hidden" id="id_cabang1" name="id_cabang1" value="<?= $id_cabang ?>" class="form-control">
                            <input type="file" class="form-control" id="file" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" placeholder="" required />
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-sm btn-success" type="submit" form="form-import">Import</button>
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
        const id_cabang = "<?= $id_cabang ?>";
    </script>
    <script src="<?= base_url() ?>assets/js/default/toast.js"></script>
    <script src="<?= base_url() ?>assets/js/default/menu-active.js"></script>
    <script src="<?= base_url() ?>assets/page/rab/cabang/preview.js"></script>
</body>

</html>