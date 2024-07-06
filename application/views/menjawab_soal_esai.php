<?php
if (is_null($this->session->userdata('npm'))) {
    redirect('/login');
}
echo $this->session->flashdata('message');
?>
<div class="container">
    <a href="<?= base_url('dashboard_home_mahasiswa') ?>" class="btn btn-primary mb-3 back-button"> <i class="bi bi-arrow-left"></i></a>
    <h4>Mata Kuliah: <?= $kd_matkul ?></h4>
</div>
<?php

if (!is_null($soal_matakuliah)) :
?>
    <div class="container">
        <table class="table">
            <tbody class="table-group-divider">
                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                <?php
                echo $this->session->flashdata('success');
                if (count($soal_matakuliah) > 0) :
                    $kd_soal_jawaban_mahasiswa = array_column($jawaban_mahasiswa, 'kd_soal');
                    foreach ($soal_matakuliah as $key => $value) :
                ?>
                        <tr>
                            <td>
                                <?= ++$key ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="card">
                                    <div class="card-header">
                                        <?= $value['soal'] ?>
                                    </div>
                                    <div class="card-body">
                                        <form class="simpan-data-jawaban" action="<?= base_url('simpan_jawaban_esai') ?>" method="post">
                                            <input type="hidden" name="thn_akademik" value="<?= $this->session->userdata('thn_akademik'); ?>">
                                            <input type="hidden" name="semester" value="<?= $semester; ?>">
                                            <input type="hidden" name="kd_kelas" value="<?= $kd_kelas; ?>">
                                            <input type="hidden" name="kd_progstudi" value="<?= $this->session->userdata('kd_progstudi'); ?>">
                                            <input type="hidden" name="kd_matkul" value="<?= $kd_matkul; ?>">
                                            <input type="hidden" name="kd_soal" value="<?= $value['kd_soal']; ?>">
                                            <input type="hidden" name="npm" value="<?= $this->session->userdata('npm'); ?>">
                                            <input type="hidden" name="bobot_soal" value="<?= $value['bobot_soal']; ?>">
                                            <input type="hidden" name="ctype" value="<?= $value['ctype']; ?>">
                                            <input type="hidden" name="kunci_jawaban" value="<?= $value['kunci_jawaban']; ?>">
                                            <label for="jawaban" class="form-label">Silakan Masukkan Jawaban di bawah</label>
                                            <textarea name="jawaban" id="<?= 'jawaban' . $key ?>" cols="80" rows="80">
                                                <?php
                                                if (in_array($value['kd_soal'], $kd_soal_jawaban_mahasiswa)) {
                                                    $value2 = array_filter($jawaban_mahasiswa, function ($item) use ($value) {
                                                        return $item['kd_soal'] == $value['kd_soal'];
                                                    });
                                                    $value2 = reset($value2);
                                                    echo $value2['jawaban'];
                                                } else {
                                                    echo "";
                                                }
                                                ?>
                                            </textarea>
                                            <button type="submit" class="btn btn-primary mt-2">Simpan Jawaban </button>
                                        </form>
                                        <script>
                                            CKEDITOR.replace("<?= 'jawaban' . $key ?>");
                                        </script>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                else :
                    ?>
                    <div>Tidak Ada Soal</div>
                <?php
                endif;
                ?>
            </tbody>
        </table>

    </div>
<?php
endif;
?>