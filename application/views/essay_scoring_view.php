<a href="<?= base_url('mahasiswa_view/' . $kd_soal); ?>" class="btn btn-primary mb-3"> <i class="bi bi-arrow-left"></i></a>
<h5 class="card-subtitle text-muted">Kode Soal: <?= $kd_soal; ?></h5>
<table class="table table-bordered mt-3">
    <tbody>
        <tr>
            <td>
                <p class="fw-bold">NPM</p>
            </td>
            <td>
                <p><?= $mahasiswa[0]->npm; ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="fw-bold">Nama Mahasiswa</p>
            </td>
            <td>
                <p><?= $mahasiswa[0]->nama_mahasiswa; ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="fw-bold">Kelas</p>
            </td>
            <td>
                <p><?= $mahasiswa[0]->kelas; ?></p>
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

<form action="<?= count($jawaban) === 0 ? base_url('input_jawaban') : base_url('update_jawaban') . '/' . $mahasiswa[0]->npm . '/' .  $jawaban[0]->kd_jawaban; ?>" method="post">
    <input hidden type="text" name="input_npm" value="<?= $mahasiswa[0]->npm; ?>">
    <input hidden type="text" name="input_mahasiswa" value="<?= $mahasiswa[0]->nama_mahasiswa; ?>">
    <input hidden type="text" name="input_mahasiswa" value="<?= $mahasiswa[0]->nama_mahasiswa; ?>">
    <input hidden type="text" name="kd_soal" value="<?= $kd_soal; ?>">
    <input hidden type="number" name="input_skor" value="<?= $soal[0]->skor; ?>">
    <input hidden type="number" name="input_bobot" value="<?= $soal[0]->bobot; ?>">
    <input hidden type="text" name="input_kd_jawaban" value="<?= $jawaban[0]->kd_jawaban ?? ''; ?>">
    <textarea hidden name="input_kunci_jawaban" cols="30" rows="10"><?= $soal[0]->kunci_jawaban; ?></textarea>
    <label class="form-label" for="textarea_essay">Jawaban Esai</label>
    <textarea name="input_jawaban" id="textarea_essay" class="form-control mb-3" cols="50" rows="10"><?= $jawaban[0]->jawaban ?? ''; ?>
    </textarea>
    <?php
    if (count($jawaban) > 0) {
    ?>
        <div class="d-grid gap-2 mt-3 d-md-flex">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h5>Skor Perolehan</h5>
                        <h1><?= ($hasil[0]->skor) / $soal[0]->skor * $soal[0]->bobot; ?></h1>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h5>Tingkat Kemiripan (<i>Similarity</i>)</h5>
                        <h1><?= number_format((float)$hasil[0]->similarity, 3, '.', ''); ?></h1>
                    </div>
                </div>
            </div>

        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button class="btn btn-primary my-2" type="submit" id="updateJawabanButton"> <i class="bi bi-save"></i> Ubah Jawaban</button>
            <button class="btn btn-success my-2" type="button" data-bs-toggle="modal" data-bs-target="#detailNilai"><i class="bi bi-search"></i> Detail Jawaban</button>
        <?php
    } else {
        ?>
            <div class="d-grid d-md-flex justify-content-md-end">
                <button class="btn btn-primary my-2" type="submit"><i class="bi bi-floppy me-1"></i> Simpan Jawaban</button>
            </div>
        <?php
    }
        ?>

        </div>
</form>

<div class="modal fade" id="detailNilai" tabindex="-1" aria-labelledby="detailNilaiLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="detailNilaiLabel">Detail Nilai</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <section class="jawaban-dan-kunci-jawaban">
                    <h4 class="mb-3">Jawaban dan kunci Jawaban Sebelum Pre-Processing</h4>
                    <div class="card">
                        <div class="card-body">
                            <h5>Jawaban Mahasiswa</h5>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p><?= $jawaban[0]->jawaban; ?></p>
                                </div>
                            </div>
                            <h5>Kunci Jawaban</h5>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p><?= $soal[0]->kunci_jawaban; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="pre-processing-text mt-3">
                    <h4 class="mb-3">Pre-Processing Jawaban dan Kunci Jawaban</h4>
                    <div class="card">
                        <div class="card-body">
                            <h5>Hasil Pre-Processing Kunci Jawaban</h5>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p><?= $hasil[0]->pre_processing_kj; ?></p>
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
                            <h5 class="mb-3">Nilai K-Gram: 2</h5>
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
                            <h5 class="mb-3">Nilai Winnow: 3</h5>
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