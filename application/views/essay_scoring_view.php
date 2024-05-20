<a href="<?= base_url('jawaban_mahasiswa_view/' . $kd_soal); ?>" class="btn btn-primary mb-3"> <i class="bi bi-arrow-left"></i></a>
<h5 class="card-subtitle text-muted">Kode Soal: <?= $kd_soal; ?></h5>
<table class="table table-bordered mt-3">
    <tbody>
        <tr>
            <td>
                <p class="fw-bold">NPM</p>
            </td>
            <td>
                <p><?= $jawaban[0]->npm; ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="fw-bold">Kelas</p>
            </td>
            <td>
                <p><?= $jawaban[0]->kd_kelas; ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="fw-bold">Program Studi</p>
            </td>
            <td>
                <p><?= $jawaban[0]->kd_progstudi; ?></p>
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
    </tbody>
</table>

<form action="<?= count($jawaban) === 0 ? base_url('input_jawaban') : base_url('update_jawaban') . '/' . $kd_soal . '/' . $jawaban[0]->npm;  ?>" method="post">
    <label class="form-label" for="textarea_essay">Jawaban Esai</label>
    <!-- <textarea readonly name="input_jawaban" id="textarea_essay" class="form-control mb-3" cols="50" rows="10">
    </textarea> -->
    <input type="number" name="bobot" hidden value="8">
    <input type="number" name="skor" hidden value="6">
    <input type="text" name="jawaban_mahasiswa" hidden value="<?= $jawaban[0]->jawaban ?? ''; ?>">
    <input type="text" name="kunci_jawaban" hidden value="<?= $soal[0]->kunci_jawaban ?? ''; ?>" id="">
    <div class="card">
        <div class="card-body">
            <?= $jawaban[0]->jawaban ?? ''; ?>
        </div>
    </div>
    <?php
    if (count($jawaban) > 0) {
    ?>
        <div class="d-grid gap-2 mt-3 d-md-flex">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h5>Skor Perolehan</h5>
                        <h1><?= $jawaban[0]->hasil_nilai ?? 0; ?></h1>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h5>Tingkat Kemiripan (<i>Similarity</i>)</h5>
                        <h1><?= $this->session->userdata('similarity'); ?></h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button class="btn btn-primary my-2" type="submit" id="updateJawabanButton"> <i class="bi bi-save me-1"></i> Update Nilai</button>
            <button class="btn btn-success my-2" data-bs-toggle="modal" data-bs-target="#detailNilai" type="button"><i class="bi bi-search"></i> Detail Jawaban</button>
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
                                    <p><?= $jawaban[0]->jawaban ?? ''; ?></p>
                                </div>
                            </div>
                            <h5>Kunci Jawaban</h5>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p><?= $soal[0]->kunci_jawaban ?? ''; ?></p>
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
                                    <p><?= $this->session->userdata('pre_processing_kj'); ?></p>
                                </div>
                            </div>
                            <h5>Hasil Pre-Processing Jawaban</h5>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p><?= $this->session->userdata('pre_processing_jawaban'); ?></p>
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
                                    <p><?= $this->session->userdata('tokenisasi_kj'); ?></p>
                                </div>
                            </div>
                            <h5>Hasil Tokenisasi Jawaban</h5>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p><?= $this->session->userdata('tokenisasi_jawaban'); ?></p>
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
                                    <p><?= $this->session->userdata('hashing_kj'); ?></p>
                                </div>
                            </div>
                            <h5>Hasil Hashing Jawaban</h5>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p><?= $this->session->userdata('hashing_jawaban'); ?></p>
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
                                    <p><?= $this->session->userdata('winnowing_kj'); ?></p>
                                </div>
                            </div>
                            <h5>Hasil Winnowing Jawaban</h5>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p><?= $this->session->userdata('winnowing_jawaban'); ?></p>
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
                                    <p><?= $this->session->userdata('similarity'); ?></p>
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
                            <h5>Skor Perolehan: <?= $this->session->userdata('hasil_nilai'); ?></h5>
                            <h5>Skor Maksimal: <?= 6; ?></h5>
                            <h5>Bobot: </h5>

                            <h5>Nilai Perolehan = Skor Perolehan / Skor Maksimal * Bobot</h5>

                            <div class="card mb-3">
                                <div class="card-body">

                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>