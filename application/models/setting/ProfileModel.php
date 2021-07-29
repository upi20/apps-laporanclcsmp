<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ProfileModel extends Render_Model
{
    public function getDataUser($user_id = null)
    {
        $result = null;
        if ($user_id) {
            $result = $this->db->get_where('cabangs', ['user_id' => $user_id])->row_array();
        } else {
            $result = $this->db->get_where('cabangs', ['user_id' => $this->session->userdata('data')['id']])->row_array();
        }
        return $result;
    }

    public function updateDataCabang($id, $data)
    {
        return $this->db
            ->set($data)
            ->where('id', $id)
            ->update('cabangs');
    }

    public function cekPpassword($id_cabang, $current_password)
    {
        $password = $this->db->select("b.user_password")->from('cabangs a')->join("users b", "a.user_id = b.user_id")->where('a.id', $id_cabang)->get()->row_array();
        if ($password == null) {
            $cek = false;
        } else {
            $cek = $this->b_password->hash_check($current_password, $password['user_password']);
        }
        return $cek;
    }

    public function updatePassword($id_cabang, $new_password)
    {
        $user = $this->db->select("b.user_id")->from('cabangs b')->where('b.id', $id_cabang)->get()->row_array();
        if ($user == null) {
            $cek = false;
        } else {
            // update action
            $new_password_hash = $this->b_password->bcrypt_hash($new_password);
            $this->db->where('user_id', $user['user_id']);
            $cek = $this->db->update('users', ['user_password' => $new_password_hash]);
        }
        return $cek;
    }
}
