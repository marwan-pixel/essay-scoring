<?php
// die();
// var_dump($data_hasil);
if (count($data_hasil) > 0) {
    $winnowing_jawaban = json_decode($data_hasil[0]['winnowing_jawaban']);
    $winnowing_kj = json_decode($data_hasil[0]['winnowing_kunci_jawaban']);
    $arrayMerge = array_unique(array_merge($winnowing_jawaban, $winnowing_kj));

    function frequency_representation($hashes, $all_hashes)
    {
        // Inisialisasi hash_count dengan semua nilai dari all_hashes dan frekuensi awal 0
        $hash_count = array_fill_keys($all_hashes, 0);

        // Menghitung frekuensi kemunculan setiap hash dalam hashes
        foreach ($hashes as $hash) {
            if (array_key_exists($hash, $hash_count)) {
                $hash_count[$hash]++;
            }
        }

        return $hash_count;
    }

    $frequency_winnowing_jawaban = frequency_representation($winnowing_jawaban, $arrayMerge);
    $frequency_winnowing_kj = frequency_representation($winnowing_kj, $arrayMerge);
}
// die();
?>
<div class="container">
    <a href="<?= base_url('/'); ?>" class="btn btn-primary mb-3"> <i class="bi bi-arrow-left"></i></a>
    <h5 class="card-subtitle fw-bold mb-3">Perhitungan Nilai</h5>

    <div class="card">
        <div class="card-header">
            Jawaban Mahasiswa
        </div>
        <div class="card-body">
            <?= $data_jawaban[0]['jawaban'] ?? 'Tidak ada' ?>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            Kunci Jawaban
        </div>
        <div class="card-body">
            <?= $data_kj[0]['kunci_jawaban'] ?? 'Tidak ada' ?>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            Preprocessing Jawaban Mahasiswa
        </div>
        <div class="card-body">
            <?= $data_hasil[0]['jawaban_preprocessing'] ?? 'Tidak ada' ?>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            Preprocessing Kunci Jawaban
        </div>
        <div class="card-body">
            <?= $data_hasil[0]['kunci_jawaban_preprocessing'] ?? 'Tidak ada' ?>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNGramJawaban" aria-expanded="false" aria-controls="collapseExample">
                N-gram Jawaban Mahasiswa
            </button>
        </div>
        <div class="collapse" id="collapseNGramJawaban">
            <div class="card-body">
                <?php
                echo '<pre>';
                print_r(json_decode($data_hasil[0]['n_gram_jawaban']) ?? 'Tidak ada');
                echo '</pre>';
                ?>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNGramKJ" aria-expanded="false" aria-controls="collapseExample">
                N-gram Kunci Jawaban
            </button>
        </div>
        <div class="collapse" id="collapseNGramKJ">
            <div class="card-body">
                <?php
                echo '<pre>';
                print_r(json_decode($data_hasil[0]['n_gram_kunci_jawaban']) ?? 'Tidak ada');
                echo '</pre>';
                ?>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRollingHashJawaban" aria-expanded="false" aria-controls="collapseExample">
                Rolling Hash Jawaban Mahasiswa
            </button>
        </div>
        <div class="collapse" id="collapseRollingHashJawaban">
            <div class="card-body">
                <?php
                echo '<pre>';
                print_r(json_decode($data_hasil[0]['rolling_hash_jawaban']) ?? 'Tidak ada');
                echo '</pre>';
                ?>
                <!-- <?= $data_hasil[0]['rolling_hash_jawaban'] ?? 'Tidak ada' ?> -->
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRollingHashKJ" aria-expanded="false" aria-controls="collapseExample">
                Rolling Hash Kunci Jawaban
            </button>
        </div>
        <div class="collapse" id="collapseRollingHashKJ">
            <div class="card-body">
                <?php
                echo '<pre>';
                print_r(json_decode($data_hasil[0]['rolling_hash_kunci_jawaban']) ?? 'Tidak ada');
                echo '</pre>';
                ?>
                <!-- <?= $data_hasil[0]['rolling_hash_kunci_jawaban'] ?? 'Tidak ada' ?> -->
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFingerprintJawaban" aria-expanded="false" aria-controls="collapseExample">
                Fingerprint Jawaban Mahasiswa
            </button>
        </div>
        <div class="collapse" id="collapseFingerprintJawaban">
            <div class="card-body">
                <?php
                echo '<pre>';
                print_r(json_decode($data_hasil[0]['winnowing_jawaban']) ?? 'Tidak ada');
                echo '</pre>';
                ?>
                <!-- <?= $data_hasil[0]['winnowing_jawaban'] ?? 'Tidak ada' ?> -->
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFingerprintKJ" aria-expanded="false" aria-controls="collapseExample">
                Fingerprint Kunci Jawaban
            </button>
        </div>
        <div class="collapse" id="collapseFingerprintKJ">
            <div class="card-body">
                <?php
                echo '<pre>';
                print_r(json_decode($data_hasil[0]['winnowing_kunci_jawaban']) ?? 'Tidak ada');
                echo '</pre>';
                ?>
                <!-- <?= $data_hasil[0]['winnowing_kunci_jawaban'] ?? 'Tidak ada' ?> -->
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFrekuensiJawaban" aria-expanded="false" aria-controls="collapseExample">
                Frekuensi Fingerprint Jawaban Mahasiswa
            </button>
        </div>
        <div class="collapse" id="collapseFrekuensiJawaban">
            <div class="card-body">
                <?php
                if (count($data_hasil) > 0) :
                    // end($frequency_winnowing_jawaban);
                    // $last_key = key($frequency_winnowing_jawaban);
                    // foreach ($frequency_winnowing_jawaban as $key => $value) :
                    //     echo '<b>' . $key . '</b>' . ' => ' . '<b>' . $value . '</b>' . ($key !== $last_key ? ', ' : '');
                    // endforeach;
                    echo '<pre>';
                    print_r($frequency_winnowing_jawaban);
                    echo '</pre>';
                endif;
                ?>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFrekuensiKJ" aria-expanded="false" aria-controls="collapseExample">
                Frekuensi Fingerprint Kunci Jawaban
            </button>
        </div>
        <div class="collapse" id="collapseFrekuensiKJ">
            <div class="card-body">
                <?php
                if (count($data_hasil) > 0) :
                    // end($frequency_winnowing_kj);
                    // $last_key = key($frequency_winnowing_kj);
                    // foreach ($frequency_winnowing_kj as $key => $value) :
                    //     echo '<b>[' . $key . ']</b>' . ' => ' . '<b>' . $value . '</b>' . ($key !== $last_key ? '; ' : '');
                    // endforeach;
                    // unset($last_key);
                    echo '<pre>';
                    print_r($frequency_winnowing_kj);
                    echo '</pre>';
                endif;
                ?>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            Dot Product
        </div>
        <div class="card-body">
            <?= $data_hasil[0]['dot_product'] ?? 'Tidak ada' ?>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            Magnitude Jawaban Esai
        </div>
        <div class="card-body">
            <?= $data_hasil[0]['magnitude_jawaban'] ?? 'Tidak ada' ?>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            Magnitude Kunci Jawaban
        </div>
        <div class="card-body">
            <?= $data_hasil[0]['magnitude_kj'] ?? 'Tidak ada' ?>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            Persentase Similarity:

            (Dot Product / (Magnitude Jawaban Esai * Magnitude Kunci Jawaban)) * 100%
        </div>
        <div class="card-body">
            <?php
            if (count($data_hasil) > 0) :
                echo $data_hasil[0]['similarity'] * 100 . '%';
            else :
                echo '0';
            endif; ?>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            Nilai Hasil
        </div>
        <div class="card-body">
            <?= $nilai[0]['hasil_nilai'] ?? 'Tidak ada' ?>
        </div>
    </div>
</div>