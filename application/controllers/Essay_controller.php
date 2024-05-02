<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Essay.php');

class Essay_Controller extends Essay
{
    public function add_data_matkul()
    {
        if ($this->input->method() === 'post') {
            $this->mata_kuliah = array(
                'kd_matkul' => $this->input->post('input_kd_matkul'),
                'nama_matkul' => $this->input->post('input_matkul')
            );
            $matkul_saved = $this->essay_model->add_data(table: 'mata_kuliah', data: $this->mata_kuliah);

            if ($matkul_saved) {
                redirect(base_url());
            }
        }
    }

    public function add_data_soal()
    {
        if ($this->input->method() === 'post') {
            $this->soal_matakuliah = array(
                'kd_soal' => $this->session->userdata('kd_matkul') . (string)rand(10, 100),
                'kd_matkul' => $this->session->userdata('kd_matkul'),
                'soal' => $this->input->post('input_soal'),
                'skor' => $this->input->post('input_skor'),
                'bobot' => $this->input->post('input_bobot'),
                'kunci_jawaban' => $this->input->post('input_kunci_jawaban'),
            );
            $soal_saved = $this->essay_model->add_data(table: 'soal_esai', data: $this->soal_matakuliah);

            if ($soal_saved) {
                redirect(base_url('soal_view/' . $this->session->userdata('kd_matkul')));
            }
        }
    }

    public function add_data_mhs()
    {
        if ($this->input->method() === 'post') {
            $this->data_mahasiswa = array(
                'npm' => $this->input->post('input_npm'),
                'nama_mahasiswa' => $this->input->post('input_nama'),
                'kelas' => $this->input->post('input_kelas'),
                'program_studi' => $this->input->post('input_prodi')
            );
        }
        $soal_saved = $this->essay_model->add_data(table: 'mahasiswa', data: $this->data_mahasiswa);
        if ($soal_saved) {
            redirect(base_url('mahasiswa_view/' . $this->session->userdata('kd_soal')));
        }
    }

    public function add_jawaban_mhs()
    {
        if ($this->input->method() === 'post') {
            $this->jawaban_essay = array(
                'kd_jawaban' =>  $this->session->userdata('kd_soal') . rand(0, 10),
                'kd_soal' => $this->session->userdata('kd_soal'),
                'npm' => $this->input->post('input_npm'),
                'nama_mahasiswa' => $this->input->post('input_mahasiswa'),
                'jawaban' => $this->input->post('input_jawaban'),
            );
            $remove_breakline_jawaban = str_replace(PHP_EOL, ' ', $this->jawaban_essay['jawaban']);
            $remove_breakline_kj = str_replace(PHP_EOL, ' ', $this->input->post('input_kunci_jawaban'));
            $final_score = $this->essay_scoring(jawaban: $remove_breakline_jawaban, kunci_jawaban: $remove_breakline_kj, max_score: $this->input->post('input_skor'), bobot: $this->input->post('input_bobot'));
            $final_score['kd_jawaban'] = $this->jawaban_essay['kd_jawaban'];
            // var_dump($final_score);
            $jawaban_saved = $this->essay_model->add_data(table: 'jawaban_mahasiswa', data: $this->jawaban_essay);

            unset($final_score['skor_akhir']);
            $hasil_jawaban_saved = $this->essay_model->add_data(table: 'hasil_algoritma', data: $final_score);
            if ($jawaban_saved && $hasil_jawaban_saved) {
                redirect(base_url('essay_scoring_view/' . $this->session->userdata('kd_soal') . '/' . $this->jawaban_essay['npm']));
            }
        }
    }

    public function update_jawaban_mhs($npm, $kd_jawaban)
    {
        if ($this->input->method() === 'post') {
            $this->jawaban_essay = array(
                'kd_jawaban' =>  $this->input->post('input_kd_jawaban'),
                'jawaban' => $this->input->post('input_jawaban'),
            );
            $remove_breakline_jawaban = str_replace(PHP_EOL, ' ', $this->jawaban_essay['jawaban']);
            $remove_breakline_kj = str_replace(PHP_EOL, ' ', $this->input->post('input_kunci_jawaban'));
            $final_score = $this->essay_scoring(jawaban: $remove_breakline_jawaban, kunci_jawaban: $remove_breakline_kj, max_score: $this->input->post('input_skor'), bobot: $this->input->post('input_bobot'));
            $final_score['kd_jawaban'] = $this->jawaban_essay['kd_jawaban'];
            // var_dump($final_score);
            $jawaban_saved = $this->essay_model->update_data(table: 'jawaban_mahasiswa', data: $this->jawaban_essay, param: ['kd_jawaban' => $kd_jawaban, 'npm' => $npm]);

            unset($final_score['skor_akhir']);
            $hasil_jawaban_saved = $this->essay_model->update_data(table: 'hasil_algoritma', data: $final_score, param: ['kd_jawaban' => $kd_jawaban]);
            if ($jawaban_saved && $hasil_jawaban_saved) {
                redirect(base_url('essay_scoring_view/' . $this->session->userdata('kd_soal') . '/' . $npm));
            }
        }
    }

    private function essay_scoring(string $jawaban, string $kunci_jawaban, int $max_score, int $bobot)
    {
        $preprocessed_answer = $this->text_preprocessing($jawaban);
        $preprocessed_key_answer = $this->text_preprocessing($kunci_jawaban);
        $sinonim_processed_answer = $this->sinonim_checker($preprocessed_answer, $preprocessed_key_answer);
        $tokenized_answer = $this->tokenization($sinonim_processed_answer, 4);
        $tokenized_key_answer = $this->tokenization($preprocessed_key_answer, 4);
        $hashing_answer = $this->rolling_hash($tokenized_answer, 3);
        $hashing_key_answer = $this->rolling_hash($tokenized_key_answer, 3);
        $winnowing_answer = $this->winnowing($hashing_answer, 3);
        $winnowing_key_answer = $this->winnowing($hashing_key_answer, 3);
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
            'pre_processing_jawaban' => json_encode($sinonim_processed_answer),
            'pre_processing_kj' => json_encode($preprocessed_key_answer),
            'tokenisasi_jawaban' => json_encode($tokenized_answer),
            'tokenisasi_kj' => json_encode($tokenized_key_answer),
            'hashing_jawaban' => json_encode($hashing_answer),
            'hashing_kj' => json_encode($hashing_key_answer),
            'winnowing_jawaban' => json_encode($winnowing_answer),
            'winnowing_kj' => json_encode($winnowing_key_answer),
            'similarity' => $similarity,
            'skor' => $score,
            'skor_akhir' => $final_score
        );
    }

    private function text_preprocessing(string $kalimat): string
    {
        $case_folding_kalimat = preg_replace('/[^\p{L}\s\s+]/u', "", strtolower(strip_tags($kalimat)));
        exec('python ' . APPPATH . 'controllers/python/essay.py ' . escapeshellarg($case_folding_kalimat), $output);
        return ($output[0]);
    }

    private function get_sinonim(string $keyword_jawaban, string $keyword_kunci_jawaban)
    {
        $dict_json = file_get_contents(APPPATH . 'controllers/dict.json');
        $dict_data = json_decode($dict_json);
        $array_kunci_jawaban = explode(" ", $keyword_kunci_jawaban);
        if (property_exists($dict_data, $keyword_jawaban)) {
            for ($i = 0; $i < count($dict_data->$keyword_jawaban->sinonim); $i++) {
                if (in_array($dict_data->$keyword_jawaban->sinonim[$i], $array_kunci_jawaban)) {
                    return $dict_data->$keyword_jawaban->sinonim[$i];
                }
            }
        } else {
            return null;
        }
    }
    private function sinonim_checker(string $jawaban, string $kunci_jawaban)
    {
        $array_jawaban = explode(" ", $jawaban);
        $results = [];
        for ($i = 0; $i < count($array_jawaban); $i++) {
            $sinonim_keyword = $this->get_sinonim($array_jawaban[$i], $kunci_jawaban);
            if (is_null($sinonim_keyword)) {
                array_push($results, $array_jawaban[$i]);
            } else {
                array_push($results, $sinonim_keyword);
            }
        }
        return implode(" ", $results);
    }

    private function tokenization(string $kalimat, int $n): array
    {
        $whitespace_removal = str_replace(" ", "", $kalimat);
        $n_grams = $n_gram = [];
        for ($i = 0; $i < strlen($whitespace_removal); $i++) {
            array_push($n_gram, $whitespace_removal[$i]);
            array_push($n_grams, implode($n_gram));
            if ($i >= ($n - 1)) {
                array_shift($n_gram);
            }
        }
        while (--$n) {
            array_shift($n_grams);
        }
        return $n_grams;
    }

    private function rolling_hash(array $pattern, int $windowSize, int $base = 26, int $mod = 1000000007): array
    {
        $n = sizeof($pattern);
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
