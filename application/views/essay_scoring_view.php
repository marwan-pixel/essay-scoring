<a href="<?= base_url('mahasiswa_view/' . $kd_soal); ?>" class="btn btn-primary mb-3"> <i class="bi bi-arrow-left"></i></a>
<h5 class="card-subtitle text-muted">Kode Soal: <?= $kd_soal; ?></h5>
<table class="table table-bordered mt-3">
    <tbody>
        <tr>
            <td>
                <p class="fw-bold">NPM</p>
            </td>
            <td>
                <p></p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="fw-bold">Nama Mahasiswa</p>
            </td>
            <td>
                <p></p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="fw-bold">Kelas</p>
            </td>
            <td>
                <p></p>
            </td>
        </tr>
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

<form>
    <label class="form-label" for="jawaban">Jawaban Esai</label>
    <textarea name="" id="jawaban" class="form-control" cols="150" rows="10"></textarea>
    <button class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#tambahDataJawaban"><i class="bi bi-plus-circle me-1"></i> Simpan Jawaban</button>
    <!-- <div class="modal fade" id="tambahDataJawaban" tabindex="-1" aria-labelledby="tambahDataJawabanLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahDataJawabanLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('input_jawaban'); ?>" method="post">
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
                        <input hidden type="text" name="input_kunci_jawaban" value="<?= $soal[0]->kunci_jawaban; ?>">
                        <input hidden type="number" name="input_skor" value="<?= $soal[0]->skor; ?>">
                        <input hidden type="number" name="input_bobot" value="<?= $soal[0]->bobot; ?>">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">Simpan Jawaban</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
</form>

<!-- <table class="table">
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
                    <td><?= ($hasil[0]->skor) / $soal[0]->skor * $soal[0]->bobot; ?></td>
                    <td>
                        <div class="d-grid gap-2 col-6 mx-auto">
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
</table> -->


<div class="modal fade" id="detailNilai" tabindex="-1" aria-labelledby="detailNilaiLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="detailNilaiLabel">Detail Nilai</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <section class="pre-processing-text">
                    <h4 class="mb-3">Pre-Processing Jawaban dan Kunci Jawaban</h4>
                    <div class="card">
                        <div class="card-body">
                            <h5>Hasil Pre-Processing Kunci Jawaban</h5>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p><?= ($hasil[0]->pre_processing_kj); ?></p>
                                </div>
                            </div>
                            <h5>Hasil Pre-Processing Jawaban</h5>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p><?= ($hasil[0]->pre_processing_jawaban); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="tokenisasi-text mt-3">
                    <h4 class="mb-3">Tokenisasi Jawaban dan Kunci Jawaban</h4>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3">Nilai K-Gram: 3</h5>
                            <h5>Hasil Tokenisasi Kunci Jawaban</h5>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p><?= ($hasil[0]->tokenisasi_kj); ?></p>
                                </div>
                            </div>
                            <h5>Hasil Tokenisasi Jawaban</h5>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p><?= ($hasil[0]->tokenisasi_jawaban); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="hashing-text mt-3">
                    <h4 class="mb-3">Hashing Jawaban dan Kunci Jawaban</h4>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3">Nilai Hashing: 4</h5>
                            <h5>Hasil Hashing Kunci Jawaban</h5>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p><?= ($hasil[0]->hashing_kj); ?></p>
                                </div>
                            </div>
                            <h5>Hasil Hashing Jawaban</h5>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p><?= ($hasil[0]->hashing_jawaban); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="winnowing-text mt-3">
                    <h4 class="mb-3">Winnowing Jawaban dan Kunci Jawaban</h4>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3">Nilai Winnow: 6</h5>
                            <h5>Hasil Winnowing Kunci Jawaban</h5>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p><?= ($hasil[0]->winnowing_kj); ?></p>
                                </div>
                            </div>
                            <h5>Hasil Winnowing Jawaban</h5>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p><?= ($hasil[0]->winnowing_jawaban); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="cosineSimilarity-text mt-3">
                    <h4 class="mb-3">Cosine Similarity Jawaban dan Kunci Jawaban</h4>
                    <div class="card">
                        <div class="card-body">
                            <h5>Hasil Cosine Similarity</h5>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p><?= ($hasil[0]->similarity); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="cosineSimilarity-text mt-3">
                    <h4 class="mb-3">Nilai Perolehan</h4>
                    <div class="card">
                        <div class="card-body">
                            <h5>Hasil Nilai Perolehan</h5>
                            <h5>Skor Perolehan: <?= ($hasil[0]->skor); ?></h5>
                            <h5>Skor Maksimal: <?= ($soal[0]->skor); ?></h5>
                            <h5>Bobot: <?= $soal[0]->bobot; ?></h5>

                            <h5>Nilai Perolehan = Skor Perolehan / Skor Maksimal * Bobot</h5>

                            <div class="card mb-3">
                                <div class="card-body">

                                    <p><?= ($hasil[0]->skor) / $soal[0]->skor * $soal[0]->bobot; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>