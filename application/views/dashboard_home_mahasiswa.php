<?php
if (is_null($this->session->userdata('npm'))) {
    redirect('/login');
}
// var_dump($mata_kuliah);
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
                </div>
            </form>
        </div>
        <div class="col-lg-6">
            <div class="d-grid d-md-flex gap-2 align-items-md-center justify-content-md-end">
                <p class="py-2 border px-4 mt-3 rounded"><?= $this->session->userdata('nama_mahasiswa') ?? $this->session->userdata('npm'); ?></p>
                <a href="<?= base_url('logout'); ?>" class="btn btn-outline-secondary logout">Logout</a>
            </div>
        </div>
    </div>
</div>

<?php if (!is_null($mata_kuliah)) : ?>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mata kuliah</th>
                        <th></th>
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
                                    <?= $value['mata_kuliah'] . ' (' . $value['kd_matkul'] . ')' ?>
                                </td>
                                <td><a href="<?= base_url('menjawab_soal_esai/' . $value['kd_matkul'] . '/' . $value['semester'] . '/' . $this->session->userdata('kd_kelas')  . '/' . $value['akses_ujian']) ?>" class="btn <?= $value['akses_ujian'] == 0 ? 'btn-secondary disabled' : 'btn-primary' ?>">Ikuti Ujian</a></td>
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
    </div>
<?php endif; ?>