<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Preview extends Render_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->sesion->cek_session();
        $this->load->model("rab/PreviewModel", 'preview');
        $this->load->model("rab/ClcModel", 'clc');
        $this->cabangdetail = $this->db->get_where('cabangs', ['user_id' => $this->session->userdata('data')['id']])->row_array();
        $this->id_cabang                 = $this->cabangdetail['id'];
    }

    public function index()
    {

        if ($this->session->userdata("data")['level'] == "Admin Sekolah") {
            $get_status = $this->db->select('a.fungsi, a.status, b.nama, b.id as id_cabang, b.kode')
                ->join('cabangs b', 'b.id = a.id_cabang')
                ->get_where('rabs a', ['b.user_id' => $this->session->userdata('data')['id']])
                ->row_array();
            if ($get_status == null) {
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
            $data['title']                     = "RAB CLC $cabang - (Status: $status)";
            $this->load->view("rab/cabang/preview", $data);
        } else {
            redirect("login");
        }
    }

    public function tindakan($npsn = null, $status = null)
    {
        if ($npsn != null) {
            $get_cabang = $this->db->get_where('cabangs', ['kode' => $npsn])->row_array();
            $id_cabang  = $get_cabang['id'];

            $upd['status'] = $status;
            if ($status == 1) {
                $fungsi = 1;
            } else if ($status == 2) {
                $fungsi = 1;
            } else if ($status == 3) {
                $fungsi = 1;
            } else {
                $fungsi = 0;
            }
            $upd['fungsi'] = $fungsi;
            $exe = $this->db->where('id_cabang', $id_cabang);
            $exe = $this->db->update('rabs', $upd);

            if ($exe) {
                $get_total = $this->preview->getTotalHarga($npsn);
                $get_total2 = $this->preview->getTotalHargaRupiah($npsn);
                $total_ringgit = $get_total['total_harga_ringgit'];
                $total_rupiah = $get_total2['total_harga_rupiah'];
                if ($status == 2) {
                    $saldo['id_cabang'] = $id_cabang;
                    $saldo['total_ringgit'] = 0;
                    $saldo['total_rupiah'] = 0;
                    $saldo['status'] = 'aktif';
                    $saldo['created_date'] = date("Y-m-d H:i:s");
                    $this->db->insert('saldos', $saldo);
                } else if ($status == 4) {
                    $cek2 = $this->db->get_where('saldos', ['id_cabang' => $id_cabang])->num_rows();
                    if ($cek2 > 0) {
                        $saldo['total_ringgit'] = $total_ringgit;
                        $saldo['total_rupiah'] = $total_rupiah;
                        $saldo['created_date'] = date("Y-m-d H:i:s");
                        $this->db->where('id_cabang', $id_cabang);
                        $this->db->update('saldos', $saldo);

                        $saldo_pemasukan['id_user'] = $this->session->userdata('data')['id'];
                        $saldo_pemasukan['id_cabang'] = $id_cabang;
                        $saldo_pemasukan['id_rab'] = 0;
                        $saldo_pemasukan['keterangan'] = 'sudah dicairkan';
                        $saldo_pemasukan['total_ringgit'] = $total_ringgit;
                        $saldo_pemasukan['total_rupiah'] = $total_rupiah;
                        $saldo_pemasukan['status'] = 'aktif';
                        $saldo_pemasukan['created_date'] = date("Y-m-d H:i:s");
                        $this->db->insert('saldo_pemasukans', $saldo_pemasukan);
                    } else {
                        $saldo['id_cabang'] = $id_cabang;
                        $saldo['total_ringgit'] = $total_ringgit;
                        $saldo['total_rupiah'] = $total_rupiah;
                        $saldo['status'] = 'aktif';
                        $saldo['created_date'] = date("Y-m-d H:i:s");
                        $this->db->insert('saldos', $saldo);

                        $saldo_pemasukan['id_user'] = $this->session->userdata('data')['id'];
                        $saldo_pemasukan['id_cabang'] = $id_cabang;
                        $saldo_pemasukan['id_rab'] = 0;
                        $saldo_pemasukan['keterangan'] = 'sudah dicairkan';
                        $saldo_pemasukan['total_ringgit'] = $total_ringgit;
                        $saldo_pemasukan['total_rupiah'] = $total_rupiah;
                        $saldo_pemasukan['status'] = 'aktif';
                        $saldo_pemasukan['created_date'] = date("Y-m-d H:i:s");
                        $this->db->insert('saldo_pemasukans', $saldo_pemasukan);
                    }
                }
                echo "<script>alert('RAB berhasil diproses')</script>";
                redirect('rab/preview', 'refresh');
            } else {
                echo "<script>alert('Gagal diproses')</script>";
                redirect('rab/preview', 'refresh');
            }
        } else {
            echo "<script>alert('NPSN tidak ada')</script>";
            redirect('rab/preview', 'refresh');
        }
    }
}
