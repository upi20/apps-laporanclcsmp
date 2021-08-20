<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Clc extends Render_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->sesion->cek_session();
        $this->load->model("rab/ClcModel", 'clc');

        $this->clcdetail = $this->db->get_where('cabangs', ['user_id' => $this->session->userdata('data')['id']])->row_array();
        $this->id_cabang = $this->clcdetail['id'];
    }

    public function index()
    {

        if ($this->session->userdata("data")['level'] == "Admin Sekolah") {
            $get_status = $this->db->select('a.fungsi, a.status, b.nama, b.id as id_cabang')
                ->join('cabangs b', 'b.id = a.id_cabang')
                ->get_where('rabs a', ['b.user_id' => $this->session->userdata('data')['id']])
                ->row_array();
            if ($get_status == null) {
                $getCabang = $this->clc->getIdCabang();
                $get_status = [
                    'fungsi' => '0',
                    'status' => null,
                    'id_cabang' => $getCabang['id_cabang'],
                    'nama' => $getCabang['nama'],
                ];
            }

            $status = $get_status['status'];
            $cabang = $get_status['nama'];
            if ($status == 0) {
                $status = 'Proses';
            } elseif ($status == 1) {
                $status = 'Ajukan';
            } elseif ($status == 2) {
                $status = 'Terima';
            } elseif ($status == 3) {
                $status = 'Tolak';
            } elseif ($status == 4) {
                $status = 'Dicairkan';
            } else {
                $status = '';
            }
            $data['fungsi'] = $get_status['fungsi'];
            $data['id_cabang'] = $get_status['id_cabang'];
            $data['title']                     = "RAB CLC $cabang - (Status: $status)";
            $this->load->view("rab/cabang/clc", $data);
        } else {
            redirect("login");
        }
    }

    public function getListDataRabs()
    {
        $id_cabang = $this->input->post("id");
        $result = $this->clc->getListDataRabs($id_cabang);
        $this->output_json($result);
    }

    public function getKurs()
    {
        # code...
        $ringgit = $this->input->post('ringgit');

        $get = $this->db->get('kurs')->row_array();
        $exe['rupiah'] = $ringgit * $get['rupiah'];

        $this->output_json($exe);
    }

    public function ajax_data()
    {
        $status = $this->input->post('status');
        $start     = $this->input->post('start');
        $draw     = $this->input->post('draw');
        $length = $this->input->post('length');
        $cari     = $this->input->post('search');
        if (isset($cari['value'])) {
            $_cari = $cari['value'];
        } else {
            $_cari = null;
        }
        $data     = $this->clc->getAllData($length, $start, $_cari, $status)->result_array();
        $count     = $this->clc->getAllData(null, null, $_cari, $status)->num_rows();

        array($cari);

        echo json_encode(array('recordsTotal' => $count, 'recordsFiltered' => $count, 'draw' => $draw, 'search' => $_cari, 'data' => $data));
    }

    public function tambah()
    {
        if ($this->session->userdata("data")['level'] == "Admin Sekolah") {
            $data['id_cabang'] = $this->id_cabang;
            $this->load->view("rab/cabang/clc-tambah", $data);
        } else {
            redirect("login");
        }
    }

    public function getCabang()
    {
        $exe                             = $this->clc->getCabang();

        $this->output_json($exe);
    }

    public function getAktifitas()
    {
        $exe                             = $this->clc->getAktifitas();

        $this->output_json($exe);
    }

    public function getAktifitasSub()
    {
        $id_aktifitas             = $this->input->post('id_aktifitas');
        $exe                     = $this->clc->getAktifitasSub($id_aktifitas);

        $this->output_json($exe);
    }

    public function getAktifitasCabang()
    {
        $id_aktifitas_sub         = $this->input->post('id_aktifitas_sub');
        $id_cabang                 = $this->input->post('id_cabang');
        $id_cabang                 = $id_cabang == null ? $this->id_cabang : $id_cabang;
        $exe                     = $this->clc->getAktifitasCabang($id_aktifitas_sub, $id_cabang);

        $this->output_json($exe);
    }

    public function getAktifitasCabangKodeIsi1()
    {
        $id_aktifitas_cabang     = $this->input->post('id_aktifitas_cabang');
        $id_cabang                 = $this->input->post('id_cabang');
        $id_cabang                 = $id_cabang == null ? $this->id_cabang : $id_cabang;
        $exe                     = $this->clc->getAktifitasCabangKodeIsi1($id_aktifitas_cabang, $id_cabang);

        $this->output_json($exe);
    }

    public function getAktifitasCabangKodeIsi2()
    {
        $kode_isi_1             = $this->input->post('kode_isi_1');
        $id_cabang                 = $this->input->post('id_cabang');
        $id_cabang                 = $id_cabang == null ? $this->id_cabang : $id_cabang;
        $exe                     = $this->clc->getAktifitasCabangKodeIsi2($kode_isi_1, $id_cabang);

        $this->output_json($exe);
    }

    public function getAktifitasCabangKodeIsi3()
    {
        $kode_isi_2             = $this->input->post('kode_isi_2');
        $id_cabang                 = $this->input->post('id_cabang');
        $id_cabang                 = $id_cabang == null ? $this->id_cabang : $id_cabang;
        $exe                     = $this->clc->getAktifitasCabangKodeIsi3($kode_isi_2, $id_cabang);
        $this->output_json($exe);
    }

    public function getKodeCabang()
    {
        $id_aktifitas_sub         = $this->input->post('id_aktifitas_sub');
        $id_cabang = $this->input->post('id_cabang');

        if ($this->session->userdata('data')['level'] == 'Super Admin') {
            $get_kode_max = $this->db->query("select max(kode) as kode from rabs where id_cabang = '" . $id_cabang . "' and id_aktifitas = '" . $id_aktifitas_sub . "' and kode_isi_1 = 0")->row_array();
        } elseif ($this->session->userdata('data')['level'] == 'Admin Sekolah') {
            $get_kode_max = $this->db->query("select max(kode) as kode from rabs where id_cabang = '" . $this->id_cabang . "' and id_aktifitas = '" . $id_aktifitas_sub . "' and kode_isi_1 = 0")->row_array();
        }

        if ($get_kode_max['kode'] == null or $get_kode_max['kode'] == '') {
            $get_kode_max = $this->db->query("select max(kode) as kode from aktifitas where id = '" . $id_aktifitas_sub . "'")->row_array();
            $get_kode_max['kode'] = $get_kode_max['kode'] . ".0";
        }
        $this->output_json($get_kode_max);
    }

    public function getKodeCabangKodeIsi1()
    {
        $id_aktifitas_cabang         = $this->input->post('id_aktifitas_cabang');
        $id_cabang = $this->input->post('id_cabang');

        if ($this->session->userdata('data')['level'] == 'Super Admin') {
            // $get_kode_max = $this->db->query("select max(kode) as kode from rabs where kode_isi_1 = '" . $id_aktifitas_cabang . "' and kode_isi_2 = 0")->row_array();
            $get_kode_max = $this->db->query("select max(kode) as kode from rabs where id_cabang = '" . $this->id_cabang . "' and kode_isi_1 = '" . $id_aktifitas_cabang . "' and kode_isi_2 = 0")->row_array();
        } elseif ($this->session->userdata('data')['level'] == 'Admin Sekolah') {
            $get_kode_max = $this->db->query("select max(kode) as kode from rabs where id_cabang = '" . $this->id_cabang . "' and kode_isi_1 = '" . $id_aktifitas_cabang . "' and kode_isi_2 = 0")->row_array();
        }

        if ($get_kode_max['kode'] == null or $get_kode_max['kode'] == '') {
            $get_kode_max = $this->db->query("select max(kode) as kode from rabs where id = '" . $id_aktifitas_cabang . "'")->row_array();
            $get_kode_max['kode'] = $get_kode_max['kode'] . ".0";
        }
        $get_kode_max_new = explode('.', $get_kode_max['kode']);
        // jika kode sudah 9
        if (end($get_kode_max_new) == 9) {
            // get kode pre
            $kodePre = $this->kodePre($get_kode_max_new);

            // get kode
            $id_cabang = $this->id_cabang;
            $lastKode = $this->lastMaxKode1($id_cabang, $kodePre);

            // assignemnt to main variable
            $get_kode_max['kode'] = $kodePre . $lastKode;
        }
        $this->output_json($get_kode_max);
    }

    private function lastMaxKode1($id_cabang, $kodePre)
    {
        $cabang = "";
        if ($this->session->userdata('data')['level'] == 'Admin Sekolah') {
            $cabang = " id_cabang = '$id_cabang' and ";
        }
        $result = $this->db->query("select count(*) as kode from rabs where $cabang ((kode_isi_2 = '0' and kode_isi_3 = '0') and kode LIKE '$kodePre%')")->row_array();
        return $result['kode'];
    }

    public function getKodeCabangKodeIsi2()
    {
        $kode_isi_1         = $this->input->post('kode_isi_1');


        if ($this->session->userdata('data')['level'] == 'Super Admin') {
            $get_kode_max = $this->db->query("select max(kode) as kode from rabs where kode_isi_2 = '" . $kode_isi_1 . "'  and kode_isi_2 = '" . $kode_isi_1 . "' and kode_isi_3 = '0'")->row_array();
        } elseif ($this->session->userdata('data')['level'] == 'Admin Sekolah') {
            $get_kode_max = $this->db->query("select max(kode) as kode from rabs where id_cabang = '" . $this->id_cabang . "' and kode_isi_2 = '" . $kode_isi_1 . "' and kode_isi_3 = '0'")->row_array();
        }

        if ($get_kode_max['kode'] == null or $get_kode_max['kode'] == '') {
            $get_kode_max = $this->db->query("select max(kode) as kode from rabs where id = '" . $kode_isi_1 . "'")->row_array();
            $get_kode_max['kode'] = $get_kode_max['kode'] . ".0";
        }
        $get_kode_max_new = explode('.', $get_kode_max['kode']);

        // jika kode sudah 9
        if (end($get_kode_max_new) == 9) {
            // get kode pre
            $kodePre = $this->kodePre($get_kode_max_new);

            // get kode
            $id_cabang = $this->id_cabang;
            $lastKode = $this->lastMaxKode2($id_cabang, $kodePre);

            // assignemnt to main variable
            $get_kode_max['kode'] = $kodePre . $lastKode;
        }

        $this->output_json($get_kode_max);
    }

    private function lastMaxKode2($id_cabang, $kodePre)
    {
        $cabang = "";
        if ($this->session->userdata('data')['level'] == 'Admin Sekolah') {
            $cabang = " id_cabang = '$id_cabang' and ";
        }
        $result = $this->db->query("select count(*) as kode from rabs where $cabang (kode_isi_3 = '0' and kode LIKE '$kodePre%')")->row_array();
        return $result['kode'];
    }

    public function getKodeCabangKodeIsi3()
    {
        $kode_isi_2         = $this->input->post('kode_isi_2');
        $id_cabang_post = $this->input->post('id_cabang');

        if ($this->session->userdata('data')['level'] == 'Super Admin') {
            $get_kode_max = $this->db->query("select max(kode) as kode from rabs where id_cabang = '" . $id_cabang_post . "' and kode_isi_3 = '" . $kode_isi_2 . "'")->row_array();
        } elseif ($this->session->userdata('data')['level'] == 'Admin Sekolah') {
            $get_kode_max = $this->db->query("select max(kode) as kode from rabs where id_cabang = '" . $this->id_cabang . "' and kode_isi_3 = '" . $kode_isi_2 . "'")->row_array();
        }

        if ($get_kode_max['kode'] == null or $get_kode_max['kode'] == '') {
            $get_kode_max = $this->db->query("select max(kode) as kode from rabs where id = '" . $kode_isi_2 . "'")->row_array();
            $get_kode_max['kode'] = $get_kode_max['kode'] . ".0";
        }


        $get_kode_max_new = explode('.', $get_kode_max['kode']);

        // jika kode sudah 9
        if (end($get_kode_max_new) == 9) {
            // get kode pre
            $kodePre = $this->kodePre($get_kode_max_new);

            // get kode
            $id_cabang = $this->id_cabang;
            $lastKode = $this->lastMaxKode3($id_cabang, $kodePre);

            // assignemnt to main variable
            $get_kode_max['kode'] = $kodePre . $lastKode;
        }
        $this->output_json($get_kode_max);
    }

    private function lastMaxKode3($id_cabang, $kodePre)
    {
        $cabang = "";
        if ($this->session->userdata('data')['level'] == 'Admin Sekolah') {
            $cabang = " id_cabang = '$id_cabang' and ";
        }
        $result = $this->db->query("select count(*) as kode from rabs where $cabang kode LIKE '$kodePre%'")->row_array();
        return $result['kode'];
    }

    private function kodePre($kode)
    {
        $result = "";

        for ($i = 0; $i < count($kode) - 1; $i++) {
            $result .=  ($kode[$i] . ".");
        }

        return $result;
    }

    public function insert()
    {
        $id_cabang                         = $this->input->post('id_cabang');
        $id_aktifitas                    = $this->input->post('id_aktifitas');
        $id_aktifitas_sub                = $this->input->post('id_aktifitas_sub');
        $id_aktifitas_cabang            = $this->input->post('id_aktifitas_cabang');
        $kode_isi_1                     = $this->input->post('kode_isi_1');
        $kode_isi_2                     = $this->input->post('kode_isi_2');
        $kode_isi_3                     = $this->input->post('kode_isi_3');
        $kode                             = $this->input->post('kode');
        $nama                             = $this->input->post('nama');
        $jumlah_1                         = $this->input->post('jumlah_1');
        $satuan_1                         = $this->input->post('satuan_1');
        $jumlah_2                         = $this->input->post('jumlah_2');
        $satuan_2                         = $this->input->post('satuan_2');
        $jumlah_3                         = $this->input->post('jumlah_3');
        $satuan_3                         = $this->input->post('satuan_3');
        $jumlah_4                         = $this->input->post('jumlah_4');
        $satuan_4                         = $this->input->post('satuan_4');
        $harga_ringgit                     = $this->input->post('harga_ringgit');
        $harga_rupiah                     = $this->input->post('harga_rupiah');
        $total_harga_ringgit             = $this->input->post('total_harga_ringgit');
        $total_harga_rupiah                = $this->input->post('total_harga_rupiah');
        $prioritas                         = $this->input->post('prioritas');
        $keterangan                     = $this->input->post('keterangan');
        $get_status = $this->db->query("select status from rabs where id_cabang = '$id_cabang'")->row_array();
        $status                         = $get_status == null ? 0 : $get_status['status'];

        $exe                             = $this->clc->insert($id_cabang, $id_aktifitas, $id_aktifitas_sub, $id_aktifitas_cabang, $kode_isi_1, $kode_isi_2, $kode_isi_3, $kode, $nama, $jumlah_1, $satuan_1, $jumlah_2, $satuan_2, $jumlah_3, $satuan_3, $jumlah_4, $satuan_4, $harga_ringgit, $harga_rupiah, $total_harga_ringgit, $total_harga_rupiah, $prioritas, $status, $keterangan);
        $this->output_json(
            [
                'id'     => $exe
            ]
        );
    }

    public function export_excel()
    {
        // function for width column
        function w($width)
        {
            return 0.71 + $width;
        }

        $cabang = $this->input->get("cabang");
        $datas = $this->clc->getAllData(null, null, $cabang, null)->result_array();
        $ket = $this->clcdetail = $this->db->get_where('cabangs', ['id' => $cabang])->row_array();


        $filename = 'FORM LAPORAN RENCANA ANGGARAN' . $ket['nama'] . ' (' . $ket['kode'] . ')';
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // set title
        $spreadsheet->getActiveSheet()->mergeCells('A1:R1');
        $sheet->setCellValue('A1', 'FORM LAPORAN RENCANA ANGGARAN' . $ket['nama'] . ' (' . $ket['kode'] . ')');
        $sheet->getStyle('A1')->getFont()->setSize(18);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // set header
        $headers = [
            'No',
            'Aktifitas',
            'Kode Sub Aktifitas',
            'Nama Sub Aktifitas',
            'Jumlah',
            'Satuan',
            'Jumlah',
            'Satuan',
            'Jumlah',
            'Satuan',
            'Jumlah',
            'Satuan',
            'Ringgit',
            'Rupiah',
            'Total Ringgit',
            'Total Rupiah',
            'Prioritas',
            'Keterangan',
        ];

        // apply header
        for ($i = 0; $i < count($headers); $i++) {
            $sheet->setCellValue(chr(65 + $i) . '2', $headers[$i]);
            $sheet->setCellValue(chr(65 + $i) . '3', ($i + 1));
        }
        $number = 1;



        foreach ($datas as $data) {
            $sheet->setCellValue("A" . ($number + 3), $number)
                ->setCellValue("B" . ($number + 3), $data['uraian'])
                ->setCellValue("C" . ($number + 3), $data['kodes'])
                ->setCellValue("D" . ($number + 3), $data['nama_aktifitas'])
                ->setCellValue("E" . ($number + 3), $data['jumlah_1'])
                ->setCellValue("F" . ($number + 3), $data['satuan_1'])
                ->setCellValue("G" . ($number + 3), $data['jumlah_2'])
                ->setCellValue("H" . ($number + 3), $data['satuan_2'])
                ->setCellValue("I" . ($number + 3), $data['jumlah_3'])
                ->setCellValue("J" . ($number + 3), $data['satuan_3'])
                ->setCellValue("K" . ($number + 3), $data['jumlah_4'])
                ->setCellValue("L" . ($number + 3), $data['satuan_4'])
                ->setCellValue("M" . ($number + 3), $data['harga_ringgit'])
                ->setCellValue("N" . ($number + 3), $data['harga_rupiah'])
                ->setCellValue("O" . ($number + 3), $data['total_harga_ringgit'])
                ->setCellValue("P" . ($number + 3), $data['total_harga_rupiah'])
                ->setCellValue("Q" . ($number + 3), $data['prioritas'])
                ->setCellValue("R" . ($number + 3), $data['keterangan']);
            $number++;
        }

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];

        $sheet->getStyle('A2:R' . ($number + 2))->applyFromArray($styleArray);

        // set alingment
        $sheet->getStyle('A3:A' . ($number + 2))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // set color header
        $styleArray = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '93C5FD',
                ],
                // 'endColor' => [
                // 	'argb' => 'FFFFFFFF',
                // ],
            ],
        ];
        $sheet->getStyle('A2:R2')->applyFromArray($styleArray);

        $styleArray['fill']['startColor']['rgb'] = 'E5E7EB';
        $sheet->getStyle('A3:R3')->applyFromArray($styleArray);

        // set width column
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(w(4));
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(w(40));
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(w(20));
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(w(50));
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(w(13));
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(w(13));
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(w(13));
        $spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(w(13));
        $spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(w(14));
        // align horizontal

        // error(gak bisa pake wkwkw)
        // // set format currency
        // // ringgit
        // $code_rm = '_-[$RM-en-MY]* #.##0,00_-;-[$RM-en-MY]* #.##0,00_-;_-[$RM-en-MY]* "-"??_-;_-@_-';
        // // Rupiah
        // $code_rp = '_-[$Rp-en-ID]* #.##0,00_-;-[$Rp-en-ID]* #.##0,00_-;_-[$Rp-en-ID]* "-"??_-;_-@_-';

        // $spreadsheet->getActiveSheet()->getStyle('M')->getNumberFormat()->setFormatCode($code_rm);
        // $spreadsheet->getActiveSheet()->getStyle('N')->getNumberFormat()->setFormatCode($code_rp);
        // $spreadsheet->getActiveSheet()->getStyle('O')->getNumberFormat()->setFormatCode($code_rm);
        // $spreadsheet->getActiveSheet()->getStyle('P')->getNumberFormat()->setFormatCode($code_rp);


        // input cell ke xlsx
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output'); // download file

        // data
        // $this->load->view("templates/export/export-excel-rab-form-cabang", $data);
    }

    public function importFromExcel()
    {

        $id_cabang = $this->input->post('id_cabang1');
        $fileName = $_FILES['file']['name'];

        $config['upload_path'] = './assets/'; //path upload
        $config['file_name'] = $fileName;  // nama file
        $config['allowed_types'] = 'xls|xlsx'; //tipe file yang diperbolehkan
        $config['max_size'] = 100000; // maksimal sizze

        $this->load->library('upload'); //meload librari upload
        $this->upload->initialize($config);

        $file_location = "";

        if (!$this->upload->do_upload('file')) {
            echo json_encode(['code' => 1, 'message' => $this->upload->display_errors()]);

            exit();
        } else {
            $file_location = array('upload_data' => $this->upload->data());
            $file_location = $file_location['upload_data']['full_path'];
        }


        /** Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file_location);
        $array_from_excel = $spreadsheet->getActiveSheet()->toArray();

        // simpan
        $result = true;
        $start = 1;
        foreach ($array_from_excel as $data) {
            if ($start > 18) {
                $kode = $data[2];
                $nama = $data[3];
                $jumlah_1 = $data[4];
                $satuan_1 = $data[5];
                $jumlah_2 = $data[6];
                $satuan_2 = $data[7];
                $jumlah_3 = $data[8];
                $satuan_3 = $data[9];
                $jumlah_4 = $data[10];
                $satuan_4 = $data[11];
                $harga_ringgit = str_replace(',', '', $data[12]);
                $harga_rupiah = str_replace(',', '', $data[13]);
                $total_harga_ringgit = str_replace(',', '', $data[14]);
                $total_harga_rupiah = str_replace(',', '', $data[15]);
                $prioritas = "";
                $keterangan = $data[16];

                $exe = $this->cabang->updateFromExcel($id_cabang, $kode, $nama, $jumlah_1, $satuan_1, $jumlah_2, $satuan_2, $jumlah_3, $satuan_3, $jumlah_4, $satuan_4, $harga_ringgit, $harga_rupiah, $total_harga_ringgit, $total_harga_rupiah, $keterangan, $prioritas);
                if (!$exe) {
                    $result = false;
                }
            }
            $start++;
        }


        // hapus file setelah dibaca
        unlink($file_location);
        $this->output_json(
            [
                'code' => $result ? 0 : 1,
                'message' => "File rusak atau tidak lengkap."
            ]
        );
    }

    public function getDataDetail()
    {
        $id                             = $this->input->post('id');

        $exe                             = $this->clc->getDataDetail($id);

        $this->output_json($exe);
    }

    public function update()
    {
        $id                             = $this->input->post('id_rabs');
        $id_cabang                         = $this->input->post('id_cabang');
        $kode                             = $this->input->post('kode');
        $nama                             = $this->input->post('nama');
        $jumlah_1                         = $this->input->post('jumlah_1');
        $satuan_1                         = $this->input->post('satuan_1');
        $jumlah_2                         = $this->input->post('jumlah_2');
        $satuan_2                         = $this->input->post('satuan_2');
        $jumlah_3                         = $this->input->post('jumlah_3');
        $satuan_3                         = $this->input->post('satuan_3');
        $jumlah_4                         = $this->input->post('jumlah_4');
        $satuan_4                         = $this->input->post('satuan_4');
        $harga_ringgit                     = $this->input->post('harga_ringgit');
        $harga_rupiah                     = $this->input->post('harga_rupiah');
        $total_harga_ringgit             = $this->input->post('total_harga_ringgit');
        $total_harga_rupiah                = $this->input->post('total_harga_rupiah');
        $keterangan                     = $this->input->post('keterangan');

        $exe                             = $this->clc->update($id, $id_cabang, $kode, $nama, $jumlah_1, $satuan_1, $jumlah_2, $satuan_2, $jumlah_3, $satuan_3, $jumlah_4, $satuan_4, $harga_ringgit, $harga_rupiah, $total_harga_ringgit, $total_harga_rupiah, $keterangan);

        $this->output_json(
            [
                'id'                 => $id
            ]
        );
    }

    public function resetRab()
    {
        $id = $this->input->post("reset-rab");
        $result = $this->clc->resetRab($id);
        $this->output_json($result);
    }
}
