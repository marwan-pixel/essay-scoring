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
            $getData = (is_numeric($loginData["id"]) ? $this->essay_model->get_data_login(column: "npm, nama_mahasiswa, kd_kelas, kd_progstudi", table: "cbt_mahasiswa", param: ['npm' => $loginData['id']]) : $this->essay_model->get_data_login(column: "nip, nama_dosen", table: "cbt_dosen", param: ['nip' => $loginData['id']]));
            // var_dump(count($getData) > 0);
            // die();
            if (!is_null($getData)) {
                if ($loginData['id'] !== $loginData['password']) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Password tidak sama!
                    </div>');
                    $this->login();
                } else {
                    if (array_key_exists('nip', $getData)) {
                        $this->session->set_userdata(['nip' => $getData['nip'], 'nama_dosen' => $getData['nama_dosen']]);
                        redirect('/');
                    } else {
                        $this->session->set_userdata(['npm' => $getData['npm'], 'kd_kelas' => $getData['kd_kelas'], 'kd_progstudi' => $getData['kd_progstudi'], 'nama_mahasiswa' => $getData['nama_mahasiswa']]);
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
        $this->session->unset_userdata('nama_dosen');
        $this->session->unset_userdata('npm');
        $this->session->unset_userdata('kd_soal');
        $this->session->unset_userdata('kd_matkul');
        $this->session->unset_userdata('semester');
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
            'aktif' => (int)$this->input->post('aktif'),
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
        );

        $this->form_validation->set_rules($dataValidation);
        if ($this->form_validation->run() === true) {
            if (!empty($_FILES['gambar']['name'])) {
                $config['upload_path'] = FCPATH . '/assets/gambar';
                $config['allowed_types'] = 'gif|png|jpg|jpeg';
                $config['max_size'] = 5000;
                $config['overwrite'] = true;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('gambar')) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    ' . $this->upload->display_errors() . '
                    </div>');
                    redirect(base_url(($this->soal_matakuliah['ctype'] == 3 ? 'input_soal_esai_uts/' : 'input_soal_esai_uas/')
                        . $this->input->post('kd_progstudi') . '/' . $this->session->userdata('kd_matkul')
                        . '/' . $this->input->post('kd_kelas') . '/' . $this->input->post('semester') . '/'
                        . $this->input->post('ctype')));
                } else {
                    $gambar = $this->upload->data();
                    $this->soal_matakuliah['gambar'] = $gambar['file_name'];
                }
            }
            $isAnswerSaved = $this->essay_model->show_data(column: 'soal', table: 'cbt_soal', param: ['kd_soal' => $this->input->post('kd_soal')]);
            // var_dump($isAnswerSaved);
            // die();
            if (count($isAnswerSaved) == 0) {
                $this->soal_matakuliah['aktif'] = 1;
                $soal_saved = $this->essay_model->add_data(table: 'cbt_soal', data: $this->soal_matakuliah);
            } else {
                unset($this->soal_matakuliah['dentry']);
                $this->soal_matakuliah['dupdate'] = date('Y-m-d h:m:s');
                $soal_saved = $this->essay_model->update_data(table: 'cbt_soal', data: $this->soal_matakuliah, param: ['kd_soal' => $this->input->post('kd_soal')]);
            }
            if ($soal_saved) {
                $this->session->set_flashdata('success', '<div class="alert alert-success" role="alert">
            		Data Berhasil Disimpan
            		</div>');
                redirect(base_url(($this->soal_matakuliah['ctype'] == 3 ? 'input_soal_esai_uts/' : 'input_soal_esai_uas/')
                    . $this->input->post('kd_progstudi') . '/' . $this->session->userdata('kd_matkul')
                    . '/' . $this->input->post('kd_kelas') . '/' . $this->input->post('semester') . '/'
                    . $this->input->post('ctype')));
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        			Soal Esai harus diisi!
        			</div>');
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
            redirect(base_url($ctype === 3 ? 'input_soal_esai_uas/' : 'input_soal_esai_uts/' . $kd_progstudi . '/' . $kd_matkul
                . '/' . $kd_kelas . '/' . $semester . '/'
                . $ctype));
        }
    }

    public function memberi_akses_ujian($npm, $kd_kelas, $kd_progstudi, $semester, $kd_matkul, $akses_ujian)
    {
        $updateParam = [
            'npm' => $npm,
            'semester' => $semester,
            'kd_matkul' => $kd_matkul,
            'thn_akademik' => $this->session->userdata('thn_akademik')
        ];
        $update = $this->essay_model->update_data(table: 'cbt_kontrak_matakuliah', data: ['akses_ujian' => $akses_ujian], param: $updateParam);
        if ($update) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Akses Ujian Berhasil Di update
            </div>');
            redirect(base_url('data_mahasiswa/' . $kd_progstudi . '/' . $kd_matkul
                . '/' . $kd_kelas . '/' . $semester));
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
            $remove_breakline_jawaban = $this->jawaban_essay['jawaban'];
            $remove_breakline_kj = $this->input->post('kunci_jawaban');
            $nilai = $this->essay_scoring(jawaban: $remove_breakline_jawaban, kunci_jawaban: $remove_breakline_kj, bobot: $this->input->post('bobot_soal'));
            echo '<pre>';
            var_dump($nilai);
            // var_dump($this->jawaban_essay['kd_matkul']);
            echo '</pre>';
            die();
            $this->jawaban_essay['hasil_nilai'] = $nilai['hasil_nilai'];
            $isAnswerSaved = $this->essay_model->show_data(column: 'jawaban', table: 'cbt_jawaban', param: ['kd_soal' => $this->jawaban_essay['kd_soal'], 'npm' => $this->jawaban_essay['npm']]);
            if (count($isAnswerSaved) == 0) {
                $jawaban_saved = $this->essay_model->add_data(table: 'cbt_jawaban', data: $this->jawaban_essay);
            } else {
                $jawaban_saved = $this->essay_model->update_data(table: 'cbt_jawaban', data: $this->jawaban_essay, param: ['kd_soal' => $this->jawaban_essay['kd_soal'], 'npm' => $this->jawaban_essay['npm']]);
            }
            $total_nilai = $this->db->select('SUM(cbt_jawaban.hasil_nilai)')
                ->from('cbt_jawaban')
                ->join('cbt_soal', 'cbt_jawaban.kd_soal = cbt_soal.kd_soal')
                ->where([
                    'cbt_soal.ctype' => $this->input->post('ctype'),
                    'cbt_jawaban.npm' => $this->jawaban_essay['npm'],
                    'cbt_soal.semester' => $this->jawaban_essay['semester'],
                    'cbt_soal.kd_matkul' => $this->jawaban_essay['kd_matkul'],
                    'cbt_soal.thn_akademik' => $this->session->userdata('thn_akademik'),
                ])->get()->result_array();
            $nilai_rekapitulasi_saved = $this->input->post('ctype') == 3 ?
                $this->essay_model->update_data(table: 'cbt_kontrak_matakuliah', data: ['nilai_uts' => $total_nilai[0]['SUM(cbt_jawaban.hasil_nilai)']], param: ['kd_matkul' => $this->jawaban_essay['kd_matkul'], 'npm' =>  $this->jawaban_essay['npm'], 'thn_akademik' =>  $this->jawaban_essay['thn_akademik'], 'semester' =>  $this->jawaban_essay['semester']]) :
                $this->essay_model->update_data(table: 'cbt_kontrak_matakuliah', data: ['nilai_uas' => $total_nilai[0]['SUM(cbt_jawaban.hasil_nilai)']], param: ['kd_matkul' => $this->jawaban_essay['kd_matkul'], 'npm' =>  $this->jawaban_essay['npm'], 'thn_akademik' =>  $this->jawaban_essay['thn_akademik'], 'semester' =>  $this->jawaban_essay['semester']]);
            unset($nilai['hasil_nilai']);
            $kd_jawaban = $this->essay_model->show_data(column: 'kd_jawaban', table: 'cbt_jawaban', param: ['kd_soal' => $this->jawaban_essay['kd_soal'], 'npm' => $this->jawaban_essay['npm']]);
            $hasil_algoritma_get = $this->essay_model->show_data(column: 'kd_jawaban', table: 'cbt_perhitungan_algoritma', param: ['kd_jawaban' => $kd_jawaban[0]['kd_jawaban']]);
            if (count($hasil_algoritma_get) == 0) {
                $nilai['kd_jawaban'] = $kd_jawaban[0]['kd_jawaban'];
                $hasil_algoritma_saved = $this->essay_model->add_data(table: 'cbt_perhitungan_algoritma', data: $nilai);
            } else {
                $hasil_algoritma_saved = $this->essay_model->update_data(table: 'cbt_perhitungan_algoritma', data: $nilai, param: ['kd_jawaban' => $hasil_algoritma_get[0]['kd_jawaban']]);
            }
            if ($jawaban_saved && $hasil_algoritma_saved && $nilai_rekapitulasi_saved) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Jawaban Berhasil Disimpan!
                </div>');
                redirect(base_url('menjawab_soal_esai' . '/' . $this->input->post('kd_matkul') . '/' . $this->input->post('semester')
                    . '/' . $this->input->post('kd_kelas') . '/' . $this->input->post('ctype') . '?kd_soal=' .  $this->jawaban_essay['kd_soal']));
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Data Tidak boleh ada yang kosong
                </div>');
            redirect(base_url('menjawab_soal_esai' . '/' . $this->input->post('kd_matkul') . '/' . $this->input->post('semester')
                . '/' . $this->input->post('kd_kelas') . '/' . $this->input->post('ctype')));
        }
    }

    public function mengakhiri_ujian($npm, $semester, $kd_matkul)
    {
        $updateParam = [
            'npm' => $npm,
            'semester' => $semester,
            'kd_matkul' => $kd_matkul,
            'thn_akademik' => $this->session->userdata('thn_akademik')
        ];

        $update = $this->essay_model->update_data(table: 'cbt_kontrak_matakuliah', data: ['akses_ujian' => 0], param: $updateParam);
        if ($update) {
            redirect(base_url('dashboard_home_mahasiswa'));
        }
    }

    public function essay_scoring(string $jawaban, string $kunci_jawaban, int $bobot)
    {
        $process = $this->text_preprocessing($jawaban, $kunci_jawaban, $bobot);
        // $preprocessed_key_answer_ = $this->text_preprocessing($kunci_jawaban);
        // $array_answer = explode(" ", $preprocessed_answer_);
        // $array_key_answer = explode(" ", $preprocessed_key_answer_);
        // $array = [];
        // foreach ($array_key_answer as $value) {
        //     $count = count(array_keys(array_map('strtolower', $array_answer), strtolower($value)));
        //     for ($i = 0; $i < $count; $i++) {
        //         $array[] = $value;
        //     }
        //     $array_answer = array_diff($array_answer, [$value]);
        // }
        // $preprocessed_answer = implode(" ", array_unique($array));
        // $preprocessed_key_answer = implode(" ", array_unique($array_key_answer));

        // $tokenized_answer = $this->tokenization($preprocessed_answer, 4);
        // $tokenized_key_answer = $this->tokenization($preprocessed_key_answer, 4);
        // $hashing_answer = $this->rolling_hash($tokenized_answer, 3);
        // $hashing_key_answer = $this->rolling_hash($tokenized_key_answer, 3);
        // $winnowing_answer = $this->winnowing($hashing_answer, 4);
        // $winnowing_key_answer = $this->winnowing($hashing_key_answer, 4);
        // $similarity = $process->similarity;
        // $final_score = $similarity * $bobot;
        // return array(
        //     'jawaban_mahasiswa' => $process->jawaban,
        //     'kunci_jawaban' => $process->kunci_jawaban,
        //     'winnowing_jawaban' => json_encode($process->winnowing_jawaban_essay),
        //     'winnowing_kunci_jawaban' => json_encode($process->winnowing_kunci_jawaban),
        //     'dot_product' => $process->dot_product,
        //     'magnitude_esai' => $process->magnitude_esai,
        //     'magnitude_kunci_jawaban' => $process->magnitude_kj,
        //     'similarity' => $similarity,
        //     'hasil_nilai' => (int)round($final_score)
        // );
        return $process;
    }

    private function text_preprocessing(string $jawaban, string $kunci_jawaban, int $bobot)
    {
        $preprocessing_jawaban = strip_tags($jawaban);
        $preprocessing_kunci_jawaban = strip_tags($kunci_jawaban);

        $preprocessing_jawaban = html_entity_decode($preprocessing_jawaban);
        $preprocessing_kunci_jawaban = html_entity_decode($preprocessing_kunci_jawaban);

        $preprocessing_jawaban = preg_replace('/[^\w\s]/u', '', $preprocessing_jawaban);
        $preprocessing_kunci_jawaban = preg_replace('/[^\w\s]/u', '', $preprocessing_kunci_jawaban);

        $preprocessing_jawaban = preg_replace('/\s+/', ' ', $preprocessing_jawaban);
        $preprocessing_kunci_jawaban = preg_replace('/\s+/', ' ', $preprocessing_kunci_jawaban);

        $preprocessing_jawaban = trim($preprocessing_jawaban);
        $preprocessing_kunci_jawaban = trim($preprocessing_kunci_jawaban);

        $preprocessing_jawaban = strtolower($preprocessing_jawaban);
        $preprocessing_kunci_jawaban = strtolower($preprocessing_kunci_jawaban);

        $data = array(
            'jawaban_esai' => $preprocessing_jawaban,
            'kunci_jawaban_esai' => $preprocessing_kunci_jawaban,
            'bobot' => $bobot
        );

        $json_data = json_encode($data);

        $url = 'http://localhost:5000/';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response);
    }

    // private function tokenization(string $kalimat, int $n): array
    // {
    //     $tokenSize = $n;
    //     if (strlen($kalimat) == 0) {
    //         return array();
    //     }
    //     if (strlen($kalimat) < $n) {
    //         $tokenSize = strlen($kalimat);
    //     }
    //     $whitespace_removal = str_replace(" ", "", $kalimat);
    //     $n_grams = $n_gram = [];
    //     for ($i = 0; $i < strlen($whitespace_removal); $i++) {
    //         array_push($n_gram, $whitespace_removal[$i]);
    //         array_push($n_grams, implode($n_gram));
    //         if ($i >= ($tokenSize - 1)) {
    //             array_shift($n_gram);
    //         }
    //     }
    //     while (--$tokenSize) {
    //         array_shift($n_grams);
    //     }
    //     return $n_grams;
    // }

    // private function rolling_hash(array $pattern, int $windowSize, int $base = 26, int $mod = 1000000007): array
    // {
    //     $n = sizeof($pattern);
    //     if ($n == 0) {
    //         return array(0);
    //     }
    //     // Array untuk menyimpan hasil pangkat base modulo mod
    //     $power = array_fill(0, $n + 1, 1);
    //     // Array untuk menyimpan nilai hash dari setiap window substring
    //     $hashValues = array();
    //     // Precompute the powers of the base modulo the mod
    //     for ($i = 1; $i <= $n; $i++) {
    //         $power[$i] = ($power[$i - 1] * $base) % $mod;
    //     }
    //     // Compute the hash value of the first window
    //     $currentHash = 0;
    //     for ($i = 0; $i < $windowSize; $i++) {
    //         $currentHash = ($currentHash * $base + ord($pattern[$i])) % $mod;
    //     }
    //     $hashValues[0] = $currentHash;
    //     // Compute the hash values of the rest of the substrings
    //     for ($i = 1; $i <= $n - $windowSize; $i++) {
    //         // Remove the contribution of the first character in the window
    //         $currentHash = (($currentHash - $power[$windowSize - 1] * ord($pattern[$i - 1])) % $mod + $mod) % $mod;
    //         // Shift the window by one character and add the new character to the hash
    //         $currentHash = ($currentHash * $base + ord($pattern[$i + $windowSize - 1])) % $mod;
    //         // Simpan nilai hash pada array hashValues
    //         $hashValues[$i] = $currentHash;
    //     }
    //     // Mengembalikan array hashValues yang berisi hash untuk setiap window substring
    //     return $hashValues;
    // }

    // private function winnowing(array $hash_value, int $k): array
    // {
    //     $results = [];
    //     for ($i = 0; $i < sizeof($hash_value) - $k; $i++) {
    //         $window = array_slice($hash_value, $i, $k);
    //         $min_hash = min($window);
    //         array_push($results, $min_hash);
    //     }

    //     return $results;
    // }

    // private function cosine_similarity(array $kunci_jawaban, array $jawaban)
    // {
    //     // Calculate dot product 
    // $length = max(count($kunci_jawaban), count($jawaban));
    // $kunci_jawaban = array_pad($kunci_jawaban, $length, 0);
    // $jawaban = array_pad($jawaban, $length, 0);

    // $intersection = (array_intersect($jawaban, $kunci_jawaban));
    // if (count($intersection) === 0) {
    //     $similarity = 0;
    // } else {
    //     $dotProduct = 0;
    //     for ($i = 0; $i < $length; $i++) {
    //         $dotProduct += $kunci_jawaban[$i] * $jawaban[$i];
    //     }
    //     // Calculate magnitudes
    //     $magnitude1 = sqrt(array_sum(array_map(function ($x) {
    //         return $x * $x;
    //     }, $kunci_jawaban)));
    //     $magnitude2 = sqrt(array_sum(array_map(function ($y) {
    //         return $y * $y;
    //     }, $jawaban)));
    //     // Calculate cosine similarity
    //     $similarity = $dotProduct / ($magnitude1 * $magnitude2);
    // }
    // return $similarity;
    // }
}
