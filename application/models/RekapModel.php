<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RekapModel extends Render_Model
{


    public function getAllData($show = null, $start = null, $cari = null, $filter_data_kode = null, $filter_data_tanggal = null, $filter_data_cabang = null)
    {
        // cek proposal acc terbaru
        $id_proposal = $this->db->query("SELECT id FROM `proposal` WHERE (`proposal`.`status` = '4') and (`proposal`.`id_cabang` = '$filter_data_cabang')  ORDER BY `proposal`.`tanggal` DESC")->row_array();

        // where tambah join
        $tanggal_proposal = 'a.tanggal';
        if ($id_proposal) {
            $tanggal_proposal = "a.tanggal_administrasi as tanggal";
        }

        $this->db->select("$tanggal_proposal, a.id, c.kode, a.nama as uraian, d.nama, d.kode as npsn, a.harga_ringgit, a.harga_rupiah");
        $this->db->from(' realisasis a ');
        $this->db->join(' rabs b ', ' a.id_rab = b.id ', ' left ');
        $this->db->join('aktifitas c', 'b.id_aktifitas = c.id', 'left');
        $this->db->join('cabangs d', 'b.id_cabang = d.id');
        $this->db->order_by('a.id', 'asc');

        if ($filter_data_kode != null) {
            $this->db->like('b.kode', $filter_data_kode, 'after');
        }

        if ($filter_data_tanggal != null) {
            $tanggals = json_decode($filter_data_tanggal);
            $start = $tanggals->start;
            $end = $tanggals->end;
            $this->db->where("(a.tanggal BETWEEN '$start' and '$end')");
        }
        if ($filter_data_cabang != null) {
            $this->db->where('d.id', $filter_data_cabang);
        }

        return $this->db->get();
    }
    public function getAllDataCetak($show = null, $start = null, $cari = null, $filter_data_kode = null, $filter_data_tanggal = null, $filter_data_cabang = null)
    {
        // cek proposal acc terbaru
        $id_proposal = $this->db->query("SELECT id FROM `proposal` WHERE (`proposal`.`status` = '4') and (`proposal`.`id_cabang` = '$filter_data_cabang')  ORDER BY `proposal`.`tanggal` DESC")->row_array();

        // where tambah join
        $tanggal_proposal = 'a.tanggal';
        if ($id_proposal) {
            $tanggal_proposal = "a.tanggal_administrasi as tanggal";
        }

        $this->db->select("a.harga_ringgit, $tanggal_proposal, b.id_aktifitas, a.nama as uraian, c.kode");
        $this->db->from(' realisasis a ');
        $this->db->join(' rabs b ', ' a.id_rab = b.id  ', ' left ');
        $this->db->join('aktifitas c', 'c.id = b.id_aktifitas', 'left');

        $this->db->join('cabangs d', 'b.id_cabang = d.id');
        $this->db->order_by('a.id', 'asc');

        if ($filter_data_kode != null) {
            $this->db->like('b.kode', $filter_data_kode, 'after');
        }

        if ($filter_data_tanggal != null) {
            $tanggals = json_decode($filter_data_tanggal);
            $start = $tanggals->start;
            $end = $tanggals->end;
            $this->db->where("(a.tanggal BETWEEN '$start' and '$end')");
        }
        if ($filter_data_cabang != null) {
            $this->db->where('d.id', $filter_data_cabang);
        }

        return $this->db->get();
    }
    public function getDataLaporan()
    {

        $data =  $this->db->get("pengaturan_laporan")->row_array();

        if (!$data) {

            // default pengaturan laporan
            $data = [
                "id" => "1",
                "kepala_nama" => "Dadang Hermawan, M.Ed.",
                "kepala_nip" => "19700731 199803 1 005",
                "kas_nama" => "Dede Kurniawan, S.Pd.",
                "kas_nip" => "-",
                "kota" => "Kinabalu"
            ];
            $this->db->insert('pengaturan_laporan', $data);
        }
        return $data;
    }
}