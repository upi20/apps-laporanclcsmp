<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cabang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->sesion->cek_session();
    }
    public function index()
    {
        if ($this->session->userdata("data")['level'] == "Super Admin") {
            $this->load->view("cabang/admin/index");
        } else {
            redirect("login");
        }
    }
}
