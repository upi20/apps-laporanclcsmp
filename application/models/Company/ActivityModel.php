<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ActivityModel extends Render_Model
{
    public function getAreaTambang()
    {
        return $this->db->query('select at2.id, at2.nama, at2.status , (select count(*) as counts from aats a join wmps b on b.id = a.id_wmp join area_tambangs c on c.id = b.id_area_tambang where c.id = at2.id) as aats from area_tambangs at2')->result_array();
    }
    public function activityArea()
    {
        function tgl_indo($tanggal)
        {
            $bulan = array(
                1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
            $pecahkan = explode('-', $tanggal);

            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        }

        $this->db->select('a.id, c.nama as title, a.updated_at, a.status, b.nama as wmps,')
            ->from('aats a')
            ->join('wmps b', 'a.id_wmp = b.id')
            ->join('area_tambangs c', 'b.id_area_tambang = c.id_perusahaan')
            ->order_by('updated_at', 'desc');
        // ->limit(3);


        $result = $this->db->get()->result_array();
        $rows = [];
        foreach ($result as $row) {
            $t = explode(" ", $row['updated_at']);
            $row['updated_at'] = tgl_indo($t[0]) . " " . $t[1];
            $rows[] = $row;
        }
        return $rows;
    }

    public function detailActivity($id)
    {
        $result = $this->db->select("a.id as aat_id, a.user_id as aat_user_id, a.id_wmp as aat_id_wmp, a.id_sampling_point as aat_id_sampling_point, a.tanggal_input as aat_tanggal_input, a.time_input as aat_time_input, a.periode_input as aat_periode_input, a.kondisi_cuaca as aat_kondisi_cuaca, a.ph as aat_ph, a.tts as aat_tts, a.fe as aat_fe, a.mn as aat_mn, a.debit as aat_debit, a.chem_dose as aat_chem_dose, a.tts_unit as aat_tts_unit, a.fe_unit as aat_fe_unit, a.mn_unit as aat_mn_unit, a.debit_unit as aat_debit_unit, a.chem_dose_unit as aat_chem_dose_unit, a.status as aat_status, a.created_at as aat_created_at, a.updated_at as aat_updated_at, c.id as bk_id,c.id_wmp as bk_id_wmp,c.user_id as bk_user_id,c.tanggal_input as bk_tanggal_input,c.periode_input as bk_periode_input,c.waktu_input as bk_waktu_input,c.chemical as bk_chemical,c.purity as bk_purity,c.before as bk_before,c.before_unit as bk_before_unit,c.current as bk_current,c.current_unit as bk_current_unit,c.keterangan as bk_keterangan,c.status as bk_status,c.created_at as bk_created_at,c.updated_at as bk_updated_at, d.id as pb_id, d.id_wmp as pb_id_wmp, d.user_id as pb_user_id, d.tanggal_input as pb_tanggal_input, d.periode_input as pb_periode_input, d.waktu_input as pb_waktu_input, d.jenis_perbaikan as pb_jenis_perbaikan, d.notifikasi as pb_notifikasi, d.keterangan as pb_keterangan, d.status as pb_status, d.created_at as pb_created_at, d.updated_at as pb_updated_at, b.id as wmp_id, b.id_area_tambang as wmp_id_area_tambang, b.nama as wmp_nama, b.keterangan as wmp_keterangan, b.lat as wmp_lat, b.long as wmp_long, b.status as wmp_status, b.created_at as wmp_created_at, b.updated_at as wmp_updated_at ")
            ->from('aats a')
            ->join('wmps b', 'a.id_wmp = b.id')
            ->join('bahan_kimias c', 'b.id = c.id_wmp')
            ->join('perbaikans d', 'b.id = d.id_wmp')
            ->where(['a.id' => $id])
            ->get()
            ->row_array();
        return $result;
    }

    public function changeStatus($id, $id_wmp, $note, $ket)
    {
        $result = true;
        if (!$this->db->update('aats', ['status' => $ket], ['id' => $id])) {
            $result = false;
        }
        if (!$this->db->update('perbaikans', ['status' => $ket, 'keterangan' => $note], ['id_wmp' => $id_wmp])) {
            $result = false;
        }
        if (!$this->db->update('bahan_kimias', ['status' => $ket], ['id_wmp' => $id_wmp])) {
            $result = false;
        }
        return $result;
    }

    public function getIdWmp($id)
    {
        return $this->db->select('b.id')
            ->from('aats a')
            ->join('wmps b', 'a.id_wmp = b.id')
            ->where(['a.id' => $id])
            ->get()
            ->row_array();
    }
}
