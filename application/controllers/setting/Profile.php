<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends Render_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->sesion->cek_session();
        $this->load->model("setting/ProfileModel", 'profile');
        $this->cabangdetail = $this->db->get_where('cabangs', ['user_id' => $this->session->userdata('data')['id']])->row_array();
        $this->id_cabang                 = $this->cabangdetail['id'];
    }

    public function index()
    {
        if ($this->session->userdata("data")['level'] == "Admin Sekolah") {
            $data['user_id'] = $this->session->userdata('data')['id'];
            $this->load->view("setting/cabang/profile", $data);
        } else {
            redirect("login");
        }
    }

    public function ajax_data()
    {
        $id_user = $this->input->post("user_id");
        $this->output_json($this->profile->getDataUser($id_user));
    }

    public function update()
    {
        $data = [];
        $id = $this->input->post("id");
        foreach ($this->input->post() as $k => $val) {
            if ($k != 'id') {
                $data[$k] = $val;
            }
        }

        $result = $this->profile->updateDataCabang($id, $data);
        $this->output_json($result);
    }
    // cek current password
    public function cek_password()
    {
        $id_cabang = $this->input->post("id_cabang");
        $id_cabang = ($id_cabang == null) ? $this->id_cabang : $id_cabang;
        $current_password = $this->input->post("current_password");
        $result = $this->profile->cekPpassword($id_cabang, $current_password);
        $this->output_json($result);
    }

    // update
    public function update_password()
    {
        $id_cabang = $this->input->post("id_cabang");
        $id_cabang = ($id_cabang == null) ? $this->id_cabang : $id_cabang;
        $new_password = $this->input->post("new_password");
        $result = $this->profile->updatePassword($id_cabang, $new_password);
        $this->output_json($result);
    }
}
