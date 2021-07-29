<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Realisasi extends Render_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->sesion->cek_session();
        $this->cabangdetail = $this->db->get_where('cabangs', ['user_id' => $this->session->userdata('data')['id']])->row_array();
        $this->id_cabang = $this->cabangdetail['id'];
        $this->load->model("realisasi/DanaRabModel", 'realisasi');
    }

    public function index()
    {
        if ($this->session->userdata("data")['level'] == "Super Admin") {
            $this->load->view("realisasi/admin/index");
        } else if ($this->session->userdata("data")['level'] == "Admin Sekolah") {
            $get_status = $this->db->select('a.fungsi, a.status, b.nama, b.id as id_cabang, b.kode')
                ->join('cabangs b', 'b.id = a.id_cabang')
                ->get_where('rabs a', ['b.user_id' => $this->session->userdata('data')['id']])
                ->row_array();
            if ($get_status == null) {
                $this->load->model("rab/ClcModel", 'clc');
                $getCabang = $this->clc->getIdCabang();

                $get_status = [
                    'fungsi' => '0',
                    'status' => null,
                    'id_cabang' => $getCabang['id_cabang'],
                    'nama' => $getCabang['nama'],
                    'kode' => $getCabang['kode']
                ];
            }

            $status = $get_status['status'];
            $cabang = $get_status['nama'];
            $data['status'] = $status;
            $data['npsn'] = $get_status['kode'];
            if ($status == 0) {
                $status = 'Proses';
            } elseif ($status == 1) {
                $status = 'Ajukan';
            } elseif ($status == 2) {
                $status = 'Terima';
            } elseif ($status == 3) {
                $status = 'Tolak';
            } elseif ($status == 4) {
                $status = 'Dicairkan';
            } else {
                $status = '';
            }

            $data['fungsi'] = $get_status['fungsi'];
            $data['id_cabang'] = $get_status['id_cabang'];
            $data['title'] = "RAB CLC $cabang - (Status: $status)";
            $kurs = $this->db->get('kurs')->row_array();
            $data['kurs'] = isset($kurs['rupiah']) ? $kurs['rupiah'] : 3500;
            $this->load->view("realisasi/cabang/index", $data);
        } else {
            redirect("login");
        }
    }

    public function ajax_data()
    {
        $npsn = $this->input->post('npsn');
        $start = $this->input->post('start');
        $draw = $this->input->post('draw');
        $length = $this->input->post('length');
        $cari = $this->input->post('search');
        if (isset($cari['value'])) {
            $_cari = $cari['value'];
        } else {
            $_cari = null;
        }
        $data = $this->realisasi->getAllDataDetail($length, $start, $_cari, $npsn)->result_array();
        $count = count($data);

        array($cari);
        $this->output_json(array('recordsTotal' => $count, 'recordsFiltered' => $count, 'draw' => $draw, 'search' => $_cari, 'data' => $data));
    }

    public function insertUpload()
    {
        $this->output_json(['name' => $this->realisasi->uploadImage()]);
    }

    public function insert()
    {
        $saldos = false;
        $rabs = false;
        $datas = json_decode($this->input->post('data'), true);
        $id_cabang = $datas['id_cabang'];

        foreach ($datas['realisasi'] as $id => $v) {
            // Input values
            $nama = $datas['nama'];
            $keterangan = $datas['keterangan'];
            $tanggal = $datas['tanggal'];
            $gambar = $datas['gambar'];

            $harga_rupiah = $v['harga_rupiah'];
            $harga_ringgit = $v['harga_ringgit'];

            $real_harga_rupiah = $v['real_harga_rupiah'];
            $real_harga_ringgit = $v['real_harga_ringgit'];

            $sisa_ringgit = $v['sisa_ringgit'];
            $sisa_rupiah = $v['sisa_rupiah'];

            $volume = $v['vol_realisasi'];
            $volume_sisa = $v['vol_realisasi_sisa'];

            // Check values
            if (empty($nama)) {
                $this->output_json(['message' => 'Nama tidak boleh kosong']);
            }

            // insert realisasi
            $realisasis = $this->realisasi->insert($id, $id_cabang, $nama, $keterangan, $harga_ringgit, $harga_rupiah, $tanggal, $gambar, $sisa_ringgit, $sisa_rupiah, $real_harga_rupiah, $real_harga_ringgit, $volume);

            // update rabs
            // get vol_realisasi sebelumnya
            $get = $this->db->select("vol_realisasi")
                ->from('rabs')
                ->where('id', $id)
                ->get()
                ->row_array();
            $this->db->reset_query();
            $this->db->where('id', $id);
            $rabs = $this->db->update('rabs', ['vol_realisasi' => ($get['vol_realisasi'] + $volume), 'vol_realisasi_sisa' => $volume_sisa]);
        }

        // update saldo
        $get_saldo = $this->db->get_where('saldos', ['id_cabang' => $id_cabang])->row_array();
        $total_saldo_ringgit = $get_saldo['total_ringgit'];
        $total_saldo_rupiah = $get_saldo['total_rupiah'];

        $update_saldo['total_ringgit'] = (float)($total_saldo_ringgit) - (float)($datas['total_ringgit']);
        $update_saldo['total_rupiah'] = (float)($total_saldo_rupiah) - (float)($datas['total_rupiah']);
        $this->db->where('id_cabang', $id_cabang);
        $saldos = $this->db->update('saldos', $update_saldo);

        $this->output_json(
            [
                'result' => $rabs && $saldos && $realisasis,
            ]
        );
    }

    public function getDetailRealisasi()
    {
        $id = $this->input->post('id');

        $get = $this->db->select('(b.jumlah_1 * b.jumlah_2 * b.jumlah_3 * b.jumlah_4) as anggaran_volume, b.harga_ringgit as anggaran_satuan,  b.total_harga_ringgit as anggaran_total_rm, b.total_harga_rupiah as anggaran_total_rp, a.volume as realisasi_volume, a.real_harga_ringgit as realisasi_satuan, a.harga_ringgit as realisasi_total_rm, a.harga_rupiah as realisasi_total_rp, b.kode, a.nama, b.nama as title_nama, a.tanggal, a.keterangan, a.gambar, a.id')
            ->join('rabs b', 'b.id = a.id_rab')
            ->get_where('realisasis a', ['a.id_rab' => $id])
            ->result_array();
        $this->output_json($get);
    }
}