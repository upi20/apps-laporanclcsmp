<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProfileModel extends Render_Model
{
    public function getDataUser($id)
    {
        $this->db->select('a.id, a.user_nama, a.id_jabatan, a.user_tanggal_lahir, a.user_alamat, a.user_photo, a.user_phone, a.mulai_bekerja,  b.nama as jabatan_nama, b.id_perusahaan');
        $this->db->from('users as a');
        $this->db->join('jabatans as b', 'a.id_jabatan = b.id', 'left');
        $this->db->where(['a.id' => $id]);
        return $this->db->get()->row_array();
    }

    public function getDataPerusahaans()
    {
        $this->db->select('a.id, a.nama');
        $this->db->from('perusahaans as a');

        return $this->db->get()->result_array();
    }

    public function getDataJabatans($id_perusahaan = null)
    {
        $this->db->select('a.id, a.nama');
        $this->db->from('jabatans as a');
        if ($id_perusahaan) $this->db->where(['id_perusahaan' => $id_perusahaan]);
        return $this->db->get()->result_array();
    }

    public function update($data)
    {
        try {
            $id = $data['id'];
            $data = [
                'user_nama' => $data['user_nama'],
                'user_tanggal_lahir' => $data['user_tanggal_lahir'],
                'user_alamat' => $data['user_alamat'],
                'user_phone' => $data['user_phone'],
                'mulai_bekerja' => $data['mulai_bekerja'],
                'id_jabatan' => $data['id_jabatan']
            ];
            $this->db->update('users', $data);
            $this->db->where('id', $id);
            return ['status' => true, 'num' => $this->db->affected_rows()];
        } catch (\Throwable $th) {
            return ['status' => true, 'num' => ''];
        }
    }
}
