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
    <title>Profile | JOMLASIELSI</title>
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

    <div class="page-content-wrapper py-2 elements-page">
        <div class="container">
            <div class="elements-heading d-flex align-items-center mt-3 mb-3">
                <div class="icon-wrapper bg-warning">
                    <i class="fa fa-user" sty="" aria-hidden="true"></i>
                </div>
                <div class="heading-text">
                    <h5 class="mb-0">Ubah Profile</h5>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-body">
                    <form action="#" method="POST" id="form">
                        <div class="form-group">
                            <label class="form-label" for="kode">NPSN</label>
                            <input type="text" class="form-control" id="kode" name="kode" readonly value="">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="nama">Nama CLC</label>
                            <input type="hidden" class="form-control" id="id" name="id" value="" required>
                            <input type="text" class="form-control" id="nama" name="nama" value="" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="no_telpon">No. Telpon Pengelola</label>
                            <input type="text" class="form-control" id="no_telpon" name="no_telpon" value="" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="alamat">Alamat CLC</label>
                            <textarea class="form-control" id="alamat" name="alamat" cols="3" rows="2" placeholder="Alamat CLC" required></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="jumlah_kelas_7">Siswa Kelas 7</label>
                            <input type="number" class="form-control" id="jumlah_kelas_7" name="jumlah_kelas_7" value="" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="jumlah_kelas_8">Siswa Kelas 8</label>
                            <input type="number" class="form-control" id="jumlah_kelas_8" name="jumlah_kelas_7" value="" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="jumlah_kelas_9">Siswa Kelas 9</label>
                            <input type="number" class="form-control" id="jumlah_kelas_9" name="jumlah_kelas_9" value="" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="total_jumlah_siswa">Jumlah Siswa Keseluruhan</label>
                            <input type="number" class="form-control" id="total_jumlah_siswa" name="total_jumlah_siswa" value="" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="jumlah_guru_bina">Jumlah Guru Bina</label>
                            <input type="number" class="form-control" id="jumlah_guru_bina" name="jumlah_guru_bina" value="" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="jumlah_guru_pamong">Jumlah Guru Pamong</label>
                            <input type="number" class="form-control" id="jumlah_guru_pamong" name="jumlah_guru_pamong" value="" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="total_jumlah_guru">Jumlah Guru Keseluruhan</label>
                            <input type="number" class="form-control" id="total_jumlah_guru" name="total_jumlah_guru" value="" required>
                        </div>
                    </form>
                </div>
                <div class="d-flex flex-row-reverse">
                    <button type="submit" class="btn btn-warning" form="form" style="position:fixed; bottom:70px; z-index:999">
                        <i class="fa fa-floppy-o" aria-hidden="true"> </i>
                        Simpan Profile
                    </button>
                </div>
            </div>

            <div class="elements-heading d-flex align-items-center mt-3 mb-3">
                <div class="icon-wrapper bg-success">
                    <i class="fa fa-key" sty="" aria-hidden="true"></i>
                </div>
                <div class="heading-text">
                    <h5 class="mb-0">Ganti Password</h5>
                </div>
            </div>
            <div class="card mb-5">
                <div class="card-body">
                    <form id="input_pengaturan">
                        <div class="widget-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-label" for="current_password"> Password Sebelumnya</label>
                                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Password Sebelumnya" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-label" for="new_password"> Password Baru</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Password Baru" required minlength="6" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-label" for="new_password_verify"> Ulangi Password Baru</label>
                                        <input type="password" class="form-control" id="new_password_verify" name="new_password_verify" placeholder="Ulangi Password Baru" required minlength="6" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5" style="margin-bottom: 20px;">
                                    <input type="checkbox" id="password_visibility" />
                                    <label class="form-label" for="password_visibility"> Perlihatkan Password</label>
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit" name="submit" id="btn-submit" disabled>Simpan</button>
                        </div>
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
    <script src="<?= base_url() ?>assets/js/default/toast.js"></script>
    <!-- menu active footer -->
    <script>
        const my_acctive_menu = "setting";
        const user_id = "<?= $user_id ?>";
        const base_url = "<?= base_url() ?>";
    </script>
    <script src="<?= base_url() ?>assets/js/default/menu-active.js"></script>
    <script src="<?= base_url() ?>assets/page/setting/cabang/profile.js"></script>
</body>

</html>