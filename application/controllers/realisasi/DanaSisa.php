<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DanaSisa extends Render_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->sesion->cek_session();
        $this->cabangdetail = $this->db->get_where('cabangs', ['user_id' => $this->session->userdata('data')['id']])->row_array();
        $this->id_cabang                 = $this->cabangdetail['id'];
        $this->load->model("realisasi/DanaRabModel", 'realisasi');
        $this->load->model("realisasi/danaSisaModel", 'sisa');
    }

    public function index()
    {
        $get_cabang             = $this->db->get_where('cabangs', ['user_id' => $this->session->userdata('data')['id']])->row_array();
        $id_cabang                 = $get_cabang['id'];
        $npsn                     = $get_cabang['kode'];
        $cabang                 = $get_cabang['nama'];

        $get_status                = $this->db->get_where('rabs', ['id_cabang' => $id_cabang])->row_array();
        $data['kode']        = $this->realisasi->getAllData(null, null, null, $npsn)->result_array();
        $data['status']    = isset($get_status['status']) ? $get_status['status'] : 0;
        $data['npsn']      = $npsn;
        $data['cabang']      = str_replace('%20', ' ', $cabang);
        $data['total']    = $this->realisasi->getTotalHarga($npsn);
        $data['kodeNPSN'] = $this->realisasi->getDataKodeNPSN($id_cabang);
        $data['id_cabang'] = $id_cabang;
        $this->load->view("realisasi/cabang/danasisa", $data);
    }

    public function ajax_data()
    {
        $npsn     = $this->input->post('npsn');
        $start     = $this->input->post('start');
        $draw     = $this->input->post('draw');
        $length = $this->input->post('length');
        $cari     = $this->input->post('search');
        if (isset($cari['value'])) {
            $_cari = $cari['value'];
        } else {
            $_cari = null;
        }
        $data     = $this->sisa->getAllDataDanaSisa($length, $start, $_cari, $npsn)->result_array();
        $count     = count($data);

        array($cari);
        $this->output_json(array('recordsTotal' => $count, 'recordsFiltered' => $count, 'draw' => $draw, 'search' => $_cari, 'data' => $data));
    }

    public function cek_kode()
    {
        $kode = $this->input->post('kode');
        $id_cabang = $this->input->post('id_cabang');
        $data = $this->db->get_where('rabs', ['kode' => $kode, 'id_cabang' => $id_cabang])->row_array();
        $this->output_json($data);
    }

    public function insertSisa()
    {
        $datas = json_decode($this->input->post('data'));
        $result = true;
        $sisa_harga_ringgit = 0;
        $sisa_harga_rupiah = 0;

        for ($i = 0; $i < count($datas->id_realisasi); $i++) {
            $id_realisasi    = $datas->id_realisasi[$i];
            $id_rab         = $datas->id_rab[$i];
            $id_cabang        = $datas->id_cabang;
            $sisa_ringgit    = $datas->sisa_ringgit[$i];
            $sisa_rupiah     = $datas->sisa_rupiah[$i];
            $kategori         = $datas->kategori;
            $keterangan     = $datas->keterangan;

            $ringgit        = $datas->ringgit;
            $rupiah            = $datas->rupiah;

            // assignment dana sisa
            $sisa_harga_ringgit += $sisa_ringgit;
            $sisa_harga_rupiah += $sisa_rupiah;

            $jumlah_ringgit    = $ringgit + $sisa_harga_ringgit;
            $jumlah_rupiah    = $rupiah + $sisa_harga_rupiah;

            // Check values
            if (empty($nama)) $this->output_json(['message' => 'Nama tidak boleh kosong']);

            $r = $this->realisasi->insertSisa($id_realisasi, $sisa_ringgit, $sisa_rupiah, $kategori, $id_rab, $jumlah_ringgit, $jumlah_rupiah, $keterangan);


            if ($r !== FALSE) {
                // query manual code diatas tidak jalan
                $result = $this->db->query("UPDATE realisasis SET sisa_rupiah = '0',sisa_ringgit = '0' WHERE realisasis.id = '$id_realisasi'");
            } else {
                $result = false;
            }
        }

        if ($result) {
            if ($datas->kategori == "rab") {
                // simpan rabs baru
                $total_harga_ringgit = $sisa_harga_ringgit + $datas->ringgit;
                $total_harga_rupiah = $sisa_harga_rupiah + $datas->rupiah;
                $this->db->query("UPDATE rabs SET total_harga_ringgit = '$total_harga_ringgit',total_harga_rupiah = '$total_harga_rupiah' WHERE id = '$datas->id_rab_to'");
            } else {
                $get_status = $this->db->limit(1)->get_where('rabs', ['id_cabang' => $datas->id_cabang])->row_array();
                $id_cabang                         = $datas->id_cabang;
                $id_aktifitas                    = $datas->non_rab->id_aktifitas;
                $id_aktifitas_sub                = $datas->non_rab->id_aktifitas_sub;
                $id_aktifitas_cabang            = $datas->non_rab->id_aktifitas_cabang;
                $kode_isi_1                     = $datas->non_rab->kode_isi_1;
                $kode_isi_2                     = $datas->non_rab->kode_isi_2;
                $kode_isi_3                     = $datas->non_rab->kode_isi_3;
                $kode                             = $datas->non_rab->kode;
                $nama                             = $datas->non_rab->nama;
                $jumlah_1                         = $datas->non_rab->jumlah_1;
                $satuan_1                         = $datas->non_rab->satuan_1;
                $jumlah_2                         = $datas->non_rab->jumlah_2;
                $satuan_2                         = $datas->non_rab->satuan_2;
                $jumlah_3                         = $datas->non_rab->jumlah_3;
                $satuan_3                         = $datas->non_rab->satuan_3;
                $jumlah_4                         = $datas->non_rab->jumlah_4;
                $satuan_4                         = $datas->non_rab->satuan_4;
                $harga_ringgit                     = $datas->non_rab->harga_ringgit;
                $harga_rupiah                     = $datas->non_rab->harga_rupiah;
                $total_harga_ringgit             = $datas->non_rab->total_harga_ringgit;
                $total_harga_rupiah                = $datas->non_rab->total_harga_rupiah;
                $prioritas                         = $datas->non_rab->prioritas;
                $status                         = $get_status['status'];
                $keterangan                     = $datas->non_rab->keterangan;
                $fungsi                         = 1;
                $result                            = $this->sisa->insertDanaSisa($id_cabang, $id_aktifitas, $id_aktifitas_sub, $id_aktifitas_cabang, $kode_isi_1, $kode_isi_2, $kode_isi_3, $kode, $nama, $jumlah_1, $satuan_1, $jumlah_2, $satuan_2, $jumlah_3, $satuan_3, $jumlah_4, $satuan_4, $harga_ringgit, $harga_rupiah, $total_harga_ringgit, $total_harga_rupiah, $prioritas, $status, $keterangan, $fungsi);
            }
        }
        $this->output_json(
            [
                'result' => $result,
            ]
        );
    }
}
