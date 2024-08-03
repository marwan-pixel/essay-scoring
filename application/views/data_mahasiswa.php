<?php
if (is_null($this->session->userdata('nip'))) {
    redirect('/login');
}
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

<h5 class="card-subtitle fw-bold mb-3">Data Mahasiswa</h5>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>NPM</th>
                <th>Akses Ujian</th>
            </tr>
        </thead>
        <tbody class="">
            <?php
            if (count($data_mahasiswa) > 0) :

                foreach ($data_mahasiswa as $key => $data) :
            ?>
                    <tr>
                        <td><?= ++$key ?></td>
                        <td><?= $data['nama_mahasiswa'] . ' (' . $data['npm'] . ')' ?></td>
                        <td>
                            <a href="<?= base_url('memberi_akses_ujian/' . $data['npm'] . '/' .  $kd_kelas . '/' . $kd_progstudi . '/' . $semester . '/' . $kd_matkul . '/' . ($data['akses_ujian'] == 0 ? 3 : 0)); ?>" class="btn <?= $data['akses_ujian'] == 4 ? 'btn-secondary disabled' : 'btn-primary' ?>"><?= $data['akses_ujian'] == 3 ? 'Tutup Akses UTS' : 'Beri Akses UTS' ?></a>
                            <a href="<?= base_url('memberi_akses_ujian/' . $data['npm'] . '/' .  $kd_kelas . '/' . $kd_progstudi . '/' . $semester . '/' . $kd_matkul . '/' . ($data['akses_ujian'] == 0 ? 4 : 0)); ?>" class="btn <?= $data['akses_ujian'] == 3 ? 'btn-secondary disabled' : 'btn-primary' ?>"><?= $data['akses_ujian'] == 4 ? 'Tutup Akses UAS' : 'Beri Akses UAS' ?></a>
                        </td>
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