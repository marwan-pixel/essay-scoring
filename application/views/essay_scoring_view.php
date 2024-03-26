<a href="<?= base_url('essay/soal_view/' . $this->session->userdata('kd_matkul')); ?>" class="btn btn-primary mb-3"> <i class="bi bi-arrow-left"></i></a>
<h5 class="card-subtitle text-muted">Kode Soal: <?= $kd_soal; ?></h5>
<table class="table table-bordered mt-3">
    <tbody>
        <tr>
            <td>
                <p class="fw-bold">Pertanyaan</p>
            </td>
            <td>
                <p><?= $soal[0]->soal; ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="fw-bold">Skor</p>
            </td>
            <td>
                <p><?= $soal[0]->skor; ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="fw-bold">Bobot</p>
            </td>
            <td>
                <p><?= $soal[0]->bobot; ?></p>
            </td>
        </tr>
    </tbody>
</table>
<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <button class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#tambahDataJawaban"><i class="bi bi-plus-circle me-1"></i> Jawaban</button>
    <div class="modal fade" id="tambahDataJawaban" tabindex="-1" aria-labelledby="tambahDataJawabanLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahDataJawabanLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('input_jawaban');?>" method="post">
                        <div class="mb-3">
                            <label for="inputNPM">NPM</label>
                            <input type="number" class="form-control" name="input_npm" id="inputNPM">
                        </div>
                        <div class="mb-3">
                            <label for="inputNPM">Nama Mahasiswa</label>
                            <input type="text" class="form-control" name="input_mahasiswa" id="inputNPM">
                        </div>
                        <div class="mb-3">
                            <label for="inputJawaban">Jawaban Mahasiswa</label>
                            <textarea name="input_jawaban" id="inputJawaban" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">Simpan Jawaban</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>NPM</th>
            <th>Nama Mahasiswa</th>
            <th>Kunci Jawaban</th>
            <th>Jawaban</th>
            <th>Nilai</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <?php
        if (count($jawaban) !== 0) {
            foreach ($jawaban as $key => $value) {
        ?>
                <tr>
                    <td><?= $key + 1; ?></td>
                    <td><?= $value->npm; ?></td>
                    <td class="col-1"><?= $value->nama_mahasiswa; ?></td>
                    <td class="col-3"><?= $soal[0]->kunci_jawaban; ?></td>
                    <td class="col-4"><?= $value->jawaban; ?></td>
                    <td><?= $value->nilai; ?></td>
                    <td>
                        <div class="d-grid gap-2 d-md-block">
                            <button class="btn btn-success" data-bs-target="#detailNilai" data-bs-toggle="modal">Detail Nilai</button>
                            <button class="btn btn-warning" data-bs-target="#ubahJawaban" data-bs-toggle="modal">Ubah Jawaban</button>
                        </div>
                    </td>
                </tr>
            <?php
            }
        } else { ?>
            <tr>
                <td colspan="7">
                    <p class="text-center">Jawaban Belum Tersedia</p>
                </td>
            </tr>
        <?php }
        ?>
    </tbody>
</table>
<div class="modal fade" id="detailNilai" tabindex="-1" aria-labelledby="detailNilaiLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="detailNilaiLabel">Detail Nilai</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
        </div>
    </div>
</div>