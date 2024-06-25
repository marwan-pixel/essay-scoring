<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Essay.php');

class Essay_Controller extends Essay
{
    public function loginService()
    {
        $loginData = array(
            'id' => $this->input->post('id'),
            'password' => $this->input->post('password')
        );

        $dataValidation = array(
            array(
                'field' => 'id',
                'label' => 'ID',
                'rules' => 'required|trim',
                'error' =>
                [
                    'required' => 'ID wajib diisi!'
                ]
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|trim',
                'error' =>
                [
                    'required' => 'Password wajib diisi!'
                ]
            ),
        );
        $this->form_validation->set_rules($dataValidation);
        if ($this->form_validation->run() === true) {
            $getData = (is_numeric($loginData["id"]) ? $this->essay_model->get_data_login(column: "npm, kd_kelas, kd_progstudi", table: "cbt_jawaban", param: ['npm' => $loginData['id']]) : $this->essay_model->get_data_login(column: "nip", table: "cbt_soal", param: ['nip' => $loginData['id']]));
            if (count($getData) > 0 || is_null($getData)) {
                if ($loginData['id'] !== $loginData['password']) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Password tidak sama!
                    </div>');
                    $this->login();
                } else {
                    if (array_key_exists('nip', $getData)) {
                        $this->session->set_userdata(['nip' => $getData['nip']]);
                        redirect('/');
                    } else {
                        $this->session->set_userdata(['npm' => $getData['npm'], 'kd_kelas' => $getData['kd_kelas'], 'kd_progstudi' => $getData['kd_progstudi']]);
                        redirect('dashboard_home_mahasiswa');
                    }
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    NIP atau NPM tidak terdaftar!
                    </div>');
                $this->login();
            }
        } else {
            $this->login();
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('nip');
        $this->session->unset_userdata('npm');
        $this->session->unset_userdata('kd_soal');
        $this->session->unset_userdata('kd_matkul');
        $this->session->unset_userdata('thn_akademik');
        redirect('/');
    }

    public function add_data_soal()
    {
        $this->soal_matakuliah = array(
            'kd_matkul' => $this->input->post('kd_matkul'),
            'semester' => $this->input->post('semester'),
            'kd_progstudi' => $this->input->post('kd_progstudi'),
            'kd_kelas' => $this->input->post('kd_kelas'),
            'ctype' => $this->input->post('ctype'),
            'soal' => $this->input->post('soal'),
            'bobot_soal' => $this->input->post('bobot_soal'),
            'kunci_jawaban' => $this->input->post('kunci_jawaban'),
            'thn_akademik' => $this->session->userdata('thn_akademik'),
            'nip' => $this->session->userdata('nip'),
            'aktif' => 1,
            'dentry' => date('Y-m-d h:m:s')
        );
        $dataValidation = array(
            array(
                'field' => 'soal',
                'label' => 'Soal',
                'rules' => 'required|trim',
                'error' =>
                [
                    'required' => 'Soal wajib diisi!'
                ]
            ),
            array(
                'field' => 'bobot_soal',
                'label' => 'Bobot Soal',
                'rules' => 'required|trim',
                'error' =>
                [
                    'required' => 'Bobot Soal wajib diisi!'
                ]
            ),
            array(
                'field' => 'kunci_jawaban',
                'label' => 'Kunci Jawaban',
                'rules' => 'required|trim',
                'error' =>
                [
                    'required' => 'Kunci Jawaban wajib diisi!'
                ]
            ),
        );
        $this->form_validation->set_rules($dataValidation);

        if ($this->form_validation->run() === true) {
            $soal_saved = $this->essay_model->add_data(table: 'cbt_soal', data: $this->soal_matakuliah);
            if ($soal_saved) {
                $this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">
        			Data Berhasil Ditambah
        			</div>');
                redirect(base_url(($this->soal_matakuliah['ctype'] == 3 ? 'input_soal_esai_uts/' : 'input_soal_esai_uas/')
                    . $this->input->post('kd_progstudi') . '/' . $this->session->userdata('kd_matkul')
                    . '/' . $this->input->post('kd_kelas') . '/' . $this->input->post('semester') . '/'
                    . $this->input->post('ctype')));
            }
        } else {
            redirect(base_url(($this->soal_matakuliah['ctype'] == 3 ? 'input_soal_esai_uts' : 'input_soal_esai_uas')
                . '/' . $this->input->post('kd_progstudi') . '/' . $this->session->userdata('kd_matkul')
                . '/' . $this->input->post('kd_kelas') . '/' . $this->input->post('semester') . '/'
                . $this->input->post('ctype')));
        }
    }

    public function update_status_soal($kd_progstudi, $kd_matkul, $kd_kelas, $semester, $ctype, $kd_soal, $aktif)
    {
        $updateParam = [
            'kd_soal' => $kd_soal,
            'thn_akademik' => $this->session->userdata('thn_akademik')
        ];
        $update = $this->essay_model->update_data(table: 'cbt_soal', data: ['aktif' => $aktif == 1 ? 0 : 1], param: $updateParam);
        if ($update) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Status Soal Berhasil Diubah!
            </div>');
            redirect(base_url($ctype === 3 ? 'input_soal_esai_uts/' : 'input_soal_esai_uas/' . $kd_progstudi . '/' . $kd_matkul
                . '/' . $kd_kelas . '/' . $semester . '/'
                . $ctype));
        }
    }

    public function simpan_jawaban_esai()
    {
        $dataValidation = array(
            array(
                'field' => 'jawaban',
                'label' => 'Jawaban',
                'rules' => 'required|trim',
                'error' =>
                [
                    'required' => 'Jawaban tidak boleh kosong dan wajib diisi!'
                ]
            ),
        );
        $this->jawaban_essay = array(
            'thn_akademik' => $this->input->post('thn_akademik'),
            'semester' => $this->input->post('semester'),
            'kd_kelas' => $this->input->post('kd_kelas'),
            'kd_progstudi' => $this->input->post('kd_progstudi'),
            'kd_matkul' => $this->input->post('kd_matkul'),
            'kd_soal' => $this->input->post('kd_soal'),
            'npm' => $this->input->post('npm'),
            'jawaban' => $this->input->post('jawaban'),
            'gambar' => '',
            'date_insert' => date('Y-m-d h:m:s'),
        );

        $this->form_validation->set_rules($dataValidation);
        if ($this->form_validation->run() === true) {
            $remove_breakline_jawaban = str_replace(PHP_EOL, ' ', $this->jawaban_essay['jawaban']);
            $remove_breakline_kj = str_replace(PHP_EOL, ' ', $this->input->post('kunci_jawaban'));
            $nilai = $this->essay_scoring(jawaban: $remove_breakline_jawaban, kunci_jawaban: $remove_breakline_kj, max_score: 5, bobot: $this->input->post('bobot_soal'));
            $this->jawaban_essay['hasil_nilai'] = $nilai['hasil_nilai'];
            echo '<pre>';
            print_r($nilai);
            echo '</pre>';
            die();
            $isAnswerSaved = $this->essay_model->show_data(column: 'jawaban', table: 'cbt_jawaban', param: ['kd_soal' => $this->jawaban_essay['kd_soal'], 'npm' => $this->jawaban_essay['npm']]);
            if (count($isAnswerSaved) == 0) {
                $jawaban_saved = $this->essay_model->add_data(table: 'cbt_jawaban', data: $this->jawaban_essay);
            } else {
                $jawaban_saved = $this->essay_model->update_data(table: 'cbt_jawaban', data: $this->jawaban_essay, param: ['kd_soal' => $this->jawaban_essay['kd_soal'], 'npm' => $this->jawaban_essay['npm']]);
            }
            if ($jawaban_saved) {
                $this->session->set_userdata('success', '<div class="alert alert-success" role="alert">
                Jawaban Berhasil Disimpan!
                </div>');
                redirect(base_url('menjawab_soal_esai' . '/' . $this->input->post('kd_matkul') . '/' . $this->input->post('semester')
                    . '/' . $this->input->post('kd_kelas') . '/' . $this->input->post('ctype')));
            }
        } else {
            redirect(base_url('menjawab_soal_esai' . '/' . $this->input->post('kd_matkul') . '/' . $this->input->post('semester')
                . '/' . $this->input->post('kd_kelas') . '/' . $this->input->post('ctype')));
        }
    }
    public function essay_scoring(string $jawaban, string $kunci_jawaban, int $max_score, int $bobot)
    {
        $preprocessed_answer = $this->text_preprocessing($jawaban);
        $preprocessed_key_answer = $this->text_preprocessing($kunci_jawaban);
        // $sinonim_processed_answer = $this->sinonim_checker($preprocessed_answer, $preprocessed_key_answer);
        $array_answer = explode(" ", $preprocessed_answer);
        $array_key_answer = explode(" ", $preprocessed_key_answer);
        $array = [];
        for ($i = 0; $i < count($array_answer); $i++) {
            if (in_array($array_answer[$i], $array_key_answer)) {
                array_push($array, $array_answer[$i]);
            }
        }
        $preprocessed_answer = implode(" ", ($array));
        // if (count($array_answer) > count($array_key_answer)) {
        // }
        $tokenized_answer = $this->tokenization($preprocessed_answer, 4);
        $tokenized_key_answer = $this->tokenization($preprocessed_key_answer, 4);
        $hashing_answer = $this->rolling_hash($tokenized_answer, 3);
        $hashing_key_answer = $this->rolling_hash($tokenized_key_answer, 3);
        $winnowing_answer = $this->winnowing($hashing_answer, 4);
        $winnowing_key_answer = $this->winnowing($hashing_key_answer, 4);
        $similarity = $this->cosine_similarity(kunci_jawaban: $winnowing_key_answer, jawaban: $winnowing_answer);
        if ($similarity === 0) {
            $score = 0;
        } else {
            $score = -1;
        }
        for ($i = 0; $i < ($max_score) + 1; $i++) {
            $val = 0;
            $val += $i / ($max_score + 1);
            if ($similarity < $val || $similarity == 0) {
                break;
            }
            $score += 1;
        }
        $final_score = ($score / $max_score) * $bobot;
        return array(
            'jawaban' => $jawaban,
            'preprocessed_answer' => $preprocessed_answer,
            'preprocessed_key_answer' => $preprocessed_key_answer,
            'tokenized_answer' => $tokenized_answer,
            'tokenized_key_answer' => $tokenized_key_answer,
            'hashing_answer' => $hashing_answer,
            'hashing_key_answer' => $hashing_key_answer,
            'winnowing_answer' => $winnowing_answer,
            'winnowing_key_answer' => $winnowing_key_answer,
            'similarity' => $similarity,
            'hasil_nilai' => $final_score
        );
    }

    private function text_preprocessing(string $kalimat): string
    {
        $decoded_string = html_entity_decode(strip_tags($kalimat));
        $cleaned_string = preg_replace('/[<>"\'&!--]/', '', $decoded_string);
        $case_folding_kalimat = preg_replace('/[^\p{L}\s\s+]/u', "", strtolower(($cleaned_string)));
        exec('python ' . APPPATH . 'controllers/python/essay.py ' . escapeshellarg($case_folding_kalimat), $output);
        return ($output[0]);
    }

    // private function get_sinonim(string $keyword_jawaban, string $keyword_kunci_jawaban)
    // {
    //     $dict_json = file_get_contents(APPPATH . 'controllers/dict.json');
    //     $dict_data = json_decode($dict_json);
    //     $array_kunci_jawaban = explode(" ", $keyword_kunci_jawaban);
    //     if (property_exists($dict_data, $keyword_jawaban)) {
    //         for ($i = 0; $i < count($dict_data->$keyword_jawaban->sinonim); $i++) {
    //             if (in_array($dict_data->$keyword_jawaban->sinonim[$i], $array_kunci_jawaban)) {
    //                 return $dict_data->$keyword_jawaban->sinonim[$i];
    //             }
    //         }
    //     } else {
    //         return null;
    //     }
    // }
    // private function sinonim_checker(string $jawaban, string $kunci_jawaban)
    // {
    //     $array_jawaban = explode(" ", $jawaban);
    //     $results = [];
    //     for ($i = 0; $i < count($array_jawaban); $i++) {
    //         $sinonim_keyword = $this->get_sinonim($array_jawaban[$i], $kunci_jawaban);
    //         if (is_null($sinonim_keyword)) {
    //             array_push($results, $array_jawaban[$i]);
    //         } else {
    //             array_push($results, $sinonim_keyword);
    //         }
    //     }
    //     return implode(" ", $results);
    // }

    private function tokenization(string $kalimat, int $n): array
    {
        $tokenSize = $n;
        if (strlen($kalimat) == 0) {
            return array();
        }
        if (strlen($kalimat) < $n) {
            $tokenSize = strlen($kalimat);
        }
        $whitespace_removal = str_replace(" ", "", $kalimat);
        $n_grams = $n_gram = [];
        for ($i = 0; $i < strlen($whitespace_removal); $i++) {
            array_push($n_gram, $whitespace_removal[$i]);
            array_push($n_grams, implode($n_gram));
            if ($i >= ($tokenSize - 1)) {
                array_shift($n_gram);
            }
        }
        while (--$tokenSize) {
            array_shift($n_grams);
        }
        return $n_grams;
    }

    private function rolling_hash(array $pattern, int $windowSize, int $base = 26, int $mod = 1000000007): array
    {
        $n = sizeof($pattern);
        if ($n == 0) {
            return array(0);
        }
        // Array untuk menyimpan hasil pangkat base modulo mod
        $power = array_fill(0, $n + 1, 1);
        // Array untuk menyimpan nilai hash dari setiap window substring
        $hashValues = array();
        // Precompute the powers of the base modulo the mod
        for ($i = 1; $i <= $n; $i++) {
            $power[$i] = ($power[$i - 1] * $base) % $mod;
        }
        // Compute the hash value of the first window
        $currentHash = 0;
        for ($i = 0; $i < $windowSize; $i++) {
            $currentHash = ($currentHash * $base + ord($pattern[$i])) % $mod;
        }
        $hashValues[0] = $currentHash;
        // Compute the hash values of the rest of the substrings
        for ($i = 1; $i <= $n - $windowSize; $i++) {
            // Remove the contribution of the first character in the window
            $currentHash = (($currentHash - $power[$windowSize - 1] * ord($pattern[$i - 1])) % $mod + $mod) % $mod;
            // Shift the window by one character and add the new character to the hash
            $currentHash = ($currentHash * $base + ord($pattern[$i + $windowSize - 1])) % $mod;
            // Simpan nilai hash pada array hashValues
            $hashValues[$i] = $currentHash;
        }
        // Mengembalikan array hashValues yang berisi hash untuk setiap window substring
        return $hashValues;
    }

    private function winnowing(array $hash_value, int $k): array
    {
        $results = [];
        for ($i = 0; $i < sizeof($hash_value) - $k; $i++) {
            $window = array_slice($hash_value, $i, $k);
            $min_hash = min($window);
            array_push($results, $min_hash);
        }

        return $results;
    }

    private function cosine_similarity(array $kunci_jawaban, array $jawaban)
    {
        // Calculate dot product 
        $length = max(count($kunci_jawaban), count($jawaban));
        $kunci_jawaban = array_pad($kunci_jawaban, $length, 0);
        $jawaban = array_pad($jawaban, $length, 0);

        $intersection = (array_intersect($jawaban, $kunci_jawaban));
        if (count($intersection) === 0) {
            $similarity = 0;
        } else {
            $dotProduct = 0;
            for ($i = 0; $i < $length; $i++) {
                $dotProduct += $kunci_jawaban[$i] * $jawaban[$i];
            }
            // Calculate magnitudes
            $magnitude1 = sqrt(array_sum(array_map(function ($x) {
                return $x * $x;
            }, $kunci_jawaban)));
            $magnitude2 = sqrt(array_sum(array_map(function ($y) {
                return $y * $y;
            }, $jawaban)));
            // Calculate cosine similarity
            $similarity = $dotProduct / ($magnitude1 * $magnitude2);
        }
        return $similarity;
    }
}
