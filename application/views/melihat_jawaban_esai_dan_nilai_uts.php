<?php

if (is_null($this->session->userdata('nip'))) {
    redirect('/login');
}
<<<<<<< HEAD
// var_dump($mahasiswa);
// die();
$total_skor = 0;
?>
<a href="<?= base_url('/'); ?>" class="btn btn-primary mb-3"> <i class="bi bi-arrow-left"></i></a>
<h5 class="card-subtitle text-muted mb-3">Kode Matkul: <?= $kd_matkul; ?></h5>
<h5 class="card-subtitle fw-bold mb-3">Jawaban Mahasiswa</h5>

<table class="table no-margin">
    <tbody class="table-group-divider">
        <?php
        if (count($mahasiswa) !== 0) {
            foreach ($mahasiswa as $mhs => $value_1) {
        ?>
                <tr>
                    <td><b><?= $mhs + 1; ?></b></td>
                    <td><b><?= $value_1->npm; ?></b></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">
                        <?php
                        foreach ($jawaban_mahasiswa as $key => $value_2) :
                            if ($value_2['npm'] == $value_1->npm) {
                                $total_skor += $value_2['hasil_nilai'];
                        ?>
                                <div class="card">
                                    <div class="card-header">
                                        <?= $value_2['soal']; ?>
                                    </div>
                                    <div class="card-body">
                                        <?= $value_2['jawaban']; ?>
                                    </div>
                                    <div class="card-header">
                                        <p>Nilai Perolehan Per Soal: <b><?= $value_2['hasil_nilai']; ?></b></p>
                                    </div>
                                </div>
                                <br>
                            <?php
                            }
                            ?>
                        <?php endforeach; ?>
                        <b>Nilai: <?= $total_skor / count($total_soal); ?> </b>
                </tr>
                </td>
        <?php
            }
        }
        ?>
    </tbody>
</table>
=======

?>
<a href="<?= base_url('/'); ?>" class="btn btn-primary mb-3"> <i class="bi bi-arrow-left"></i></a>
<table class="table">
    <tr>
        <td>
            <p class="card-subtitle fw-bold mb-3 fs-6">Mata kuliah </p>
        </td>
        <td>
            <p class="card-subtitle fw-bold mb-3 fs-6"><?= $nama_matkul . " (" . $kd_matkul . ")"; ?></p>
        </td>
    </tr>
    <tr>
        <td>
            <p class="card-subtitle fw-bold mb-3 fs-6">Nama Dosen </p>
        </td>
        <td>
            <p class="card-subtitle fw-bold mb-3 fs-6"> <?= $this->session->userdata('nama_dosen'); ?></p>
        </td>
    </tr>
    <tr>
        <td>
            <p class="card-subtitle fw-bold mb-3 fs-6">Semester </p>
        </td>
        <td>
            <p class="card-subtitle fw-bold mb-3 fs-6"> <?= $semester; ?></p>
        </td>
    </tr>
    <tr>
        <td>
            <p class="card-subtitle fw-bold mb-3 fs-6">Kelas </p>
        </td>
        <td>
            <p class="card-subtitle fw-bold mb-3 fs-6"> <?= $kd_kelas; ?></p>
        </td>
    </tr>
    <tr>
        <td>
            <p class="card-subtitle fw-bold mb-3 fs-6">Program Studi </p>
        </td>
        <td>
            <p class="card-subtitle fw-bold mb-3 fs-6"> <?= $progstudi; ?></p>
        </td>
    </tr>
</table>

<h5 class="card-subtitle fw-bold mb-3">Nilai Mahasiswa</h5>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>NPM</th>
                <th>Nilai Rekapitulasi UTS</th>
            </tr>
        </thead>
        <tbody class="">
            <?php
            if (count($data_mahasiswa) > 0) :

                foreach ($data_mahasiswa as $key => $data) :
            ?>
                    <tr>
                        <td><?= ++$key ?></td>
                        <td><?= $data['npm'] ?></td>
                        <td><?= $data['nilai_uts'] ?></td>
                    </tr>
                <?php
                endforeach;
            else :
                ?>
                <tr>
                    <td colspan="3">Data Tidak Ada</td>
                </tr>
            <?php
            endif;
            ?>
        </tbody>
    </table>
</div>

<h5 class="card-subtitle fw-bold mb-3">Jawaban Mahasiswa</h5>

<div class="table-responsive">
    <table class="table no-margin">
        <tbody class="table-group-divider">
            <?php
            if (count($soal_matakuliah) !== 0) {
                foreach ($soal_matakuliah as $soal => $value_1) {
            ?>
                    <tr>
                        <td><b><?= $soal + 1; ?></b></td>
                        <td>
                            <b><?= $value_1['soal']; ?></b>
                            <?php if ($value_1['gambar'] !== '') : ?>
                                <img src=" <?= base_url() . 'assets/gambar/' . $value_1['gambar'] ?>" alt="">
                            <?php endif; ?>
                        </td>
                        <td>
                            <p>Bobot Soal: <b><?= $value_1['bobot_soal']; ?></b></p>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2">
                            <?php
                            foreach ($jawaban_mahasiswa as $key => $value_2) :
                                if ($value_2['soal'] == $value_1['soal']) {
                            ?>
                                    <div class="table-responsive">
                                        <table class="table w-100">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <p><?= $value_2['npm']; ?></p>
                                                    </th>
                                                    <th></th>
                                                    <th>
                                                        <div class="d-flex justify-content-end">
                                                            <p>Nilai :
                                                                <b><?= $value_2['hasil_nilai']; ?></b>
                                                            </p>
                                                        </div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-group-divider">
                                                <tr>
                                                    <td class="w-75">
                                                        <?= $value_2['jawaban']; ?>
                                                    </td>
                                                    <td class="w-0"></td>
                                                    <td class="w-25">
                                                        <div class="d-flex justify-content-end">
                                                            <a href="<?= base_url('hasil_algoritma/' . $value_2['kd_jawaban']); ?>" class="btn btn-outline-secondary">Perhitungan Nilai</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php
                                }
                                ?>
                            <?php endforeach;
                            ?>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>
>>>>>>> 518c5dffa9444c60e25e8ff5f447792e3b9daee0
