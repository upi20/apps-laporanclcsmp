<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rab extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->sesion->cek_session();
    }
    public function index()
    {
        $this->load->model("rab/ClcModel", 'clc');
        if ($this->session->userdata("data")['level'] == "Super Admin") {
            $this->load->view("rab/admin/index");
        } else if ($this->session->userdata("data")['level'] == "Admin Sekolah") {
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
            $this->load->view("rab/cabang/index", $data);
        } else {
            redirect("login");
        }
    }
}
