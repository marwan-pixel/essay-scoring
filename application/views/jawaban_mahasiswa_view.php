<a href="<?= base_url('essay/soal_view/' . $this->session->userdata('kd_matkul')); ?>" class="btn btn-primary mb-3"> <i class="bi bi-arrow-left"></i></a>
<h5 class="card-subtitle text-muted mb-3">Kode Soal: <?= $kd_soal; ?></h5>
<h5 class="card-subtitle fw-bold mb-3">Jawaban Mahasiswa</h5>
<div class="tambahDataMahasiswa">
    <div class="modal fade" id="tambahMahasiswa" tabindex="-1" aria-labelledby="tambahMahasiswaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahMahasiswaLabel">Tambah Data Mahasiswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('input_mhs'); ?>" method="post">
                        <div class="mb-3">
                            <label for="inputNPM" class="form-label">NPM</label>
                            <input type="text" required name="input_npm" id="inputNPM" class="form-control" aria-describedby="npmHelp">
                        </div>
                        <div class="mb-3">
                            <label for="inputNama" class="form-label">Nama Mahasiswa</label>
                            <input type="text" required name="input_nama" id="inputNama" class="form-control" aria-describedby="namaHelp">
                        </div>
                        <div class="mb-3">
                            <label for="inputKelas" class="form-label">Kelas</label>
                            <input type="text" required name="input_kelas" id="inputKelas" class="form-control" aria-describedby="kelasHelp">
                        </div>
                        <div class="mb-3">
                            <label for="inputProdi" class="form-label">Program Studi</label>
                            <input type="text" required name="input_prodi" id="inputProdi" class="form-control" aria-describedby="prodiHelp">
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahMahasiswa"><i class="bi bi-plus-circle me-1"></i> Mahasiswa</button> -->
</div>
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>NPM</th>
            <th>Jawaban</th>
            <th>Kelas</th>
            <th>Program Studi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <?php
        if (count($mahasiswa) !== 0) {
            foreach ($mahasiswa as $mhs => $value) {

        ?>
                <tr>
                    <td><?= $mhs + 1; ?></td>
                    <td><?= $value->npm; ?></td>
                    <td><?= $value->jawaban; ?></td>
                    <td><?= $value->kd_kelas; ?></td>
                    <td><?= $value->kd_progstudi; ?></td>
                    <td><a href="<?= base_url('essay_scoring_view/' . $kd_soal . '/' . $value->npm); ?>" class="btn btn-primary">Jawaban</a></td>
                </tr>
        <?php
            }
        }
        ?>

    </tbody>
</table>