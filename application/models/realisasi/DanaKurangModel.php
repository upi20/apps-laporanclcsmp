<?php
defined('BASEPATH') or exit('No direct script access allowed');
class DanaKurangModel extends Render_Model
{
    public function getAllDataDanaKurang($npsn = null, $id_cabang = null)
    {
        $cek = $this->db->select('a.status')
            ->join('cabangs b', 'a.id_cabang = b.id')
            ->limit(1)
            ->get_where('rabs a', ['a.id_cabang' => $id_cabang])
            ->row_array();

        if (isset($cek['status'])) {
            if ($cek['status'] == 0 or $cek['status'] == 1 or $cek['status'] == 3) {
                $status = 2;
            } else {
                $status = $cek['status'];
            }
        } else {
            $status = 0;
        }

        $this->db->select(' * ,z.id_cabang as asu, b.kode as npsn, b.nama as nama_cabang, a.nama as nama_aktifitas, a.status as statuss, a.kode as kodes,z.id as id_realisasi, a.id, z.sisa_ringgit, z.sisa_rupiah');
        $this->db->from(' rabs  a');
        $this->db->join(' realisasis z ', ' a.id = z.id_rab ', ' left ');
        $this->db->join(' cabangs b', ' a.id_cabang = b.id ', ' left ');
        $this->db->join(' aktifitas c', ' a.id_aktifitas = c.id ', ' left ');
        $this->db->where(' z.sisa_ringgit < 0');
        $this->db->where(' a.status ', $status);
        if ($npsn != null) {
            $this->db->where(' b.kode ', $npsn);
        }
        if ($id_cabang != null) {
            $this->db->where('z.id_cabang', $id_cabang);
        }

        $this->db->order_by('a.kode', 'asc');

        return $this->db->get();
    }
}
