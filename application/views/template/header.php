<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Esai</title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<<<<<<< HEAD
    <script src="//cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

=======
    <script src="<?= base_url(); ?>assets/ckeditor/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.2.0/intro.js" integrity="sha512-f26fxKZJiF0AjutUaQHNJ5KnXSisqyUQ3oyfaoen2apB1wLa5ccW3lmtaRe2jdP5kh4LF2gAHP9xQbx7wYhU5w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.2.0/introjs.css" integrity="sha512-4OzqLjfh1aJa7M33b5+h0CSx0Q3i9Qaxlrr1T/Z+Vz+9zs5A7GM3T3MFKXoreghi3iDOSbkPMXiMBhFO7UBW/g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
>>>>>>> 518c5dffa9444c60e25e8ff5f447792e3b9daee0
</head>

<body>
    <div class="d-flex" style="height: 100vh;">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 20%; overflow-y: auto;">
            <div class="d-flex px-3 align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span>Selamat Datang</span>
            </div>
            <a href="#" class="d-flex px-3 align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-6">
                    <span class="text-center"><?= $this->session->userdata('nama_dosen'); ?></span>
                </span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="<?= base_url('/') ?>" class="nav-link active" aria-current="page">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#home"></use>
                        </svg>
                        Soal Esai
                    </a>
                </li>
                <!-- <li>
                    <a href="#" class="nav-link text-white">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#speedometer2"></use>
                        </svg>
                        Akses Ujian
                    </a>
                </li> -->
                <hr>
                <a href="<?= base_url('logout'); ?>" class="nav-link text-white">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="#people-circle"></use>
                    </svg>
                    Logout
                </a>
            </ul>
        </div>

        <div class="container-fluid" style="flex: 1; width: 80%; overflow-y: auto;">
            <div class="card mt-4">
                <div class="card-body" data-intro="Ini adalah lokasi di mana dosen menginput soal dan melihat jawaban mahasiswa">
                    <h3 class="card-title mb-3 text-center">Aplikasi Penilaian Esai</h3>