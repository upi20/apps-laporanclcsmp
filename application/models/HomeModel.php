<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HomeModel extends Render_Model
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

            // variabel pecahkan 0 = tanggal
            // variabel pecahkan 1 = bulan
            // variabel pecahkan 2 = tahun

            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        }

        $this->db->select('c.nama as title, a.updated_at, a.status, b.nama as wmps,')
            ->from('aats a')
            ->join('wmps b', 'a.id_wmp = b.id')
            ->join('area_tambangs c', 'b.id_area_tambang = c.id_perusahaan')
            ->order_by('updated_at', 'desc')
            ->limit(3);


        $result = $this->db->get()->result_array();
        $rows = [];
        foreach ($result as $row) {
            $t = explode(" ", $row['updated_at']);
            $row['updated_at'] = tgl_indo($t[0]) . " " . $t[1];
            $rows[] = $row;
        }
        return $rows;
    }
}
