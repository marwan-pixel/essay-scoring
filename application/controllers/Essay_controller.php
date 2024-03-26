<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Essay.php');

class Essay_Controller extends Essay {
    public function add_data_matkul() {
        if($this->input->method() === 'post') {
            $this->mata_kuliah = array(
                'kd_matkul' => $this->input->post('input_kd_matkul'),
                'nama_matkul' => $this->input->post('input_matkul')
            );
            $matkul_saved = $this->essay_model->add_matkul(table: 'mata_kuliah', data: $this->mata_kuliah);

            if($matkul_saved) {
               redirect(base_url());
            }
        }
    }

    public function add_data_soal() {
        if($this->input->method() === 'post') {
            $this->soal_matakuliah = array(
                'kd_soal' => $this->session->userdata('kd_matkul') . (string)rand(10,100),
                'kd_matkul' => $this->session->userdata('kd_matkul'),
                'soal' => $this->input->post('input_soal'),
                'skor' => $this->input->post('input_skor'),
                'bobot' => $this->input->post('input_bobot'),
                'kunci_jawaban' => $this->input->post('input_kunci_jawaban'),
            );
            $soal_saved = $this->essay_model->add_matkul(table: 'soal_esai', data: $this->soal_matakuliah);

            if($soal_saved) {
               redirect(base_url('soal_view/' . $this->session->userdata('kd_matkul')));
            }
        }
    }

    public function add_jawaban_mhs() {
        if($this->input->method() === 'post') {
            $this->jawaban_essay = array(
                'kd_soal' => $this->session->userdata('kd_soal'),
                'npm' => $this->input->post('input_npm'),
                'nama_mahasiswa' => $this->input->post('input_mahasiswa'),
                'jawaban' => $this->input->post('input_jawaban'),
                'nilai' => $this->essay_scoring(),
            );
            // $jawaban_saved = $this->essay_model->add_matkul(table: 'jawaban_mahasiswa', data: $this->jawaban_essay);
            ($this->text_preprocessing($this->jawaban_essay['jawaban'], $this->jawaban_essay['jawaban']));
            // if($jawaban_saved) {
            //    redirect(base_url('essay_scoring_view/' . $this->session->userdata('kd_soal')));
            // }
        }
    }

    private function essay_scoring() {
        return 0;
    }

    private function text_preprocessing(string $kunci_jawaban, string $jawaban) {
        $case_folding_kunci_jawaban = preg_replace('/[^\p{L}\s+]/u', "", strtolower($kunci_jawaban));
        $case_folding_jawaban = preg_replace('/[^\p{L}\s+]/u', "", strtolower($jawaban));
        exec('python '. APPPATH .'controllers/python/essay.py '.  escapeshellarg($case_folding_jawaban), $output);
        var_dump($output);
    }

    private function tokenization() {

    }
    
}