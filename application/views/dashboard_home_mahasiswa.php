<?php
if (is_null($this->session->userdata('npm'))) {
    redirect('/login');
}
?>
<div class="container">
    <div class="row align-items-center">
        <div class="col-lg-6">
            <form action="<?= base_url('dashboard_home_mahasiswa') ?>" method="post" id="form">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <label class="input-group-text" for="inputGroupSelect01">Tahun Akademik</label>
                            <select class="form-select" name="thn_akademik" id="thn_akademik" onchange="document.getElementById('form').submit();">
                                <option selected><?= $this->session->userdata('thn_akademik') ?? "Choose..." ?></option>
                                <?php
                                foreach ($thn_akademik as $key => $value) {
                                ?>
                                    <option value="<?= $value->thn_akademik; ?>"><?= $value->thn_akademik; ?></option>
                                <?php
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mt-3 mt-md-0">
                            <label class="input-group-text" for="inputGroupSelect01">Semester</label>
                            <select class="form-select" name="semester" id="semester" onchange="document.getElementById('form').submit();">
                                <option selected><?= $this->session->userdata('semester') ?? "Choose..." ?></option>
                                <?php
                                foreach ($data_semester as $key => $value) {
                                ?>
                                    <option value="<?= $value->semester; ?>"><?= $value->semester; ?></option>
                                <?php
                                }
                                ?>

                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-6">
            <div class="d-grid d-md-flex gap-2 align-items-md-center justify-content-md-end">
                <p class="py-2 border px-4 mt-3 rounded">NPM: <?= $this->session->userdata('npm'); ?></p>
                <a href="<?= base_url('logout'); ?>" class="btn btn-outline-secondary logout">Logout</a>
            </div>
        </div>
    </div>
</div>

<?php if (!is_null($mata_kuliah)) : ?>
    <div class="container">
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Mata kuliah</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($mata_kuliah) > 0) :
                    foreach ($mata_kuliah as $key => $value) :
                ?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td class="d-flex align-items-center gap-3">
                                <?= $value['kd_matkul'] ?>
                                <a href="<?= base_url('menjawab_soal_esai/' . $value['kd_matkul'] . '/' . $this->session->userdata('semester') . '/' . $this->session->userdata('kd_kelas')  . '/' . 3) ?>" class="btn btn-outline-secondary">Soal UTS</a>
                                <a href="<?= base_url('menjawab_soal_esai/' . $value['kd_matkul'] . '/' . $this->session->userdata('semester') . '/' . $this->session->userdata('kd_kelas')  . '/' . 4) ?>" class="btn btn-outline-secondary">Soal UAS</a>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                else :
                    ?>
                    <tr>
                        <td colspan="2" class="text-center">Mata Kuliah Tidak Ada</td>
                    </tr>
                <?php
                endif;
                ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

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