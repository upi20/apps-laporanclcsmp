<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sesion
{

	public function cek_session()
	{
		$this->ci = &get_instance();

		if ($this->ci->session->userdata('status') == false) {
			redirect('login', 'refresh');
		}
	}

	public function cek_login()
	{
		$this->ci = &get_instance();

		if ($this->ci->session->userdata('status') == true) {
			redirect('home', 'refresh');
		}
	}
}
