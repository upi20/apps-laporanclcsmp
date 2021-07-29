<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InfoModel extends Render_Model
{
    public function getList()
    {
        return $this->db->select("a.id, b.id_sampling_point as title")
            ->from("perbaikans a")
            ->join("aats b", "a.id = b.id")
            ->where(['a.notifikasi' => 'Ya'])
            ->get()
            ->result_array();
    }
}
