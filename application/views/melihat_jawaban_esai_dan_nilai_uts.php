<?php

if (is_null($this->session->userdata('nip'))) {
    redirect('/login');
}
$total_skor = 0;
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
            if (count($mahasiswa) !== 0) {
                foreach ($mahasiswa as $mhs => $value_1) {
            ?>
                    <tr>
                        <td><b><?= $mhs + 1; ?></b></td>
                        <td><b><?= $value_1->npm; ?></b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2">
                            <?php
                            foreach ($jawaban_mahasiswa as $key => $value_2) :
                                if ($value_2['npm'] == $value_1->npm) {
                                    $total_skor += $value_2['hasil_nilai'];
                            ?>
                                    <div class="card">
                                        <div class="card-header">
                                            <?= $value_2['soal']; ?>
                                        </div>
                                        <div class="card-body">
                                            <?= $value_2['jawaban']; ?>
                                        </div>
                                        <div class="card-header col-5">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p>Nilai Perolehan Per Soal: <b><?= $value_2['hasil_nilai']; ?></b></p>
                                                </div>
                                                <div class="col-6">
                                                    <a href="<?= base_url('hasil_algoritma/' . $value_2['kd_jawaban']); ?>" class="btn btn-outline-secondary">Hasil Algoritma</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                <?php
                                }
                                ?>
                            <?php endforeach;
                            if (count($total_soal) > 0) : ?>
                                <div class="card">
                                    <div class="card-body">
                                        <h5>Nilai Total: <b><?= $total_skor; ?> </b></h5>
                                    </div>
                                </div>
                            <?php
                                $total_skor = 0;
                            endif; ?>
                    </tr>
                    </td>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>