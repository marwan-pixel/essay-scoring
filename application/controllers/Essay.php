<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Essay_Controller.php');
class Essay extends CI_Controller
{
    protected $mata_kuliah = array();
    protected $soal_matakuliah = array();
    protected $jawaban_essay = array();
    protected $data_mahasiswa = array();
    protected $hasil_algoritma = array();
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->model('essay_model');
        $this->load->library('pagination');
        $this->load->helper('url');
        // $this->load->library("session");
    }
    private function paginationInitialize(string $link, string $data, string $table)
    {
        return array(
            'base_url' => base_url($link),
            'total_rows' => $this->essay_model->show_data(column: $data, table: $table, count: true),
            'per_page' => 12,
        );
    }
    public function index()
    {
        $this->session->unset_userdata('kd_matkul');
        $initialize = $this->paginationInitialize('essay', 'kd_matkul', 'cbt_soal');
        $this->pagination->initialize($initialize);
        $start = $_GET['per_page'] ?? null;
        $this->mata_kuliah = $this->essay_model->show_data(column: "kd_matkul", table: 'cbt_soal', limit: $initialize['per_page'], offset: $start);
        $this->load->view('template/header');
        $this->load->view('home_view', ['no' => 1, 'mata_kuliah' => $this->mata_kuliah, 'start' => $start]);
        $this->load->view('template/footer');
    }

    public function soal_view($kd_matkul)
    {
        $this->session->set_userdata('kd_matkul', $kd_matkul);
        $initialize = $this->paginationInitialize('soal_view/' . $kd_matkul, 'kd_soal', 'cbt_soal');

        if ($this->input->post('submit')) {
            $semester = $this->input->post('semester');
            $thn_akademik = $this->input->post('thn_akademik');
            $kelas = $this->input->post('kelas');
            $ctype = $this->input->post('ctype');
            $this->session->set_userdata(array(
                'semester' => $semester,
                'thn_akademik' => $thn_akademik,
                'kelas' => $kelas,
                'ctype' => $ctype
            ));
        } else {
            $semester = $this->session->userdata('semester');
            $thn_akademik = $this->session->userdata('thn_akademik');
            $kelas = $this->session->userdata('kelas');
            $ctype = $this->session->userdata('ctype');
        }
        $data_semester = $this->essay_model->show_data(
            column: 'semester',
            table: 'cbt_soal',
        );
        $data_thn_akademik  = $this->essay_model->show_data(
            column: 'thn_akademik',
            table: 'cbt_soal',
        );
        $data_kelas  = $this->essay_model->show_data(
            column: 'kd_kelas',
            table: 'cbt_soal',
        );
        $data_ctype = $this->essay_model->show_data(
            column: 'ctype',
            table: 'cbt_soal',
        );
        $initialize['total_rows'] = $this->db->select('kd_soal, soal, kunci_jawaban, semester, thn_akademik')->where([
            'kd_matkul' => $kd_matkul,
            'semester' => $semester, 'thn_akademik' => $thn_akademik, 'kd_kelas' => $kelas
        ])->from('cbt_soal')->count_all_results();
        $this->pagination->initialize($initialize);
        $start = $_GET['per_page'] ?? null;
        $this->soal_matakuliah = $this->essay_model->show_data(
            column: 'kd_soal, soal, kunci_jawaban, semester, thn_akademik',
            table: 'cbt_soal',
            param: ['kd_matkul' => $kd_matkul, 'semester' => $semester, 'thn_akademik' => $thn_akademik, 'kd_kelas' => $kelas, 'ctype' => $ctype],
            limit: $initialize['per_page'],
            offset: $start
        );
        $this->load->view('template/header');
        $this->load->view('soal_view', [
            'kd_matkul' => $kd_matkul, 'title' => $kd_matkul, 'soal_matkul' => $this->soal_matakuliah,
            'semester' => $data_semester, 'thn_akademik' => $data_thn_akademik, 'kelas' => $data_kelas,
            'ctype' => $data_ctype
        ]);
        $this->load->view('template/footer');
    }

    public function jawaban_mahasiswa_view($kd_soal)
    {
        $this->session->set_userdata('kd_soal', $kd_soal);
        $initialize = $this->paginationInitialize('jawaban_mahasiswa_view/' . $kd_soal, 'kd_jawaban', 'cbt_jawaban');
        $this->pagination->initialize($initialize);
        $start = $_GET['per_page'] ?? null;
        $this->data_mahasiswa = $this->essay_model->show_data(
            column: 'npm, jawaban, kd_kelas, kd_progstudi, kd_jawaban',
            table: 'cbt_jawaban',
            param: [
                'kd_soal' => $kd_soal,
                'semester' => $this->session->userdata('semester'),
                'thn_akademik' => $this->session->userdata('thn_akademik'),
            ],
            limit: $initialize['per_page'],
            offset: $start
        );
        $this->load->view('template/header');
        $this->load->view('jawaban_mahasiswa_view', ['kd_soal' => $kd_soal, 'mahasiswa' => $this->data_mahasiswa]);
        $this->load->view('template/footer');
    }

    public function essay_scoring_view($kd_soal, $npm)
    {
        $this->session->userdata('kd_soal', $kd_soal);
        $this->soal_matakuliah = $this->essay_model->show_data('kd_soal, soal, kunci_jawaban', 'cbt_soal', ['kd_soal' => $kd_soal]);
        $this->data_jawaban = $this->essay_model->show_data('npm, jawaban, kd_kelas, kd_progstudi, semester, kd_jawaban, hasil_nilai', 'cbt_jawaban', ['npm' => $npm, 'kd_soal' => $kd_soal]);
        // $this->jawaban_essay = $this->essay_model->show_data('kd_jawaban, jawaban', 'jawaban_mahasiswa', ['kd_soal' => $kd_soal, 'npm' => $npm]);
        // if (count($this->jawaban_essay) !== 0) {
        //     $this->hasil_algoritma = $this->essay_model->show_data('kd_jawaban, pre_processing_jawaban, pre_processing_kj, tokenisasi_jawaban, tokenisasi_kj, hashing_jawaban, hashing_kj, winnowing_jawaban, winnowing_kj, similarity, skor', 'hasil_algoritma', ['kd_jawaban' => $this->jawaban_essay[0]->kd_jawaban]);
        // }
        // if (($this->data_jawaban[0]->hasil_nilai) == 0) {
        //     $hasil_nilai = 0;
        //     if (!is_null($this->data_jawaban[0]->jawaban) && !is_null($this->soal_matakuliah[0]->kunci_jawaban)) {
        //         $hasil_nilai = $this->essay_scoring($this->data_jawaban[0]->jawaban, $this->soal_matakuliah[0]->kunci_jawaban, 8, 6);
        //         $nilai = $this->essay_model->update_data(table: 'cbt_jawaban', data: $hasil_nilai, param: ['kd_soal' => $kd_soal, 'npm' => $npm]);
        //         if ($nilai) {
        //             $this->data_jawaban[0]->hasil_nilai = $hasil_nilai['hasil_nilai'];
        //         }
        //     }
        // }
        $this->load->view('template/header');
        $this->load->view('essay_scoring_view', ['kd_soal' => $kd_soal, 'jawaban' => $this->data_jawaban, 'soal' => $this->soal_matakuliah]);
        $this->load->view('template/footer');
    }
}
