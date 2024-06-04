<?php
if (is_null($this->session->userdata('npm'))) {
    redirect('/login');
}
?>
<div class="container">
    <a href="<?= base_url('/') ?>" class="btn btn-primary mb-3"> <i class="bi bi-arrow-left"></i></a>
    <h4>Mata Kuliah: <?= $kd_matkul ?></h4>
</div>
<?php
if (!is_null($soal_matakuliah)) :
?>
    <div class="container">
        <table class="table">
            <tbody class="table-group-divider">
                <?php
                if (count($soal_matakuliah) > 0) :
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
                                        <?= $value->soal ?>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?= base_url('input_jawaban') ?>" method="post">
                                            <label for="jawaban" class="form-label">Silakan Masukkan Jawaban di bawah</label>
                                            <textarea name="jawaban" id="<?= 'jawaban' . $key ?>" cols="80"><?= $jawaban_mahasiswa[$key - 1]->jawaban ?? '' ?></textarea>
                                            <button type="submit" class="btn btn-primary mt-2" onclick="">Simpan Jawaban</button>
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