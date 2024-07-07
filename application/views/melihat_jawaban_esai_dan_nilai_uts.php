<?php

if (is_null($this->session->userdata('nip'))) {
    redirect('/login');
}
$total_skor = 0;
// var_dump($soal_matakuliah);
// die()
?>
<a href="<?= base_url('/'); ?>" class="btn btn-primary mb-3"> <i class="bi bi-arrow-left"></i></a>
<h5 class="card-subtitle text-muted mb-3">Kode Matkul: <?= $kd_matkul; ?></h5>
<h5 class="card-subtitle fw-bold mb-3">Jawaban Mahasiswa</h5>


<div class="modal fade" id="hasilAlgoritma" tabindex="-1" aria-labelledby="hasilAlgoritmaLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="hasilAlgoritmaLabel">Hasil Algoritma</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <p>Jawaban Mahasiswa</p>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table no-margin">
        <tbody class="table-group-divider">
            <?php
            if (count($soal_matakuliah) !== 0) {
                foreach ($soal_matakuliah as $soal => $value_1) {
            ?>
                    <tr>
                        <td><b><?= $soal + 1; ?></b></td>
                        <td><b><?= $value_1['soal']; ?></b></td>
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
                                    $total_skor += $value_2['hasil_nilai'];
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