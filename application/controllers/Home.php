<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// Cek session
		$this->sesion->cek_session();
		$this->load->model("HomeModel", 'dashboard');
		$this->load->library('libs');
	}
	public function index()
	{
		if ($this->session->userdata("data")['level'] == "Super Admin") {
			$data['realisasi'] = $this->db->select_sum('harga_ringgit')->select_sum('harga_rupiah')->get_where('realisasis', [])->row_array();
			$data['saldo'] = $this->db->select_sum('total_ringgit')->select_sum('total_rupiah')->get_where('saldos', [])->row_array();
			$data['rab'] = $this->db->select_sum('total_harga_ringgit')->select_sum('total_harga_rupiah')->get_where('rabs', [])->row_array();
			$data['dialihkan'] = $this->db->select_sum('a.jumlah_ringgit')->select_sum('a.jumlah_rupiah')->join('realisasis b', 'b.id = a.id_realisasi')->get_where('pindah_danas a', [])->row_array();
			$this->load->view('dashboard/admin/index', $data);
		} else if ($this->session->userdata("data")['level'] == "Admin Sekolah") {
			$get_cabang = $this->db->get_where('cabangs', ['user_id' => $this->session->userdata('data')['id']])->row_array();
			$data['profil'] = $get_cabang;
			$data['realisasi'] = $this->db->select_sum('harga_ringgit')->select_sum('harga_rupiah')->get_where('realisasis', ['id_cabang' => $get_cabang['id']])->row_array();
			$data['saldo'] = $this->db->select_sum('total_ringgit')->select_sum('total_rupiah')->get_where('saldos', ['id_cabang' => $get_cabang['id']])->row_array();
			$data['rab'] = $this->db->select_sum('total_harga_ringgit')->select_sum('total_harga_rupiah')->get_where('rabs', ['id_cabang' => $get_cabang['id']])->row_array();
			$data['dialihkan'] = $this->db->select_sum('a.jumlah_ringgit')->select_sum('a.jumlah_rupiah')->join('realisasis b', 'b.id = a.id_realisasi')->get_where('pindah_danas a', ['b.id_cabang' => $get_cabang['id']])->row_array();
			// hutang
			$id_cabang = $get_cabang['id'];
			$data['hutang'] = $this->db->select_sum('a.jumlah')->get_where('hutang a', " (id_cabang = '$id_cabang') and  (status='0') ")->row_array();
			$this->load->view('dashboard/cabang/index', $data);
		} else {
			redirect("login");
		}
	}
}
