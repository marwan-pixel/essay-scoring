    <!-- <div class="d-grid gap-2 d-md-flex justify-content-md-start">
        <div class="modal fade" id="tambahDataMatkul" tabindex="-1" aria-labelledby="tambahDataMatkulLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="tambahDataMatkulLabel">Mata Kuliah</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?
                                        // echo base_url('input_matkul'); 
                                        ?>" method="post">
                            <div class="mb-3">
                                <label for="inputKDMatkul">Kode Matkul</label>
                                <input type="text" class="form-control" required name="input_kd_matkul" id="inputKDMatkul">
                            </div>
                            <div class="mb-3">
                                <label for="inputMatkul">Mata Kuliah</label>
                                <input type="text" class="form-control" required name="input_matkul" id="inputMatkul">
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-primary">Simpan Data</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <table class="table caption-top table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Mata Kuliah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php

            // if (count($mata_kuliah) !== 0) {
            //     foreach ($mata_kuliah as $key => $matkul) {

            ?>
                    <tr>
                        <td>
                            <p><?
                                // echo ++$start; 
                                ?></p>
                        </td>
                        <td>
                            <p><?
                                // echo $matkul->kd_matkul; 
                                ?></p>
                        </td>
                        <td>
                            <a href="
                            <?
                            // = base_url('essay/soal_view/' . $matkul->kd_matkul); 
                            ?>
                            " class="btn btn-success">Soal Esai</a>
                        </td>
                    </tr>
                <?php
                //     }
                // } else { 
                ?>
                <tr>
                    <td colspan="3">
                        <p class="text-center">Matkul Belum Tersedia</p>
                    </td>
                </tr>
            <?php
            // }
            ?>
        </tbody>
    </table>
    <?
    // echo $this->pagination->create_links(); 
    ?> -->

    <a href="<?= base_url('/') ?>" class="btn btn-primary mb-3"> <i class="bi bi-arrow-left"></i></a>
    <form class=" mt-3 w-100 d-flex" action="<?= base_url('/'); ?>" method="post" id="thn_akademik">
        <select class="form-select" name="thn_akademik" aria-label="Default select example" onchange="this.form.submit();">
            <option selected>Tahun Akademik</option>
            <?php
            foreach ($thn_akademik as $key => $value) {
            ?>
                <option value="<?= $value->thn_akademik; ?>"><?= $value->thn_akademik; ?></option>
            <?php
            }
            ?>
        </select>
        <input type="submit" name="submit" class="btn btn-primary">
    </form>

    <!-- <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#tambahSoalEsai"><i class="bi bi-plus-circle me-1"></i> Soal</button> -->

    <!-- Modal -->
    <div class="modal fade" id="tambahSoalEsai" data-bs-backdrop="static" tabindex="-1" aria-labelledby="tambahSoalEsaiLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahSoalEsaiLabel"> Soal Esai</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('input_soal') ?>" method="post">
                        <div class="mb-3">
                            <label for="input_soal" class="form-label">Soal</label>
                            <textarea name="input_soal" required class="form-control" id="input_soal" cols="20" rows="5" aria-describedby="soalHelp"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="inputSkor" class="form-label">Skor</label>
                            <input type="number" required name="input_skor" id="inputSkor" class="form-control" aria-describedby="skorHelp">
                        </div>
                        <div class="mb-3">
                            <label for="inputBobot" class="forn-label">Bobot</label>
                            <input type="number" required name="input_bobot" id="inputBobot" class="form-control" aria-describedby="bobotHelp">
                        </div>
                        <div class="mb-3">
                            <label for="input_kunci_jawaban" class="form-label">Kunci Jawaban</label>
                            <textarea required name="input_kunci_jawaban" id="input_kunci_jawaban" class="form-control" cols="20" rows="10" aria-describedby="soalHelp"></textarea>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ubahSoalEsai" data-bs-backdrop="static" tabindex="-1" aria-labelledby="ubahSoalEsaiLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ubahSoalEsaiLabel">Ubah Soal Esai</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <input hidden type="text" name="" id="kodeSoal">
                        <div class="mb-3">
                            <label for="inputSoal" class="form-label">Soal</label>
                            <textarea name="input_soal" class="form-control" id="inputSoal" cols="20" rows="5" aria-describedby="soalHelp"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="inputSkor" class="form-label">Skor</label>
                            <input type="number" name="input_skor" id="inputSkor" class="form-control" aria-describedby="skorHelp">
                        </div>
                        <div class="mb-3">
                            <label for="inputBobot" class="forn-label">Bobot</label>
                            <input type="number" name="input_bobot" id="inputBobot" class="form-control" aria-describedby="bobotHelp">
                        </div>
                        <div class="mb-3">
                            <label for="inputKunciJawaban" class="form-label">Kunci Jawaban</label>
                            <textarea name="input_kunci_jawaban" class="form-control" id="inputKunciJawaban" cols="20" rows="10" aria-describedby="soalHelp"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <table class="table mt-2">
        <thead>
            <tr>
                <th>No</th>
                <th>Semester</th>
                <th>Kelas</th>
                <th>Mata Kuliah</th>
                <th>UTS</th>
                <th>UAS</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            if (count($mata_kuliah) !== 0) {

                foreach ($mata_kuliah as $key => $value) { ?>
                    <tr>
                        <th><?= ++$key ?></th>
                        <th><?= $value->semester ?></th>
                        <th><?= $value->kd_kelas ?></th>
                        <th><?= $value->kd_matkul ?></th>
                        <th>
                            <a href="<?= base_url('soal_view/' . $value->kd_matkul); ?>" class="btn btn-outline-primary">Input Soal</a>
                            <a href="<?= base_url('jawaban_mahasiswa_view/' . $value->kd_matkul); ?>" class="btn btn-outline-primary">Jawaban Soal</a>
                        </th>
                        <th>
                            <a href="<?= base_url('soal_view'); ?>" class="btn btn-outline-primary">Input Soal</a>
                            <a href="<?= base_url('jawaban_mahasiswa_view'); ?> " class="btn btn-outline-primary">Jawaban Soal</a>
                        </th>
                    </tr>
                <?php

                }
            } else { ?>
                <tr>
                    <td colspan="6">
                        <p class="text-center">Soal Belum Tersedia</p>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(() => {
            $('#ubahSoalEsai').on('show.bs.modal', function(event) {
                let div = $(event.relatedTarget);
                let modal = $(this);

                modal.find(`#kodeSoal`).attr("value", div.data('kd-soal'));
                modal.find(`#inputSoal`).val(div.data('soal'));
                modal.find(`#inputSkor`).attr("value", div.data('skor'));
                modal.find(`#inputBobot`).attr("value", div.data('bobot'));
                modal.find(`#inputKunciJawaban`).val(div.data('kunci-jawaban'));
            });
        });
    </script>