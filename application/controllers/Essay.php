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
        $data_thn_akademik  = $this->essay_model->get_only_one_data(
            column: 'thn_akademik',
            table: 'cbt_soal',
            desc: true,
            item_desc: 'thn_akademik'
        );

        $data_param = ['nip' => $this->session->userdata('nip'), 'thn_akademik' => is_null($this->session->userdata('thn_akademik')) ? $data_thn_akademik[0]->thn_akademik : $this->session->userdata('thn_akademik')];
        if ($this->input->post('submit')) {
            $thn_akademik = $this->input->post('thn_akademik');
            $this->session->set_userdata(array(
                'thn_akademik' => $thn_akademik,
            ));
            $data_param['thn_akademik'] = $thn_akademik;
        } else {
            $thn_akademik = $this->session->userdata('thn_akademik');
        }
        $this->mata_kuliah = $this->essay_model->show_data(column: "kd_matkul, semester, kd_kelas, kd_progstudi", table: 'cbt_soal', param: $data_param);
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

    public function soal_view_uts($kd_progstudi, $kd_matkul, $kd_kelas, $semester, $ctype)
    {
        $this->session->set_userdata('kd_matkul', $kd_matkul);
        $this->soal_matakuliah = $this->essay_model->show_data(
            column: 'kd_soal, soal, kunci_jawaban, aktif',
            table: 'cbt_soal',
            param: ['kd_matkul' => $kd_matkul, 'ctype' => $ctype, 'semester' => $semester, 'kd_progstudi' => $kd_progstudi, 'thn_akademik' => $this->session->userdata('thn_akademik'), 'kd_kelas' => $kd_kelas],
        );
        $this->load->view('template/header');
        $this->load->view('soal_view_uts', [
            'kd_matkul' => $kd_matkul, 'title' => $kd_matkul, 'kd_kelas' => $kd_kelas, 'soal_matkul' => $this->soal_matakuliah, 'ctype' => $ctype, 'semester' => $semester, 'kd_progstudi' => $kd_progstudi
        ]);
        $this->load->view('template/footer');
    }

    public function soal_view_uas($kd_progstudi, $kd_matkul, $kd_kelas, $semester, $ctype)
    {
        $this->session->set_userdata('kd_matkul', $kd_matkul);

        $this->soal_matakuliah = $this->essay_model->show_data(
            column: 'kd_soal, soal, kunci_jawaban',
            table: 'cbt_soal',
            param: ['kd_matkul' => $kd_matkul, 'ctype' => $ctype, 'semester' => $semester, 'kd_progstudi' => $kd_progstudi, 'thn_akademik' => $this->session->userdata('thn_akademik'), 'kd_kelas' => $kd_kelas],
        );
        $this->load->view('template/header');
        $this->load->view('soal_view_uas', [
            'kd_matkul' => $kd_matkul, 'title' => $kd_matkul, 'kd_kelas' => $kd_kelas, 'soal_matkul' => $this->soal_matakuliah, 'ctype' => $ctype, 'semester' => $semester, 'kd_progstudi' => $kd_progstudi
        ]);
        $this->load->view('template/footer');
    }

    public function jawaban_mahasiswa_view_uts($kd_progstudi, $kd_matkul, $kd_kelas, $semester, $ctype)
    {
        /**
         * SELECT cbt_jawaban.jawaban, cbt_jawaban.npm, cbt_soal.soal, cbt_soal.kd_soal FROM cbt_jawaban JOIN cbt_soal ON cbt_jawaban.kd_soal = cbt_soal.kd_soal WHERE cbt_soal.ctype = 3 AND cbt_soal.kd_matkul = 'IS301' AND cbt_soal.kd_kelas = "C" AND cbt_soal.thn_akademik = '2022/2023';
         */
        $this->session->set_userdata('kd_matkul', $kd_matkul);
        $mahasiswa = $this->essay_model->get_only_one_data(column: 'npm', param: [
            'kd_matkul' => $this->session->userdata('kd_matkul'),
            'thn_akademik' => $this->session->userdata('thn_akademik'),
            'kd_kelas' => $kd_kelas
        ], table: 'cbt_jawaban', item_desc: 'npm');
        $this->data_mahasiswa = $this->db->select('cbt_jawaban.jawaban, cbt_jawaban.npm, cbt_soal.soal, cbt_soal.kd_soal, cbt_jawaban.hasil_nilai')
            ->from('cbt_jawaban')
            ->join('cbt_soal', 'cbt_jawaban.kd_soal = cbt_soal.kd_soal')
            ->where([
                'cbt_soal.ctype' => $ctype,
                'cbt_soal.kd_matkul' => $kd_matkul,
                'cbt_soal.kd_kelas' => $kd_kelas,
                'cbt_soal.kd_progstudi' => $kd_progstudi,
                'cbt_soal.semester' => $semester,
                'cbt_soal.thn_akademik' => $this->session->userdata('thn_akademik')
            ])->order_by('cbt_jawaban.npm', 'DESC')->get()->result();
        $this->load->view('template/header');
        $this->load->view(
            'jawaban_mahasiswa_view_uts',
            ['kd_matkul' => $kd_matkul, 'jawaban_mahasiswa' => $this->data_mahasiswa, 'mahasiswa' => $mahasiswa]
        );
        $this->load->view('template/footer');
    }
    public function jawaban_mahasiswa_view_uas($kd_progstudi, $kd_matkul, $kd_kelas, $semester, $ctype)
    {
        $this->session->set_userdata('kd_matkul', $kd_matkul);
        $mahasiswa = $this->essay_model->get_only_one_data(column: 'npm', param: [
            'kd_matkul' => $this->session->userdata('kd_matkul'),
            'thn_akademik' => $this->session->userdata('thn_akademik'),
            'kd_kelas' => $kd_kelas
        ], table: 'cbt_jawaban', item_desc: 'npm');
        $this->data_mahasiswa = $this->db->select('cbt_jawaban.jawaban, cbt_jawaban.npm, cbt_soal.soal, cbt_soal.kd_soal, cbt_jawaban.hasil_nilai')
            ->from('cbt_jawaban')
            ->join('cbt_soal', 'cbt_jawaban.kd_soal = cbt_soal.kd_soal')
            ->where([
                'cbt_soal.ctype' => $ctype,
                'cbt_soal.kd_matkul' => $kd_matkul,
                'cbt_soal.kd_kelas' => $kd_kelas,
                'cbt_soal.kd_progstudi' => $kd_progstudi,
                'cbt_soal.semester' => $semester,
                'cbt_soal.thn_akademik' => $this->session->userdata('thn_akademik')
            ])->order_by('cbt_jawaban.npm', 'DESC')->get()->result();

        $this->load->view('template/header');
        $this->load->view(
            'jawaban_mahasiswa_view_uas',
            ['kd_matkul' => $kd_matkul, 'jawaban_mahasiswa' => $this->data_mahasiswa, 'mahasiswa' => $mahasiswa]
        );
        $this->load->view('template/footer');
    }

    public function essay_scoring_view()
    {
        $data_thn_akademik  = $this->essay_model->get_only_one_data(
            column: 'thn_akademik',
            table: 'cbt_soal',
            desc: true,
            item_desc: 'thn_akademik'
        );
        $data_semester  = $this->essay_model->get_only_one_data(
            column: 'semester',
            table: 'cbt_soal',
            desc: true,
            item_desc: 'semester'
        );
        $daftar_mata_kuliah = [];
        if ($this->input->post('thn_akademik') || $this->input->post('semester')) {
            $this->session->set_userdata(['semester' => $this->input->post('semester'), 'thn_akademik' => $this->input->post('thn_akademik')]);
            $data_matkul = [
                'thn_akademik' => $this->input->post('thn_akademik'),
                'kd_kelas' => $this->session->userdata('kd_kelas'),
                'semester' => $this->input->post('semester'),
            ];
            $daftar_mata_kuliah = $this->essay_model->show_data('kd_matkul', 'cbt_soal', $data_matkul);
        }
        // $this->data_jawaban = $this->essay_model->show_data('npm, jawaban, kd_kelas, kd_progstudi, semester, kd_jawaban, hasil_nilai', 'cbt_jawaban', ['npm' => $npm, 'kd_soal' => $kd_soal]);
        $this->load->view('template/header');
        $this->load->view('essay_scoring_view', ['title' => "Home", 'thn_akademik' => $data_thn_akademik, 'data_semester' => $data_semester, 'mata_kuliah' => $daftar_mata_kuliah]);
        $this->load->view('template/footer');
    }

    public function essay_scoring_view_detail($kd_matkul, $semester, $kd_kelas, $ctype)
    {
        $get_soal_matakuliah = [
            'kd_matkul' => $kd_matkul,
            'thn_akademik' => $this->session->userdata('thn_akademik'),
            'semester' => $semester,
            'kd_kelas' => $kd_kelas,
            'ctype' => $ctype,
            'aktif' => 1
        ];
        $this->soal_matakuliah = $this->essay_model->show_data('soal, kd_soal, kunci_jawaban, bobot_soal, ctype', 'cbt_soal', $get_soal_matakuliah);
        $this->data_mahasiswa = $this->db->select('cbt_jawaban.jawaban, cbt_soal.soal, cbt_soal.kd_soal')
            ->from('cbt_jawaban')
            ->join('cbt_soal', 'cbt_jawaban.kd_soal = cbt_soal.kd_soal')
            ->where([
                'cbt_soal.ctype' => $ctype,
                'cbt_soal.kd_matkul' => $kd_matkul,
                'cbt_soal.kd_kelas' => $kd_kelas,
                'cbt_soal.semester' => $semester,
                'cbt_soal.thn_akademik' => $this->session->userdata('thn_akademik'),
                'cbt_jawaban.npm' => $this->session->userdata('npm')
            ])->order_by('cbt_soal.kd_soal', 'ASC')->get()->result();

        $this->load->view('template/header');
        $this->load->view('essay_scoring_view_detail', [
            'title' => "Esai", 'soal_matakuliah' => $this->soal_matakuliah,
            'kd_matkul' => $kd_matkul,
            'kd_kelas' => $kd_kelas,
            'semester' => $semester,
            'jawaban_mahasiswa' => $this->data_mahasiswa
        ]);
        $this->load->view('template/footer');
    }
}
