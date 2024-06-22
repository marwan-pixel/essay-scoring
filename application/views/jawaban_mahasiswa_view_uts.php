<?php
if (is_null($this->session->userdata('nip'))) {
    redirect('/login');
}
?>
<a href="<?= base_url('/'); ?>" class="btn btn-primary mb-3"> <i class="bi bi-arrow-left"></i></a>
<h5 class="card-subtitle text-muted mb-3">Kode Matkul: <?= $kd_matkul; ?></h5>
<h5 class="card-subtitle fw-bold mb-3">Jawaban Mahasiswa</h5>

<table class="table no-margin">
    <tbody class="table-group-divider">
        <?php
        if (count($mahasiswa) !== 0) {
            foreach ($mahasiswa as $mhs => $value_1) {
        ?>
                <tr>
                    <td><b><?= $mhs + 1; ?></b></td>
                    <td><b><?= $value_1->npm; ?></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <?php
                        foreach ($jawaban_mahasiswa as $key => $value_2) :
                            if ($value_2->npm == $value_1->npm) {
                        ?>
                                <div class="card">
                                    <div class="card-header">
                                        <?= $value_2->soal; ?>
                                    </div>
                                    <div class="card-body">
                                        <?= $value_2->jawaban; ?>
                                    </div>
                                    <div class="card-header">
                                        <p>Nilai Perolehan Per Soal: <b><?= $value_2->hasil_nilai; ?></b></p>
                                    </div>
                                </div>
                                <br>
                            <?php
                            }
                            ?>

                        <?php endforeach; ?>
                    </td>

                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>