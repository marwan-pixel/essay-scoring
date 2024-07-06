<?php
// var_dump($nilai);
// die();
?>
<div class="container">
    <a href="<?= base_url('/'); ?>" class="btn btn-primary mb-3"> <i class="bi bi-arrow-left"></i></a>
    <h5 class="card-subtitle fw-bold mb-3">Hasil Algoritma</h5>

    <div class="card">
        <div class="card-header">
            Jawaban Mahasiswa
        </div>
        <div class="card-body">
            <?= $data_hasil[0]['jawaban_mahasiswa'] ?? '' ?>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            Kunci Jawaban
        </div>
        <div class="card-body">
            <?= $data_hasil[0]['kunci_jawaban'] ?? '' ?>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            Winnowing Jawaban
        </div>
        <div class="card-body">
            <?= $data_hasil[0]['winnowing_jawaban'] ?? '' ?>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            Winnowing Kunci Jawaban
        </div>
        <div class="card-body">
            <?= $data_hasil[0]['winnowing_kunci_jawaban'] ?? '' ?>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            Dot Product
        </div>
        <div class="card-body">
            <?= $data_hasil[0]['dot_product'] ?? '' ?>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            Magnitude Esai
        </div>
        <div class="card-body">
            <?= $data_hasil[0]['magnitude_esai'] ?? '' ?>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            Magnitude Kunci Jawaban
        </div>
        <div class="card-body">
            <?= $data_hasil[0]['magnitude_kunci_jawaban'] ?? '' ?>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            Similarity:

            Dot Product / (Magnitude Soal * Magnitude Kunci Jawaban)
        </div>
        <div class="card-body">
            <?= $data_hasil[0]['similarity'] ?? '' ?>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            Nilai Hasil
        </div>
        <div class="card-body">
            <?= $nilai[0]['hasil_nilai'] ?? '' ?>
        </div>
    </div>
</div>