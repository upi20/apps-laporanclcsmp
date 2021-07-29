<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends Render_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('loginModel', 'login');
	}

	public function index()
	{
		$this->sesion->cek_login();
		$this->load->view('login');
	}

	public function doLogin()
	{
		$username 	= $this->input->post('email');
		$password 	= $this->input->post('password');

		// Cek login ke model
		$login 		= $this->login->cekLogin($username, $password);


		if ($login['status'] == 0) {
			// Set session value
			$session = array(
				'status' => true,
				'data'	 => array(
					'id' => $login['data'][0]['user_id'],
					'nama' => $login['data'][0]['user_nama'],
					'email' => $login['data'][0]['user_email'],
					'level' => $login['data'][0]['lev_nama'],
					'level_id' => $login['data'][0]['lev_id'],
				)
			);

			$this->session->set_userdata($session);

			$this->output_json(['status' => 0]);
		} else if ($login['status'] == 1) {
			$this->output_json(['status' => 1]);
		} else {
			$this->output_json(['status' => 2]);
		}
	}

	public function logout()
	{
		$session = array('status', 'data');

		$this->session->unset_userdata($session);

		redirect('login', 'refresh');
	}
}
