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
<h5 class="card-subtitle fw-bold mb-3">Nilai Mahasiswa</h5>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>NPM</th>
                <th>Nilai Rekapitulasi UAS</th>
            </tr>
        </thead>
        <tbody class="">
            <?php
            foreach ($data_mahasiswa as $key => $data) :
            ?>
                <tr>
                    <td><?= ++$key ?></td>
                    <td><?= $data['npm'] ?></td>
                    <td><?= $data['nilai_uas'] ?></td>
                </tr>
            <?php
            endforeach;
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
                        <td><b><?= $value_1['soal']; ?></b>
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