<?php
defined('BASEPATH') or exit('No direct script access allowed');
class DanaSisaModel extends Render_Model
{
    public function getAllDataDanaSisa($show = null, $start = null, $cari = null, $npsn = null)
    {
        if ($this->session->userdata('data')['level'] == 'Super Admin') {
            if ($npsn == null) {
                $exe = $this->db->query("SELECT sum(a.sisa_ringgit) as sisa_ringgit, sum(a.sisa_rupiah) as sisa_rupiah, a.id_cabang, b.kode, b.user_id, b.nama FROM realisasis a join cabangs b on a.id_cabang = b.id WHERE a.sisa_ringgit > 0 GROUP BY a.id_cabang");
            } else {
                $exe = $this->getAllDataDanaSisaAction($npsn);
            }
        } else {
            $exe = $this->getAllDataDanaSisaAction($npsn);
        }

        return $exe;
    }

    private function getAllDataDanaSisaAction($npsn)
    {
        $cek = $this->db->select('a.status')->join('cabangs b', 'a.id_cabang = b.id')->limit(1)->get_where('rabs a', ['b.kode' => $npsn])->row_array();
        if ($cek['status'] == 0 or $cek['status'] == 1 or $cek['status'] == 3) {
            $status = 2;
        } else {
            $status = $cek['status'];
        }
        return $this->db->select(' * , b.kode as npsn, b.nama as nama_cabang, a.nama as nama_aktifitas, a.status as statuss, a.kode as kodes,z.id as id_realisasi, a.id, z.sisa_ringgit, z.sisa_rupiah, (z.sisa_ringgit + z.harga_ringgit) as total_harga_ringgit, (z.sisa_rupiah + z.harga_rupiah) as total_harga_rupiah')
            ->from(' rabs  a')
            ->join(' realisasis z ', ' a.id = z.id_rab ', ' left ')
            ->join(' cabangs b', ' a.id_cabang = b.id ', ' left ')
            ->join(' aktifitas c', ' a.id_aktifitas = c.id ', ' left ')
            ->where(' b.kode ', $npsn)
            ->where(' z.sisa_ringgit > 0')
            ->where(' a.status ', $status)
            ->get();
    }


    public function insertDanaSisa($id_cabang, $id_aktifitas, $id_aktifitas_sub, $id_aktifitas_cabang, $kode_isi_1 = 0, $kode_isi_2 = 0, $kode_isi_3 = 0, $kode, $nama, $jumlah_1, $satuan_1, $jumlah_2, $satuan_2, $jumlah_3, $satuan_3, $jumlah_4, $satuan_4, $harga_ringgit, $harga_rupiah, $total_harga_ringgit, $total_harga_rupiah, $prioritas, $status, $keterangan, $fungsi)
    {
        $data['id_cabang']            = $id_cabang;
        $data['id_aktifitas']        = $id_aktifitas_sub;
        $data['kode_isi_1']            = $id_aktifitas_cabang;
        $data['kode_isi_2']         = $kode_isi_1;
        $data['kode_isi_3']         = $kode_isi_2;
        $data['kode']                 = $kode;
        $data['nama']                 = $nama;
        $data['jumlah_1']             = $jumlah_1;
        $data['satuan_1']             = $satuan_1;
        $data['jumlah_2']             = $jumlah_2;
        $data['satuan_2']             = $satuan_2;
        $data['jumlah_3']             = $jumlah_3;
        $data['satuan_3']             = $satuan_3;
        $data['jumlah_4']             = $jumlah_4;
        $data['satuan_4']             = $satuan_4;
        $data['harga_ringgit']         = $harga_ringgit;
        $data['harga_rupiah']        = $harga_rupiah;
        $data['total_harga_ringgit'] = $total_harga_ringgit;
        $data['total_harga_rupiah']    = $total_harga_rupiah;
        $data['prioritas']            = $prioritas;
        $data['status']                = $status;
        $data['keterangan']            = $keterangan;
        $data['fungsi']                = $fungsi;

        // prioritas tidak di pakai di buat null
        $data['prioritas']            = null;
        $exe                         = $this->db->insert('rabs', $data);
        $exe                         = $this->db->insert_id();

        return $exe;
    }
}