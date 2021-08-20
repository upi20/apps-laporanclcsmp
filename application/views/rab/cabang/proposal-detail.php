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
  <title>Detail Proposal | JOMLASIELSI</title>
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

    $btn_ajukan = '<button type="button" class="btn btn-success my-1" style="margin-right:10px" id="btn-ajukan"><i class="fa fa-upload" aria-hidden="true"> </i>  Ajukan Proposal</button>';
    $btn_batal = '<button type="button" class="btn btn-danger my-1" style="margin-right:10px" id="btn-batal"><i class="fa fa-times" aria-hidden="true"> </i>  Batal Ajukan</button>';
    $btn_hapus = '<button type="button" class="btn btn-danger my-1" style="margin-right:10px"  data-bs-toggle="modal" data-bs-target="#hapusModal"> <i class="fa fa-trash" aria-hidden="true"> </i>  Hapus Proposal</button>';
    $btn_simpan = '<button type="submit" class="btn btn-warning my-1" style="margin-right:10px"> <i class="fa fa-floppy-o" aria-hidden="true"> </i>  Simpan Proposal </button>';
    $btn_excel = '<a type="submit" class="btn btn-success my-1" style="margin-right:10px" href="' . base_url() . 'rab/proposal/exportexcel?id_cabang=' . $id_cabang . '&id_proposal=' . $id_proposal . '"> <i class="fa fa-file-excel-o" aria-hidden="true"> </i>  Ekspor Excel </a>';
    $hidden = "";
    $disabled = "";
    if ($proposal['status'] != 0) {
      $hidden = 'style="display:none"';
      $disabled = 'disabled';
    }
    ?>
  </style>

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
        <div class="back-button  loader-class"><a href="<?= base_url('rab/proposal') ?>"><svg width="32" height="32" viewBox="0 0 16 16" class="bi bi-arrow-left-short" fill="currentColor" xmlns="../../www.w3.org/2000/svg.html">
              <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
            </svg></a></div>
        <!-- Page Title-->
        <div class="page-heading">
          <h6 class="mb-0">Detail Proposal</h6>
        </div>
        <div id="total-rm">
          <?= $proposal['total_ringgit'] ?>
        </div>
      </div>
    </div>
  </div>
  <div class="page-content-wrapper py-3 elements-page">
    <form action="" id="form" method="POST">
      <div class="container" id="tab-main">
        <div class="mb-3">
          <?php
          if ($proposal['status'] == 0) {
            echo $btn_ajukan;
            echo $btn_hapus;
            echo $btn_excel;
          } else if ($proposal['status'] == 0 || $proposal['status'] == 3) {
            echo $btn_hapus;
            echo $btn_excel;
          } else if ($proposal['status'] == 1) {
            echo $btn_batal;
            echo $btn_excel;
          } else {
            echo $btn_excel;
          }

          ?>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="form-group">
              <label class="form-label" for="judul">Judul</label>
              <input type="text" class="form-control" id="judul" name="judul" value="<?= $proposal['judul'] ?>" required <?= $disabled ?>>
              <input type="hidden" id="id-proposal" value="<?= $id_proposal ?>">
            </div>

            <div class="row">
              <div class="col-sm-5">
                <div class="form-group">
                  <label class="form-label" for="detail-tgl-dari">Periode dari</label>
                  <input type="date" class="form-control" id="detail-tgl-dari" name="detail-tgl-dari" value="<?= $proposal['periode_dari'] ?>" required <?= $disabled ?>>
                </div>
              </div>
              <div class="col-sm-5">
                <div class="form-group">
                  <label class="form-label" for="detail-tgl-sampai">Periode sampai</label>
                  <input type="date" class="form-control" id="detail-tgl-sampai" name="detail-tgl-sampai" value="<?= $proposal['periode_sampai'] ?>" required <?= $disabled ?>>
                </div>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <label class="form-label" for="termin">Termin</label>
                  <input type="number" class="form-control" id="termin" name="termin" value="<?= $proposal['periode_termin'] ?>" required <?= $disabled ?>>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="keterangan">Keterangan</label>
              <textarea class="form-control" id="keterangan" name="keterangan" cols="3" rows="2" placeholder="" required <?= $disabled ?>><?= $proposal['keterangan'] ?></textarea>
            </div>
            <label for="">Status</label>
            <p class="text-<?= ($proposal['status'] == 0) ? "secondary" : (($proposal['status'] == 1) ? "warning" : (($proposal['status'] == 2) ? "primary" : (($proposal['status'] == 3) ? "danger" : (($proposal['status'] == 4) ? "success" : "")))) ?>"><?= ($proposal['status'] == 0) ? "Diproses" : (($proposal['status'] == 1) ? "Diajukan" : (($proposal['status'] == 2) ? "Diterima" : (($proposal['status'] == 3) ? "Ditolak" : (($proposal['status'] == 4) ? "Dicairkan" : "")))) ?></p>
          </div>
        </div>
      </div>
      <div class="container my-2">
        <div class="card p-2">
          <h5 class="text-center">List RAB</h5>
        </div>
      </div>
      <div class="container my-2">

        <div class="header" id="myHeader" <?= $hidden ?>>
          <div class="list-group">
            <label class="list-group-item d-flex" id="check-all-container" for="check-all">
              <input class="form-check-input me-2" id="check-all" onchange="handleSetAllCheckbox(this)" type="checkbox" value=""> Pilih Semua
            </label>
          </div>
        </div>
        <!-- List Checkbox -->


        <div class="list-group py-2 pb-4 mb-3" id="list-body">
          <?php foreach ($lists as $list) :
            $jumlah_1_realisasi = ($list['jumlah_1_realisasi'] == 0) ? $list['jumlah_1'] : $list['jumlah_1_realisasi'];
            $total_harga_ringgit = isset($list['jumlah_ringgit']) ? $list['jumlah_ringgit'] : $list['total_harga_ringgit'];
            $total_harga_rupiah = isset($list['jumlah_rupiah']) ? $list['jumlah_rupiah'] : $list['total_harga_rupiah'];
            $id_proposal = isset($list['id_proposal']) ? $list['id_proposal'] : '';
            $id_proposal_rab = isset($list['id_proposal_rab']) ? $list['id_proposal_rab'] : '';
          ?>
            <label class="list-group-item d-flex w-100" for="listCheckbox<?= $list['id'] ?>">
              <input class="form-check-input me-2 check" id="listCheckbox<?= $list['id'] ?>" type="checkbox" value="" <?= $hidden == "" ? 'style="width: 25px; height: 25px; margin-right: 10px;"' :
                                                                                                                        $hidden ?> data-id="<?= $list['id'] ?>" data-ringgit="<?= $list['harga_ringgit'] ?>" data-rupiah="<?= $list['harga_rupiah'] ?>" data-total_ringgit="<?= $total_harga_ringgit ?>" data-total_rupiah="<?= $total_harga_rupiah ?>" data-jumlah_1="<?= $list['jumlah_1'] ?>" data-id_proposal="<?= $id_proposal ?>" data-id_proposal_rab="<?= $id_proposal_rab ?>" <?= $list['ischeck'] == 0 ? "" : "checked" ?>>

              <div class="chat-user-info w-100">
                <div class="d-flex flex-column">
                  <h6 class="text-truncate mb-0" style="font-size: 1em;"><?= $list['kode'] ?> | (<span class="list-rm"><?= $list['total_harga_ringgit'] ?></span>)</h6>
                  <div class="last-chat">
                    <p class="text-truncate mb-0" style="font-size: 1em;"> <?= $list['nama'] ?></p>
                  </div>
                </div>
                <hr>
                <div class="form-group">
                  Satuan: <span class="form-label list-rm"><?= $list['harga_ringgit'] ?></span>
                </div>
                <div class="form-group">
                  Total: <span class="form-label list-rm"><?= $list['total_harga_ringgit'] ?></span>
                </div>
                <div class="form-group">
                  Volume: <span class="form-label"><?= $list['jumlah_1'] ?></span>
                </div>
                <?php if ($list['input'] == 1) : ?>
                  <div class="form-group">
                    <label class="form-label" for="input-realisasi-<?= $list['id'] ?>">Volume Realisasi</label>
                    <input type="number" class="form-control input-jumlah-proposal" name="input-realisasi-<?= $list['id'] ?>" id="input-realisasi-<?= $list['id'] ?>" value="<?= $jumlah_1_realisasi ?>" data-id="<?= $list['id'] ?>" data-ringgit="<?= $list['harga_ringgit'] ?>" data-max="<?= $list['jumlah_1'] ?>" required>
                  </div>
                <?php else : ?>
                  <div class="form-group">
                    Volume Realisasi: <span class="form-label"><?= $list['jumlah_1_realisasi'] ?></span>
                  </div>
                <?php endif ?>
                <div class="form-group">
                  Total Realisasi: <span class="form-label list-rm" id="input-realisasi-total-<?= $list['id'] ?>"><?= isset($list['jumlah_ringgit']) ? $list['jumlah_ringgit'] : $list['total_harga_ringgit'] ?></span>
                  <input type="hidden" id="input-realisasi-total-val-<?= $list['id'] ?>">
                </div>
              </div>
            </label>
          <?php endforeach; ?>
        </div>

        <div class="d-flex flex-row-reverse">
          <div style="position:fixed; bottom:75px; z-index:999">
            <?php if ($proposal['status'] == 0) echo $btn_simpan; ?>
          </div>
        </div>
      </div>
    </form>
  </div>

  <!-- Static Backdrop Modal-->
  <div class="modal fade" id="ajukanModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ajukanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="" method="POST" id="form">
          <div class="modal-header">
            <h6 class="modal-title" id="ajukanModalLabel">Ajukan Proposal</h6>
            <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin akan mengajukan proposal ini ?</p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-sm btn-success" type="button" id="btn-ajukan-submit">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="hapusModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="" method="POST" id="form">
          <div class="modal-header">
            <h6 class="modal-title" id="hapusModalLabel">Hapus Proposal</h6>
            <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin akan menghapus proposal ini ?</p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-sm btn-danger" type="button" id="btn-hapus-submit">Yes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="batalModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="batalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="" method="POST" id="form-reset">
          <div class="modal-header">
            <h6 class="modal-title" id="batalModalLabel">Batal Pengajuan Proposal</h6>
            <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin akan Membatalkan Pengajuan proposal ini ?</p>
            <input type="hidden" name="id_proposal" value="<?= $id_proposal1 ?>">
          </div>
          <div class="modal-footer">
            <button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-sm btn-danger" type="submit" id="btn-batal-submit">Yes</button>
          </div>
        </form>
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
    const global_id_cabang = "<?= $id_cabang ?>";
    const global_id_proposal = "<?= $id_proposal ?>";
  </script>
  <!-- toast -->
  <script src="<?= base_url() ?>assets/js/default/toast.js"></script>
  <script src="<?= base_url() ?>assets/js/default/menu-active.js"></script>
  <script src="<?= base_url() ?>assets/page/rab/cabang/proposal-detail.js"></script>
</body>

</html>