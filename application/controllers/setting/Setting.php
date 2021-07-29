<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends Render_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->sesion->cek_session();
        $this->load->model("setting/ProfileModel", 'profile');
    }
    public function index()
    {

        if ($this->session->userdata("data")['level'] == "Super Admin") {
            $this->load->view("setting/admin/index");
        } else if ($this->session->userdata("data")['level'] == "Admin Sekolah") {
            $this->load->view("setting/cabang/index");
        } else {
            redirect("login");
        }
    }

    public function profile()
    {
        if ($this->session->userdata("data")['level'] == "Admin Sekolah") {
            $data['user_id'] = $this->session->userdata('data')['id'];
            $this->load->view("setting/cabang/profile", $data);
        } else {
            redirect("login");
        }
    }

    public function ajax_profile()
    {
        $id_user = $this->input->post("user_id");
        $this->output_json($this->profile->getDataUser($id_user));
    }
}
