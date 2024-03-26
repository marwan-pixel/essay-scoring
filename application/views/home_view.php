    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
        <button class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#tambahDataMatkul"><i class="bi bi-plus-circle me-1"></i> Mata Kuliah</button>
        <div class="modal fade" id="tambahDataMatkul" tabindex="-1" aria-labelledby="tambahDataMatkulLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="tambahDataMatkulLabel">Mata Kuliah</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('input_matkul');?>" method="post">
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
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div> -->
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
            if (count($mata_kuliah) !== 0) {
                foreach ($mata_kuliah as $key => $matkul) {

            ?>
                    <tr>
                        <td>
                            <p><?= $key + 1; ?></p>
                        </td>
                        <td>
                            <p><?= $matkul->nama_matkul; ?></p>
                        </td>
                        <td>
                            <a href="<?= base_url('essay/soal_view/' . $matkul->kd_matkul); ?>" class="btn btn-success">Soal Esai</a>
                        </td>
                    </tr>
            <?php
                }
            } else { ?>
                <tr><td colspan="3"><p class="text-center">Matkul Belum Tersedia</p></td></tr>
                <?php } 
            ?>
        </tbody>
    </table>