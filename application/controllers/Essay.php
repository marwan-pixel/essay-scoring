<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Essay extends CI_Controller {
    protected $mata_kuliah = array();
    protected $soal_matakuliah = array();
    protected $jawaban_essay = array();
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
    }
    
     public function index()
	{
        $this->session->unset_userdata('kd_matkul');
        $this->mata_kuliah = $this->essay_model->show_data("kd_matkul, nama_matkul", 'mata_kuliah');
        $this->load->view('template/header');
		$this->load->view('home_view', ['no' => 1, 'mata_kuliah' => $this->mata_kuliah]);
        $this->load->view('template/footer');
	}

    public function soal_view($kd_matkul) {
        $this->session->set_userdata('kd_matkul', $kd_matkul);
        $this->soal_matakuliah = $this->essay_model->show_data('kd_soal, soal, skor, bobot, kunci_jawaban', 'soal_esai' ,['kd_matkul' => $kd_matkul]);
        $this->load->view('template/header');
		$this->load->view('soal_view', ['kd_matkul' => $kd_matkul, 'title' => '', 'soal_matkul' => $this->soal_matakuliah]);
        $this->load->view('template/footer');
    }

    public function essay_scoring_view($kd_soal) {
        $this->session->set_userdata('kd_soal', $kd_soal);
        $this->soal_matakuliah = $this->essay_model->show_data('soal, skor, bobot, kunci_jawaban', 'soal_esai' ,['kd_soal' => $kd_soal]);
        $this->jawaban_essay = $this->essay_model->show_data('id_jawaban, kd_soal, npm, nama_mahasiswa, jawaban', 'jawaban_mahasiswa', ['kd_soal' => $kd_soal]);
        $this->hasil_algoritma = $this->essay_model->show_data('kd_jawaban, pre_processing_jawaban, pre_processing_kj, tokenisasi_jawaban, tokenisasi_kj, hashing_jawaban, hashing_kj, winnowing_jawaban, winnowing_kj, similarity, skor', 'hasil_algoritma', ['kd_jawaban' => 18]);
        $this->load->view('template/header');
        $this->load->view('essay_scoring_view', ['kd_soal' => $kd_soal , 'jawaban' => $this->jawaban_essay, 'soal' => $this->soal_matakuliah,  'hasil' => $this->hasil_algoritma[0]]);
        $this->load->view('template/footer');
    }
}