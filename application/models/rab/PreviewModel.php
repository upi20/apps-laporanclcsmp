<?php
defined('BASEPATH') or exit('No direct script access allowed');
class PreviewModel extends Render_Model
{
    public function getAllData($show = null, $start = null, $cari = null)
    {
        $exe                  = $this->db->select_sum('a.total_harga_ringgit')->select('b.kode as npsn, b.nama as nama_cabang, a.status as status')
            ->from(' rabs a')
            ->join(' cabangs b', ' a.id_cabang = b.id ', ' left ')
            ->join(' aktifitas c', ' a.id_aktifitas = c.id ', ' left ')
            ->group_by('b.kode')
            ->get();

        return $exe;
    }

    public function getAllDataDetail($show = null, $start = null, $cari = null, $npsn = null)
    {
        $exe                  = $this->db->select(' * , b.kode as npsn, b.nama as nama_cabang, a.nama as nama_aktifitas, a.status as statuss, a.kode as kodes')
            ->from(' rabs a')
            ->join(' cabangs b', ' a.id_cabang = b.id ', ' left ')
            ->join(' aktifitas c', ' a.id_aktifitas = c.id ', ' left ')
            ->where(' b.kode ', $npsn)
            ->get();

        return $exe;
    }

    public function getTotalHarga($npsn)
    {
        $exe                  = $this->db->select_sum('total_harga_ringgit')
            ->select('a.fungsi')
            ->from(' rabs a')
            ->join(' cabangs b', ' a.id_cabang = b.id ', ' left ')
            ->join(' aktifitas c', ' a.id_aktifitas = c.id ', ' left ')
            ->where(' b.kode ', $npsn)
            ->get()
            ->row_array();
        return $exe;
    }

    public function getTotalHargaRupiah($npsn)
    {
        $exe                  = $this->db->select_sum('total_harga_rupiah')
            ->from(' rabs a')
            ->join(' cabangs b', ' a.id_cabang = b.id ', ' left ')
            ->join(' aktifitas c', ' a.id_aktifitas = c.id ', ' left ')
            ->where(' b.kode ', $npsn)
            ->get()
            ->row_array();
        return $exe;
    }

    // admin ubah rab clc ================================================================================================
    public function getIdCabang($npsn)
    {
        $result = $this->db->select("id as id_cabang, nama, user_id")->from("cabangs")->where(['kode' => $npsn])->get()->row_array();
        return isset($result['id_cabang']) ? $result : ['id_cabang' => 0, 'nama' => '', 'user_id' => 0];
    }
    public function ubahGetAllData($show = null, $start = null, $cari = null, $status = null, $id_user)
    {
        $exe                  = $this->db->select(' * ,b.nama as nama_cabang, a.nama as nama_aktifitas, a.status as statuss, a.kode as kodes, a.id')
            ->from(' rabs a')
            ->join(' cabangs b', ' a.id_cabang = b.id ', ' left ')
            ->join(' aktifitas c', ' a.id_aktifitas = c.id ', ' left ')
            ->where(['b.user_id' => $id_user])
            ->get();
        return $exe;
    }

    public function checkStatus()
    {
        $exe = $this->db->select('*')
            ->from('setting_rabs a')
            ->where('a.tanggal_mulai <= ', date('Y-m-d'))
            ->where('a.tanggal_akhir >= ', date('Y-m-d'))
            ->where('a.status', 1)
            ->get();
        return $exe;
    }
}
