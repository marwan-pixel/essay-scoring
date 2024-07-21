<?php
// var_dump($nilai);
// die();

use function PHPUnit\Framework\isNull;

?>
<div class="container">
    <a href="<?= base_url('/'); ?>" class="btn btn-primary mb-3"> <i class="bi bi-arrow-left"></i></a>
    <h5 class="card-subtitle fw-bold mb-3">Hasil Algoritma</h5>

    <div class="card">
        <div class="card-header">
            Jawaban Mahasiswa
        </div>
        <div class="card-body">
            <?= $data_hasil[0]['jawaban_mahasiswa'] ?? 'Tidak ada' ?>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            Kunci Jawaban
        </div>
        <div class="card-body">
            <?= $data_hasil[0]['kunci_jawaban'] ?? 'Tidak ada' ?>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            Winnowing Jawaban
        </div>
        <div class="card-body">
            <?= $data_hasil[0]['winnowing_jawaban'] ?? 'Tidak ada' ?>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            Winnowing Kunci Jawaban
        </div>
        <div class="card-body">
            <?= $data_hasil[0]['winnowing_kunci_jawaban'] ?? 'Tidak ada' ?>
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
            <?= $data_hasil[0]['magnitude_esai'] ?? 'Tidak ada' ?>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            Magnitude Kunci Jawaban
        </div>
        <div class="card-body">
            <?= $data_hasil[0]['magnitude_kunci_jawaban'] ?? 'Tidak ada' ?>
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