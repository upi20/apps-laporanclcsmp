<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ProposalModel extends Render_Model
{
    public function getAllData($id_cabang)
    {
        $exe = $this->db->select('a.*')->from(' proposal a ');
        $exe->where("id_cabang", $id_cabang);
        $this->db->order_by('a.status ASC');
        $this->db->order_by('a.tanggal DESC');
        $return = $exe->get()->result_array();
        return $return;
    }

    public function cekTambah($id)
    {
        $proposal = $this->db->get_where("proposal", "(id_cabang = '$id') and (status = '0' or  status = '1' or status = '2')")->num_rows();
        $get_status                = $this->db->get_where('rabs', ['id_cabang' => $id])->row_array();
        $status = isset($get_status['status']) ? $get_status['status'] : 4;

        return [
            "proposal" => $proposal,
            "status" => $status
        ];
    }

    // mengambil semua data
    // mengambil semua data
    public function getDataDetailAll($id_cabang, $id_proposal, $status = 0)
    {
        if ($status == 0) {
            // ambil proposal yang sudah dicairkan
            $proposals_cair = $this->db->select("a.id_rab")
                ->from("proposal_rab a")
                ->join("proposal b", "b.id = a.id_proposal")
                ->where([
                    'b.id_cabang' => $id_cabang,
                    'b.status' => 4,
                ])
                ->get()
                ->result_array();
            $this->db->reset_query();

            // mengambil semua rab yang sudah dipilih proposal
            $proposals = $this->db->select("a.id_rab")
                ->from("proposal_rab a")
                ->join("proposal b", "b.id = a.id_proposal")
                ->where([
                    'b.id_cabang' => $id_cabang,
                    'b.id' => $id_proposal,
                ])
                ->get()
                ->result_array();
            $this->db->reset_query();

            // data testing
            // $proposals = [
            //     ['id_rab' => 30],
            //     ['id_rab' => 26],
            //     ['id_rab' => 48],
            // ];
            // $proposals_cair = [
            //     ['id_rab' => 22],
            //     ['id_rab' => 23],
            //     ['id_rab' => 26],
            // ];

            // get rabs yang belum dipilih
            $uncheck = $this->getRabUnChecked($id_cabang, $proposals, $proposals_cair);

            // get rabs yang sudah dipilih
            $checked = $this->getRabChecked($id_cabang, $proposals, $proposals_cair);

            // sisa di rab
            // cek apakah pernah ada proposal sebelumnya di cabang ini kalau ada ambil yang terbaru
            // sisa rab yang  belum dipilih
            $proposal_sisaUncheck = $this->getCurrentProposalByIdCabangUnchcked($id_cabang, $id_proposal, $proposals);

            // sisa rab yang sudah dipilih
            $proposal_sisaChecked = [];
            $proposal_sisaChecked = $this->getCurrentProposalByIdCabangChcked($id_cabang, $id_proposal, $proposals);

            // hasil
            $result = array_merge($proposal_sisaChecked, $checked, $proposal_sisaUncheck, $uncheck);
        } else {
            // rab
            $result = $this->getProposalRabByIdProposal($id_proposal);
        }
        return $result;
    }

    private function getRabUnChecked($id_cabang, $proposals, $proposals_cair)
    {
        $this->db->select("a.id, a.kode, a.nama, a.total_harga_ringgit, a.total_harga_rupiah, '0' as ischeck, (a.jumlah_1 * a.jumlah_2* a.jumlah_3 * a.jumlah_4) as jumlah_1, '0' as jumlah_1_realisasi, '0' as jumlah_1_sisa, '1' as input, a.harga_ringgit, a.harga_rupiah");
        $this->db->from("rabs a");
        $this->db->where("a.id_cabang", $id_cabang);

        // tidak boleh rab yang sudah di ceklis
        for ($i = 0; $i < count($proposals); $i++) {
            $id_rab = $proposals[$i]['id_rab'];
            $this->db->where("a.id !=", $id_rab);
        }

        // tidak boleh rab yang sudah cair
        for ($i = 0; $i < count($proposals_cair); $i++) {
            $id_rab = $proposals_cair[$i]['id_rab'];
            $this->db->where("a.id !=", $id_rab);
        }
        return $this->db->get()->result_array();
    }

    private function getRabChecked($id_cabang, $proposals, $proposals_cair)
    {
        $checked = [];
        if (count($proposals) > 0) {
            $this->db->select("a.id, a.kode, a.nama, a.total_harga_ringgit, a.total_harga_rupiah, '1' as ischeck, (a.jumlah_1 * a.jumlah_2* a.jumlah_3 * a.jumlah_4) as jumlah_1, b.jumlah_1_realisasi, b.jumlah_1_sisa, '1' as input, a.harga_ringgit, a.harga_rupiah, b.jumlah_ringgit, b.jumlah_rupiah");
            $this->db->from("rabs a");
            $this->db->join("proposal_rab b", "a.id = b.id_rab");
            $where = "";
            for ($i = 0; $i < count($proposals); $i++) {
                $id_rab = $proposals[$i]['id_rab'];
                if (count($proposals) == 1) {
                    $where = "a.id_cabang = '$id_cabang' and a.id = '$id_rab'";
                } else {
                    $start = $i == 0;
                    $center = $i != 0;
                    $end = $i == (count($proposals) - 1);
                    // start
                    if ($start) {
                        $where = "(a.id_cabang = '$id_cabang') and (a.id = '$id_rab'";
                    }

                    // center
                    if ($center && !$end) {
                        $where .= " or a.id = '$id_rab' ";
                    }

                    // end
                    if ($end) {
                        $where .= " or a.id = '$id_rab' )";
                    }
                }
            }

            // tidak boleh rab yang sudah cair
            for ($i = 0; $i < count($proposals_cair); $i++) {
                $id_rab = $proposals_cair[$i]['id_rab'];
                $this->db->where("a.id !=", $id_rab);
            }

            $this->db->where($where);
            $checked = $this->db->get()->result_array();
        }
        return $checked;
    }

    private function getCurrentProposalByIdCabangUnchcked($id_cabang, $id_proposal, $proposals)
    {
        $this->db->select("a.id, a.kode, a.nama, (a.harga_ringgit * b.jumlah_1_sisa) as total_harga_ringgit, (a.harga_rupiah * b.jumlah_1_sisa) as total_harga_rupiah, '0' as ischeck, b.jumlah_1_sisa as jumlah_1, '0' as jumlah_1_realisasi, '0' as jumlah_1_sisa, '1' as input, a.harga_ringgit, a.harga_rupiah, b.id as id_proposal_rab, c.id as id_proposal");
        $this->db->from("proposal_rab b");
        $this->db->join("proposal c", "b.id_proposal = c.id");
        $this->db->join("rabs a", "b.id_rab = a.id");
        $this->db->where("c.id <> '$id_proposal'");
        $this->db->where("c.id_cabang", $id_cabang);
        $this->db->where("b.jumlah_1_sisa > 0");
        // tidak boleh rab yang sudah di ceklis
        for ($i = 0; $i < count($proposals); $i++) {
            $id_rab = $proposals[$i]['id_rab'];
            $this->db->where("a.id <> $id_rab");
        }

        $result = $this->db->get()->result_array();
        return $result;
    }

    private function getCurrentProposalByIdCabangChcked($id_cabang, $id_proposal, $proposals)
    {
        $checked = [];
        if (count($proposals) > 0) {
            $this->db->select("a.id, a.kode, a.nama, (a.harga_ringgit * b.jumlah_1_sisa) as total_harga_ringgit, (a.harga_rupiah * b.jumlah_1_sisa) as total_harga_rupiah, '1' as ischeck, b.jumlah_1_sisa as jumlah_1, '0' as jumlah_1_sisa, '1' as input, a.harga_ringgit, a.harga_rupiah, b.id as id_proposal_rab, c.id as id_proposal, (SELECT f.jumlah_1_realisasi FROM proposal_rab f WHERE f.id_rab = a.id AND f.id_proposal = '$id_proposal')as jumlah_1_realisasi");
            $this->db->from("proposal_rab b");
            $this->db->join("proposal c", "b.id_proposal = c.id");
            $this->db->join("rabs a", "b.id_rab = a.id");
            $this->db->where("c.id <> '$id_proposal'");
            $this->db->where("c.id_cabang", $id_cabang);
            $this->db->where("b.jumlah_1_sisa > 0");

            $where = "";
            for ($i = 0; $i < count($proposals); $i++) {
                $id_rab = $proposals[$i]['id_rab'];
                if (count($proposals) == 1) {
                    $where = "a.id_cabang = '$id_cabang' and a.id = '$id_rab'";
                } else {
                    $start = $i == 0;
                    $center = $i != 0;
                    $end = $i == (count($proposals) - 1);
                    // start
                    if ($start) {
                        $where = "(a.id_cabang = '$id_cabang') and (a.id = '$id_rab'";
                    }

                    // center
                    if ($center && !$end) {
                        $where .= " or a.id = '$id_rab' ";
                    }

                    // end
                    if ($end) {
                        $where .= " or a.id = '$id_rab' )";
                    }
                }
            }
            $this->db->where($where);

            $result = $this->db->get()->result_array();
            $checked = $result;
        }
        return $checked;
    }

    private function getProposalRabByIdProposal($id_proposal)
    {
        $this->db->select("a.id, a.kode, a.nama, (a.harga_ringgit * b.jumlah_1) as total_harga_ringgit, (a.harga_rupiah * b.jumlah_1) as total_harga_rupiah, '0' as ischeck, b.jumlah_1, b.jumlah_1_realisasi, '0'as jumlah_1_sisa, '0' as input, a.harga_ringgit, a.harga_rupiah, b.jumlah_ringgit, b.jumlah_rupiah");
        $this->db->from("proposal_rab b");
        $this->db->join("rabs a", 'a.id = b.id_rab');
        $this->db->where("b.id_proposal", $id_proposal);
        return $this->db->get()->result_array();
    }

    public function getProposal($id = null)
    {
        return $this->db->get_where("proposal", ['id' => $id])->row_array();
    }

    public function update($id_proposal, $judul, $keterangan, $ringgit, $rupiah, $rabs, $tanggal_dari, $tanggal_sampai, $termin)
    {

        // hapus semua proposal_rab
        $this->db->where('id_proposal', $id_proposal);
        $delete = $this->db->delete('proposal_rab');

        // edit proposal
        $this->db->where('id', $id_proposal);
        $edit  = $this->db->update('proposal', [
            'judul' => $judul,
            'keterangan' => $keterangan,
            'total_ringgit' => $ringgit,
            'total_rupiah' => $rupiah,
            'periode_termin' => $termin,
            'periode_dari' => $tanggal_dari,
            'periode_sampai' => $tanggal_sampai,
        ]);

        // insert semua proposal
        $inserts = [];
        $insert = true;
        if (count($rabs['id_rabs']) > 0) {
            for ($i = 0; $i < count($rabs['id_rabs']); $i++) {
                $inserts[] = [
                    'id_proposal' => $id_proposal,
                    'id_rab' => $rabs['id_rabs'][$i],
                    'jumlah_ringgit' => $rabs['ringgit'][$i],
                    'jumlah_rupiah' => $rabs['rupiah'][$i],
                    'jumlah_1' => $rabs['jumlah_1'][$i],
                    'jumlah_1_realisasi' => $rabs['jumlah_1_realisasi'][$i],
                    'jumlah_1_sisa' => $rabs['jumlah_1_sisa'][$i],
                    'current_id_proposal' => $rabs['sisa_id_proposal'][$i],
                    'current_id_proposal_rab' => $rabs['sisa_id_proposal_rab'][$i]
                ];
            }
            $insert = $this->db->insert_batch('proposal_rab', $inserts);
        }

        return $delete && $edit && $insert;
    }

    public function ajukan($id)
    {
        $this->db->where('id', $id);
        $result  = $this->db->update('proposal', [
            'status' => 1
        ]);
        return $result;
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $proposal = $this->db->delete('proposal');

        $this->db->where('id_proposal', $id);
        $proposal_rab = $this->db->delete('proposal_rab');

        return $proposal && $proposal_rab;
    }

    // proposal excel
    public function  exportExcel($id_proposal)
    {
        // nanti bisa ditambah jika aktifitas yang aktif saja
        // get all data aktifitas
        // 1
        $aktifitass = $this->db
            ->select("id, id_pengkodeans, uraian, kode")
            ->from("aktifitas")
            ->where('id_pengkodeans', 0)
            ->get()->result_array();
        $aktifitas_rows = [];

        // 2
        foreach ($aktifitass as $aktifitas) {
            $row_1 = $this->db
                ->select("id, id_pengkodeans, uraian, kode")
                ->from("aktifitas")
                ->where('id_pengkodeans', $aktifitas['id'])
                ->get()->result_array();

            $count_sub = count($row_1);

            // 3 mengambil data by id_aktifitas
            $rows_2 = [];
            foreach ($row_1 as $row_1_sub) {
                $row_2 = $this->db
                    ->select("*")
                    ->from("rabs a")
                    ->join("proposal_rab b", "b.id_rab = a.id")
                    ->where("b.id_proposal", $id_proposal)
                    ->where("a.id_aktifitas", $row_1_sub['id'])
                    ->get()->result_array();

                // 4 mengambil data by kode_isi_1
                $rows_3 = [];
                foreach ($row_2 as $row_2_sub) {
                    $row_3 = $this->db
                        ->select("*")
                        ->from("rabs a")
                        ->join("proposal_rab b", "b.id_rab = a.id")
                        ->where("b.id_proposal", $id_proposal)
                        ->where("a.kode_isi_1", $row_2_sub['id'])
                        ->where("a.kode_isi_2", 0)
                        ->where("a.kode_isi_3", 0)
                        ->get()->result_array();

                    // 5 mengambil data by kode_isi_2
                    $rows_4 = [];
                    foreach ($row_3 as $row_3_sub) {
                        $row_4 = $this->db
                            ->select("*")
                            ->from("rabs a")
                            ->join("proposal_rab b", "b.id_rab = a.id")
                            ->where("b.id_proposal", $id_proposal)
                            ->where("a.kode_isi_2", $row_3_sub['id'])
                            ->where("a.kode_isi_3", 0)
                            ->get()->result_array();

                        // 6 mengambil data by kode_isi_3
                        $rows_5 = [];
                        foreach ($row_4 as $row_4_sub) {
                            $row_5 = $this->db
                                ->select("*")
                                ->from("rabs a")
                                ->join("proposal_rab b", "b.id_rab = a.id")
                                ->where("b.id_proposal", $id_proposal)
                                ->where("a.kode_isi_3", $row_4_sub['id'])
                                ->get()->result_array();

                            $rows_5[] = array_merge(
                                $row_4_sub,
                                ["sub" => $row_5]
                            );
                        }

                        $rows_4[] = array_merge(
                            $row_3_sub,
                            ["sub" => $row_4]
                        );
                    }

                    $rows_3[] = array_merge(
                        $row_2_sub,
                        ["sub" => $row_3]
                    );
                }

                $rows_2[] = array_merge(
                    $row_1_sub,
                    ["sub" => $rows_3]
                );
            }

            $aktifitas_rows[] = array_merge(
                $aktifitas,
                ["sub" => $rows_2]
            );
        }

        return $aktifitas_rows;
    }
}
