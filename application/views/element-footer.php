<div class="footer-nav-area" id="footerNav">
  <div class="container px-0">
    <!-- Paste your Footer Content from here-->
    <!-- Footer Content-->
    <div class="footer-nav position-relative">

      <ul class="h-100 d-flex align-items-center justify-content-between ps-0" id="footer-menu">
        <li data-name="home"><a href="<?= base_url() ?>home">
            <i class="fa fa-suitcase fa-2x" aria-hidden="true"></i>
            <span>Dashboard</span></a>
        </li>
        <?php if ($this->session->userdata("data")['level'] == "Super Admin") : ?>
          <li data-name="cabang">
            <a href="<?= base_url() ?>cabang">
              <i class="fa fa-building fa-2x" aria-hidden="true"></i>
              <span>Cabang</span></a>
          </li>
        <?php endif ?>
        <li data-name="rab">
          <a href="<?= base_url() ?>rab">
            <i class="fa fa-list-ul fa-2x" aria-hidden="true"></i>
            <span>RAB</span></a>
        </li>
        <li data-name="realisasi">
          <a href="<?= base_url() ?>realisasi">
            <i class="fa fa-usd fa-2x" styl aria-hidden="true"></i>
            <span>Realisasi</span></a>
        </li>
        <?php if ($this->session->userdata("data")['level'] == "Super Admin") : ?>
          <li data-name="laporan">
            <a href="<?= base_url() ?>laporan">
              <i class="fa fa-book fa-2x" sty aria-hidden="true"></i>
              <span>Laporan</span></a>
          </li>
        <?php endif ?>
        <?php if ($this->session->userdata("data")['level'] == "Admin Sekolah") : ?>
          <li data-name="hutang">
            <a href="<?= base_url() ?>hutang">
              <i class="fa fa-calendar fa-2x" sty aria-hidden="true"></i>
              <span>Hutang</span></a>
          </li>
          <li data-name="rekap">
            <a href="<?= base_url() ?>rekap">
              <i class="fa fa-file-text-o fa-2x" sty aria-hidden="true"></i>
              <span>Rekap</span></a>
          </li>
        <?php endif ?>
        <li data-name="setting">
          <a href="<?= base_url() ?>setting/profile">
            <i class="fa fa-user fa-2x" sty aria-hidden="true"></i>
            <span>Profile</span></a>
        </li>
      </ul>
    </div>
  </div>
</div>