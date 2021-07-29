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
</head>

<body>
    <?php $this->load->view('element-header'); ?>

    <div class="page-content-wrapper py-3 elements-page">
        <div class="container">
            <div class="d-flex  justify-content-between w-100">
                <button class="btn btn-creative btn-success my-2" data-bs-toggle="modal"
                    data-bs-target="#modalTambah"><i class="fa fa-plus" aria-hidden="true"></i> Tambah </button>
                <button class="btn btn-creative btn-secondary my-2" id="bayar-hutang"><i class="fa fa-download"
                        aria-hidden="true"></i> Bayar Utang </button>
            </div>
            <ul class="ps-0 chat-user-list  my-2 " id="list-body">
            </ul>
        </div>
    </div>


    <!-- modal tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-md-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modalTambahLabel">Tambah Hutang</h6>
                    <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="formTambah">
                        <div class="form-group">
                            <label class="form-label" for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                            <input type="hidden" class="form-control" id="id_cabang" name="id_cabang"
                                value="<?= $id_cabang ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="no_hp">No Handphone</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="keterangan">Keterangan</label>
                            <textarea type="text" class="form-control" id="keterangan" name="keterangan" required
                                rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="jumlah">Jumlah (RM)</label>
                            <input type="text" class="form-control" id="jumlah" name="jumlah"
                                placeholder="Masukan jumlah sesuai minus saldo / pinjaman" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-sm btn-success" type="submit" form="formTambah">Submit</button>
                </div>
            </div>
        </div>
    </div>


    <!-- modal Detail -->
    <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-md-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modalDetailLabel">Detail Hutang</h6>
                    <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="formDetail">
                        <div class="form-group">
                            <label class="form-label" for="detail-nama">Nama</label>
                            <input type="text" class="form-control" id="detail-nama" name="nama" required>
                            <input type="hidden" class="form-control" id="detail-id" name="id" value="" required>
                            <input type="hidden" class="form-control" id="detail-id_cabang" name="id_cabang"
                                value="<?= $id_cabang ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="detail-no_hp">No Handphone</label>
                            <input type="text" class="form-control" id="detail-no_hp" name="no_hp" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="detail-keterangan">Keterangan</label>
                            <textarea type="text" class="form-control" id="detail-keterangan" name="keterangan" required
                                rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="detail-jumlah">Jumlah (RM)</label>
                            <input type="text" class="form-control" id="detail-jumlah" name="jumlah"
                                placeholder="Masukan jumlah sesuai minus saldo / pinjaman" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="detail-tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="detail-tanggal" name="tanggal" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-sm btn-danger" id="detail-btn-hapus">Hapus</button>
                    <button class="btn btn-sm btn-success" type="submit" form="formDetail"
                        id="detail-btn-submit">Ubah</button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal bayar utang -->
    <div class="modal fade" id="modalBayarUtang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalBayarUtangLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modalBayarUtangLabel">Bayar Utang</h6>
                    <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-bayar-hutang" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama"> Jumlah Saldo</label>
                                    <input type="text" class="form-control" id="jumlah-saldo" required="" readonly="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama"> Dibayar</label>
                                    <input type="text" class="form-control" id="dibayar" placeholder="" required=""
                                        readonly="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tanggal-administrasi"> Tanggal Administrasi</label>
                                    <input type="date" class="form-control" id="tanggal-administrasi" placeholder=""
                                        value="<?= date("Y-m-d") ?>" required />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-sm btn-success" type="submit" form="form-bayar-hutang">Bayar</button>
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
    const my_acctive_menu = "hutang";
    const base_url = "<?= base_url() ?>";
    </script>
    <script src="<?= base_url() ?>assets/js/default/toast.js"></script>
    <script src="<?= base_url() ?>assets/js/default/menu-active.js"></script>
    <script src="<?= base_url() ?>assets/page/hutang/cabang/index1.js"></script>
</body>

</html>