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
        $this->load->library('form_validation');
        $this->load->library("session");
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
        $data_param = ['nip' => $this->session->userdata('nip')];
        $this->session->unset_userdata('kd_matkul');
        // $initialize = $this->paginationInitialize('essay', 'kd_matkul', 'cbt_soal');
        // $this->pagination->initialize($initialize);
        // $start = $_GET['per_page'] ?? null;
        if ($this->input->post('submit')) {
            $thn_akademik = $this->input->post('thn_akademik');
            $this->session->set_userdata(array(
                'thn_akademik' => $thn_akademik,
            ));
            $data_param['thn_akademik'] = $thn_akademik;
        } else {
            $thn_akademik = $this->session->userdata('thn_akademik');
        }
        $this->mata_kuliah = $this->essay_model->show_data(column: "kd_matkul, semester, kd_kelas,", table: 'cbt_soal', param: $data_param);

        $data_thn_akademik  = $this->essay_model->get_only_one_data(
            column: 'thn_akademik',
            table: 'cbt_soal',
        );
        $this->load->view('template/header');
        $this->load->view('home_view', ['no' => 1, 'mata_kuliah' => $this->mata_kuliah, 'thn_akademik' =>  $data_thn_akademik]);
        $this->load->view('template/footer');
    }

    public function login()
    {
        $this->load->view('template/header');
        $this->load->view('login');
        $this->load->view('template/footer');
    }


    public function soal_view_uts($kd_matkul)
    {
        $this->session->set_userdata('kd_matkul', $kd_matkul);
        $initialize = $this->paginationInitialize('soal_view/' . $kd_matkul, 'kd_soal', 'cbt_soal');

        $initialize['total_rows'] = $this->db->select('kd_soal, soal, kunci_jawaban')->where([
            'kd_matkul' => $kd_matkul,
        ])->from('cbt_soal')->count_all_results();
        $this->pagination->initialize($initialize);
        $start = $_GET['per_page'] ?? null;
        $this->soal_matakuliah = $this->essay_model->show_data(
            column: 'kd_soal, soal, kunci_jawaban',
            table: 'cbt_soal',
            param: ['kd_matkul' => $kd_matkul, 'ctype' => 3, 'thn_akademik' => $this->session->userdata('thn_akademik')],
            limit: $initialize['per_page'],
            offset: $start
        );
        $this->load->view('template/header');
        $this->load->view('soal_view_uts', [
            'kd_matkul' => $kd_matkul, 'title' => $kd_matkul, 'soal_matkul' => $this->soal_matakuliah,
        ]);
        $this->load->view('template/footer');
    }

    public function soal_view_uas($kd_matkul)
    {
        $this->session->set_userdata('kd_matkul', $kd_matkul);
        $initialize = $this->paginationInitialize('soal_view/' . $kd_matkul, 'kd_soal', 'cbt_soal');

        $initialize['total_rows'] = $this->db->select('kd_soal, soal, kunci_jawaban')->where([
            'kd_matkul' => $kd_matkul,
        ])->from('cbt_soal')->count_all_results();
        $this->pagination->initialize($initialize);
        $start = $_GET['per_page'] ?? null;
        $this->soal_matakuliah = $this->essay_model->show_data(
            column: 'kd_soal, soal, kunci_jawaban',
            table: 'cbt_soal',
            param: ['kd_matkul' => $kd_matkul, 'ctype' => 4, 'thn_akademik' => $this->session->userdata('thn_akademik')],
            limit: $initialize['per_page'],
            offset: $start
        );
        $this->load->view('template/header');
        $this->load->view('soal_view_uas', [
            'kd_matkul' => $kd_matkul, 'title' => $kd_matkul, 'soal_matkul' => $this->soal_matakuliah,
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
        $this->load->view('template/header');
        $this->load->view('essay_scoring_view', ['kd_soal' => $kd_soal, 'jawaban' => $this->data_jawaban, 'soal' => $this->soal_matakuliah]);
        $this->load->view('template/footer');
    }
}
