<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Esai</title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="<?= base_url(); ?>assets/ckeditor/ckeditor.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="d-flex" style="height: 100vh;">
        <?php
        if (preg_match('/menjawab_soal_esai/', current_url())) :
        ?>
            <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 20%; overflow-y: auto;">
                <a href="<?= current_url(); ?>" class="d-flex px-3 align-items-center mb-3 mb-md-0 me-md-auto text-white active text-decoration-none">
                    <span class="fs-6">
                        <span class="text-center">Mahasiswa: <?= $this->session->userdata('nama_mahasiswa') ?? $this->session->userdata('npm'); ?></span>
                    </span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <?php
                    foreach ($get_kd_soal as $key => $value) :
                    ?>
                        <li class="nav-item py-2">
                            <a href="<?= current_url() . '?kd_soal=' . $value['kd_soal'] ?>" class="nav-link text-white <?= isset($_GET['kd_soal']) && ($_GET['kd_soal'] == $value['kd_soal']) ? 'active' : '' ?>">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#people-circle"></use>
                                </svg>
                                Soal Nomor <?= ++$key; ?>
                                <?php
                                if (isset($total_jawaban_saved[$key - 1])) :
                                ?>
                                    <span><i class="bi bi-check-circle-fill ms-2"></i></span>
                                <?php

                                endif;
                                ?>
                            </a>
                        </li>
                    <?php
                    endforeach;
                    ?>
                    <hr>
                    <a href="<?= base_url('mengakhiri_ujian/' . $this->session->userdata('npm') . '/' . $semester . '/' . $kd_matkul); ?>" class="nav-link text-white akhiri-ujian-button">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#people-circle"></use>
                        </svg>
                        Akhiri Ujian
                    </a>
                </ul>
            </div>
        <?php
        endif;
        ?>
        <div class="container-fluid" style="flex: 1; width: 80%; overflow-y: auto;">
            <div class="card mt-3 mb-3" style="height: 100%;">
                <div class="card-body">
                    <h3 class="card-title mb-5 text-center">Aplikasi Penilaian Esai</h3>