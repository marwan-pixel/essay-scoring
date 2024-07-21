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
        $this->load->helper('url');
        $this->load->library(['form_validation', 'session', 'upload']);
    }

    public function index()
    {
        // $currentYear = date("Y");
        // $currentMonth = date("m");

        // // Jika bulan saat ini adalah September atau lebih akhir
        // if ($currentMonth >= 9) {
        //     $startYear = $currentYear;
        //     $endYear = $currentYear + 1;
        // } else {
        //     $startYear = $currentYear - 1;
        //     $endYear = $currentYear;
        // }

        // $tahun_akademik = "$startYear/$endYear";
        $data_thn_akademik  = $this->essay_model->get_only_one_data(
            column: 'thn_akademik',
            table: 'cbt_soal',
            desc: true,
            item_desc: 'thn_akademik'
        );
        $thn_akademik = is_null($this->session->userdata('thn_akademik')) ? $this->session->set_userdata(array(
            'thn_akademik' => $data_thn_akademik[0]->thn_akademik,
        )) : $this->session->userdata('thn_akademik');
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $thn_akademik = $this->input->post('thn_akademik');
            $this->session->set_userdata(array(
                'thn_akademik' => $thn_akademik,
            ));
        } else {
            $thn_akademik = $this->session->userdata('thn_akademik');
        }
        $this->mata_kuliah = $this->db->select('cbt_kontrak_matkul.kd_matkul, cbt_kontrak_matkul.kd_progstudi, cbt_matkul.mata_kuliah, cbt_kontrak_matkul.semester, cbt_kontrak_matkul.kd_kelas')
            ->from('cbt_kontrak_matkul')
            ->join('cbt_matkul', 'cbt_kontrak_matkul.kd_matkul = cbt_matkul.kd_matkul')
            ->where([
                'cbt_kontrak_matkul.nip' => $this->session->userdata('nip'),
                'cbt_kontrak_matkul.thn_akademik' => $thn_akademik,
            ])->get()->result_array();
        $this->load->view('template/header');
        $this->load->view('dashboard_home_dosen', ['no' => 1, 'mata_kuliah' => $this->mata_kuliah, 'thn_akademik' =>  $data_thn_akademik]);
        $this->load->view('template/footer');
    }


    public function login()
    {
        $this->load->view('login');
    }

    public function input_soal_esai_uts($kd_progstudi, $kd_matkul, $kd_kelas, $semester, $ctype)
    {
        $this->session->set_userdata('kd_matkul', $kd_matkul);
        $nama_matakuliah = $this->essay_model->show_data(column: 'mata_kuliah', table: 'cbt_matkul', param: ['kd_matkul' => $kd_matkul]);
        $this->soal_matakuliah = $this->essay_model->show_data(
            column: 'kd_soal, soal, kunci_jawaban, aktif, bobot_soal, gambar',
            table: 'cbt_soal',
            param: ['kd_matkul' => $kd_matkul, 'ctype' => $ctype, 'semester' => $semester, 'kd_progstudi' => $kd_progstudi, 'thn_akademik' => $this->session->userdata('thn_akademik'), 'kd_kelas' => $kd_kelas],
        );
        $this->load->view('template/header');
        $this->load->view('input_soal_esai_uts', [
            'kd_matkul' => $kd_matkul, 'title' => $kd_matkul, 'kd_kelas' => $kd_kelas, 'soal_matkul' => $this->soal_matakuliah, 'ctype' => $ctype, 'semester' => $semester, 'kd_progstudi' => $kd_progstudi,
            'nama_matkul' => $nama_matakuliah
        ]);
        $this->load->view('template/footer');
    }

    public function input_soal_esai_uas($kd_progstudi, $kd_matkul, $kd_kelas, $semester, $ctype)
    {
        $this->session->set_userdata('kd_matkul', $kd_matkul);
        $this->soal_matakuliah = $this->essay_model->show_data(
            column: 'kd_soal, soal, kunci_jawaban, aktif, bobot_soal',
            table: 'cbt_soal',
            param: ['kd_matkul' => $kd_matkul, 'ctype' => $ctype, 'semester' => $semester, 'kd_progstudi' => $kd_progstudi, 'thn_akademik' => $this->session->userdata('thn_akademik'), 'kd_kelas' => $kd_kelas],
        );
        $this->load->view('template/header');
        $this->load->view('input_soal_esai_uas', [
            'kd_matkul' => $kd_matkul, 'title' => $kd_matkul, 'kd_kelas' => $kd_kelas, 'soal_matkul' => $this->soal_matakuliah, 'ctype' => $ctype, 'semester' => $semester, 'kd_progstudi' => $kd_progstudi
        ]);
        $this->load->view('template/footer');
    }

    public function melihat_jawaban_esai_dan_nilai_uts($kd_progstudi, $kd_matkul, $kd_kelas, $semester, $ctype)
    {
        /**
         * SELECT cbt_jawaban.jawaban, cbt_jawaban.npm, cbt_soal.soal, cbt_soal.kd_soal FROM cbt_jawaban JOIN cbt_soal ON cbt_jawaban.kd_soal = cbt_soal.kd_soal WHERE cbt_soal.ctype = 3 AND cbt_soal.kd_matkul = 'IS301' AND cbt_soal.kd_kelas = "C" AND cbt_soal.thn_akademik = '2022/2023';
         */
        $this->session->set_userdata('kd_matkul', $kd_matkul);
        $this->soal_matakuliah = $this->essay_model->show_data(
            column: 'kd_soal, soal, kunci_jawaban, aktif, bobot_soal, gambar',
            table: 'cbt_soal',
            param: ['kd_matkul' => $kd_matkul, 'ctype' => $ctype, 'semester' => $semester, 'kd_progstudi' => $kd_progstudi, 'thn_akademik' => $this->session->userdata('thn_akademik'), 'kd_kelas' => $kd_kelas, 'aktif' => 1],
        );
        $progstudi = $this->essay_model->show_data(column: 'nama_progstudi', table: 'cbt_progstudi', param: ['kd_progstudi' => $kd_progstudi]);
        $nama_matkul = $this->essay_model->show_data(column: 'mata_kuliah', table: 'cbt_matkul', param: ['kd_matkul' => $kd_matkul]);
        $data_mahasiswa = $this->db->select('cbt_kontrak_matakuliah.npm, cbt_kontrak_matakuliah.nilai_uts')->from('cbt_kontrak_matakuliah')->distinct()
            ->join('cbt_mahasiswa', 'cbt_kontrak_matakuliah.npm = cbt_mahasiswa.npm')->where(['cbt_kontrak_matakuliah.thn_akademik' => $this->session->userdata('thn_akademik'), 'cbt_kontrak_matakuliah.kd_matkul' => $kd_matkul, 'cbt_mahasiswa.kd_kelas' => $kd_kelas])
            ->order_by('cbt_kontrak_matakuliah.npm', 'ASC')->get()->result_array();
        $jawaban_mahasiswa = $this->db->select('cbt_jawaban.jawaban, cbt_jawaban.npm, cbt_soal.soal, cbt_soal.kd_soal, cbt_jawaban.hasil_nilai, cbt_jawaban.kd_jawaban')
            ->from('cbt_jawaban')
            ->join('cbt_soal', 'cbt_jawaban.kd_soal = cbt_soal.kd_soal')
            ->where([
                'cbt_soal.ctype' => $ctype,
                'cbt_soal.kd_matkul' => $kd_matkul,
                'cbt_soal.kd_kelas' => $kd_kelas,
                'cbt_soal.kd_progstudi' => $kd_progstudi,
                'cbt_soal.semester' => $semester,
                'cbt_soal.thn_akademik' => $this->session->userdata('thn_akademik')
            ])->order_by('cbt_jawaban.npm', 'ASC')->get()->result_array();

        $this->load->view('template/header');
        $this->load->view(
            'melihat_jawaban_esai_dan_nilai_uts',
            ['kd_matkul' => $kd_matkul, 'jawaban_mahasiswa' => $jawaban_mahasiswa, 'soal_matakuliah' => $this->soal_matakuliah, 'data_mahasiswa' => $data_mahasiswa, 'nama_matkul' => $nama_matkul[0]['mata_kuliah'], 'semester' => $semester, 'kd_kelas' => $kd_kelas, 'progstudi' => $progstudi[0]['nama_progstudi']]
        );
        $this->load->view('template/footer');
    }

    public function data_mahasiswa($kd_progstudi, $kd_matkul, $kd_kelas, $semester)
    {
        $progstudi = $this->essay_model->show_data(column: 'nama_progstudi', table: 'cbt_progstudi', param: ['kd_progstudi' => $kd_progstudi]);
        $nama_matkul = $this->essay_model->show_data(column: 'mata_kuliah', table: 'cbt_matkul', param: ['kd_matkul' => $kd_matkul]);
        $data_mahasiswa = $this->db->select('cbt_kontrak_matakuliah.npm, cbt_kontrak_matakuliah.akses_ujian')->from('cbt_kontrak_matakuliah')->distinct()
            ->join('cbt_mahasiswa', 'cbt_kontrak_matakuliah.npm = cbt_mahasiswa.npm')->where(['cbt_kontrak_matakuliah.thn_akademik' => $this->session->userdata('thn_akademik'), 'cbt_kontrak_matakuliah.kd_matkul' => $kd_matkul, 'cbt_mahasiswa.kd_kelas' => $kd_kelas])
            ->order_by('cbt_kontrak_matakuliah.npm', 'ASC')->get()->result_array();
        $this->load->view('template/header');
        $this->load->view(
            'data_mahasiswa',
            ['kd_matkul' => $kd_matkul, 'data_mahasiswa' => $data_mahasiswa, 'nama_matkul' => $nama_matkul[0]['mata_kuliah'], 'semester' => $semester, 'kd_kelas' => $kd_kelas, 'progstudi' => $progstudi[0]['nama_progstudi'], 'kd_progstudi' => $kd_progstudi]
        );
        $this->load->view('template/footer');
    }

    public function melihat_jawaban_esai_dan_nilai_uas($kd_progstudi, $kd_matkul, $kd_kelas, $semester, $ctype)
    {
        $this->session->set_userdata('kd_matkul', $kd_matkul);
        $this->soal_matakuliah = $this->essay_model->show_data(
            column: 'kd_soal, soal, kunci_jawaban, aktif, bobot_soal, gambar',
            table: 'cbt_soal',
            param: ['kd_matkul' => $kd_matkul, 'ctype' => $ctype, 'semester' => $semester, 'kd_progstudi' => $kd_progstudi, 'thn_akademik' => $this->session->userdata('thn_akademik'), 'kd_kelas' => $kd_kelas, 'aktif' => 1],
        );
        $progstudi = $this->essay_model->show_data(column: 'nama_progstudi', table: 'cbt_progstudi', param: ['kd_progstudi' => $kd_progstudi]);
        $nama_matkul = $this->essay_model->show_data(column: 'mata_kuliah', table: 'cbt_matkul', param: ['kd_matkul' => $kd_matkul]);
        $data_mahasiswa = $this->db->select('cbt_kontrak_matakuliah.npm, cbt_kontrak_matakuliah.nilai_uas')->from('cbt_kontrak_matakuliah')->distinct()
            ->join('cbt_mahasiswa', 'cbt_kontrak_matakuliah.npm = cbt_mahasiswa.npm')->where(['cbt_kontrak_matakuliah.thn_akademik' => $this->session->userdata('thn_akademik'), 'cbt_kontrak_matakuliah.kd_matkul' => $kd_matkul, 'cbt_mahasiswa.kd_kelas' => $kd_kelas])
            ->order_by('cbt_kontrak_matakuliah.npm', 'ASC')->get()->result_array();
        $this->data_mahasiswa = $this->db->select('cbt_jawaban.jawaban, cbt_jawaban.npm, cbt_soal.soal, cbt_soal.kd_soal, cbt_jawaban.hasil_nilai, cbt_jawaban.kd_jawaban')
            ->from('cbt_jawaban')
            ->join('cbt_soal', 'cbt_jawaban.kd_soal = cbt_soal.kd_soal')
            ->where([
                'cbt_soal.ctype' => $ctype,
                'cbt_soal.kd_matkul' => $kd_matkul,
                'cbt_soal.kd_kelas' => $kd_kelas,
                'cbt_soal.kd_progstudi' => $kd_progstudi,
                'cbt_soal.semester' => $semester,
                'cbt_soal.thn_akademik' => $this->session->userdata('thn_akademik')
            ])->order_by('cbt_jawaban.npm', 'DESC')->get()->result_array();

        $this->load->view('template/header');
        $this->load->view(
            'melihat_jawaban_esai_dan_nilai_uas',
            ['kd_matkul' => $kd_matkul, 'jawaban_mahasiswa' => $this->data_mahasiswa, 'soal_matakuliah' => $this->soal_matakuliah, 'data_mahasiswa' => $data_mahasiswa, 'nama_matkul' => $nama_matkul[0]['mata_kuliah'], 'semester' => $semester, 'kd_kelas' => $kd_kelas, 'progstudi' => $progstudi[0]['nama_progstudi']]
        );
        $this->load->view('template/footer');
    }

    public function hasil_algoritma($kd_jawaban)
    {
        $data_hasil = $this->essay_model->show_data(column: 'jawaban_mahasiswa, kunci_jawaban, winnowing_jawaban, winnowing_kunci_jawaban, dot_product, magnitude_esai, magnitude_kunci_jawaban, similarity', table: 'cbt_perhitungan_algoritma', param: ['kd_jawaban' => $kd_jawaban]);
        $nilai_perolehan = $this->essay_model->show_data(column: 'hasil_nilai', table: 'cbt_jawaban', param: ['kd_jawaban' => $kd_jawaban]);
        $this->load->view('template/header');
        $this->load->view('hasil_algoritma', ['title' => "Hasil Algoritma", 'data_hasil' => $data_hasil, 'nilai' => $nilai_perolehan]);
        $this->load->view('template/footer');
    }

    public function dashboard_home_mahasiswa()
    {

        $data_thn_akademik  = $this->essay_model->get_only_one_data(
            column: 'thn_akademik',
            table: 'cbt_soal',
            desc: true,
            item_desc: 'thn_akademik'
        );

        $daftar_mata_kuliah = [];
        if (!is_null($this->session->userdata('thn_akademik'))) {
            $data_matkul = [
                'thn_akademik' => $this->session->userdata('thn_akademik'),
                'npm' => $this->session->userdata('npm'),
            ];
        }
        if ($this->input->post('thn_akademik')) {
            $this->session->set_userdata(['thn_akademik' => $this->input->post('thn_akademik')]);
            $data_matkul = [
                'thn_akademik' => $this->input->post('thn_akademik'),
                'npm' => $this->session->userdata('npm'),
            ];
        }
        $this->mata_kuliah = $this->db->select('cbt_kontrak_matakuliah.kd_matkul, cbt_kontrak_matakuliah.akses_ujian, cbt_matkul.mata_kuliah, cbt_kontrak_matakuliah.semester')
            ->from('cbt_kontrak_matakuliah')
            ->join('cbt_matkul', 'cbt_kontrak_matakuliah.kd_matkul = cbt_matkul.kd_matkul')
            ->where([
                'cbt_kontrak_matakuliah.npm' => $data_matkul['npm'],
                'cbt_kontrak_matakuliah.thn_akademik' => $data_matkul['thn_akademik'],
            ])->get()->result_array();
        $this->load->view('template/header_mahasiswa');
        $this->load->view('dashboard_home_mahasiswa', ['title' => "Home", 'thn_akademik' => $data_thn_akademik, 'mata_kuliah' => $this->mata_kuliah]);
        $this->load->view('template/footer_mahasiswa');
    }

    public function menjawab_soal_esai($kd_matkul, $semester, $kd_kelas, $ctype)
    {
        $get_soal_matakuliah = [
            'kd_matkul' => $kd_matkul,
            'thn_akademik' => $this->session->userdata('thn_akademik'),
            'semester' => $semester,
            'kd_kelas' => $kd_kelas,
            'ctype' => $ctype,
            'aktif' => 1
        ];
        if (isset($_GET['kd_soal'])) {
            $get_soal_matakuliah['kd_soal'] = $_GET['kd_soal'];
            $this->soal_matakuliah = $this->essay_model->show_data(column: 'soal, kd_soal, kunci_jawaban, bobot_soal, ctype, gambar', table: 'cbt_soal', param: $get_soal_matakuliah, order_by: 'ASC', item_order: 'kd_soal');
            $this->data_mahasiswa = $this->db->select('cbt_soal.soal, cbt_soal.kd_soal, cbt_jawaban.jawaban')->distinct()
                ->from('cbt_jawaban')
                ->join('cbt_soal', 'cbt_jawaban.kd_soal = cbt_soal.kd_soal')
                ->where([
                    'cbt_soal.ctype' => $ctype,
                    'cbt_soal.kd_matkul' => $kd_matkul,
                    'cbt_soal.kd_kelas' => $kd_kelas,
                    'cbt_soal.semester' => $semester,
                    'cbt_soal.kd_soal' => $get_soal_matakuliah['kd_soal'],
                    'cbt_soal.thn_akademik' => $this->session->userdata('thn_akademik'),
                    'cbt_jawaban.npm' => $this->session->userdata('npm')
                ])->order_by('cbt_soal.kd_soal', 'ASC')->get()->result_array();
            // var_dump($this->data_mahasiswa);
        }
        unset($get_soal_matakuliah['kd_soal']);
        $total_jawaban_saved = $this->db->select('cbt_jawaban.jawaban, cbt_jawaban.kd_soal')
            ->from('cbt_jawaban')
            ->join('cbt_soal', 'cbt_jawaban.kd_soal = cbt_soal.kd_soal')
            ->where([
                'cbt_soal.ctype' => $ctype,
                'cbt_soal.kd_matkul' => $kd_matkul,
                'cbt_soal.kd_kelas' => $kd_kelas,
                'cbt_soal.semester' => $semester,
                'cbt_soal.thn_akademik' => $this->session->userdata('thn_akademik'),
                'cbt_jawaban.npm' => $this->session->userdata('npm')
            ])->order_by('cbt_soal.kd_soal', 'ASC')->get()->result_array();
        $get_kd_soal = $this->essay_model->show_data(column: 'kd_soal', table: 'cbt_soal', param: $get_soal_matakuliah, order_by: 'ASC', item_order: 'kd_soal');
        $progstudi = $this->essay_model->show_data(column: 'nama_progstudi', table: 'cbt_progstudi', param: ['kd_progstudi' => $this->session->userdata('kd_progstudi')]);
        $nama_matkul = $this->essay_model->show_data(column: 'mata_kuliah', table: 'cbt_matkul', param: ['kd_matkul' => $kd_matkul]);

        $this->load->view('template/header_mahasiswa', [
            'get_kd_soal' => $get_kd_soal,
            'kd_matkul' => $kd_matkul,
            'kd_kelas' => $kd_kelas,
            'semester' => $semester,
            'progstudi' => $progstudi[0]['nama_progstudi'],
            'nama_matkul' => $nama_matkul[0]['mata_kuliah'],
            'total_jawaban_saved' => $total_jawaban_saved
        ]);
        $this->load->view('menjawab_soal_esai', [
            'title' => "Esai",
            'soal_matakuliah' => $this->soal_matakuliah,
            'jawaban_mahasiswa' => $this->data_mahasiswa
        ]);
        $this->load->view('template/footer_mahasiswa');
    }
}
