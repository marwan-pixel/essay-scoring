<?php
if (is_null($this->session->userdata('nip'))) {
  redirect('/login');
}
?>
<a href="<?= base_url('/') ?>" class="btn btn-primary mb-3"> <i class="bi bi-arrow-left"></i></a>
<form action="<?= base_url('input_soal'); ?>" method="post">
  <input type="hidden" name="kd_progstudi" value="<?= $kd_progstudi ?>" id="">
  <input type="hidden" name="semester" value="<?= $semester ?>" id="">
  <input type="hidden" name="kd_kelas" value="<?= $kd_kelas ?>" id="">
  <input type="hidden" name="kd_matkul" value="<?= $kd_matkul ?>" id="">
  <input type="hidden" name="ctype" value="<?= $ctype ?>" id="">
  <div class="card box">
    <div class="card-header">
      <h4>Silakan Masukkan Soal Esai: <b><?= $kd_matkul ?></b></h4>
    </div>
    <div class="card-body">
      <label class="form-label" for="soal">Soal Esai</label>
      <textarea name="soal" id="soal" cols="80"></textarea>
      <label class="form-label mt-3" for="kunci_jawaban">Kunci Jawaban</label>
      <textarea name="kunci_jawaban" id="kunci_jawaban" cols="80"></textarea>
      <div class="mt-3">
        <label for="bobot" class="form-label ">Bobot Soal</label>
        <input type="number" name="bobot_soal" id="bobot" class="form-control">

      </div>
      <button type="submit" class="btn btn-primary mt-3">Simpan Data</button>
    </div>
    <script>
      CKEDITOR.replace('soal');
      CKEDITOR.replace('kunci_jawaban');
    </script>
  </div>
</form>
<?= count($soal_matkul) !== 0 && count($soal_matkul) > 12 ? $this->pagination->create_links() : ''; ?>
<table class="table mt-2">
  <thead>
    <tr>
      <th>No</th>
      <th>Soal</th>
      <th>Kunci Jawaban</th>
      <th>Status CBT</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
    <?php
    if (count($soal_matkul) !== 0) {
      foreach ($soal_matkul as $key => $value) { ?>
        <tr>
          <td><?= $key + 1; ?></td>
          <td class="col-5">
            <?= $value['soal'] ?? ''; ?>
            <div class="card">
              <div class="card-body">
                <div class="card-title">
                  <p><b>Kunci Jawaban:</b></p>
                </div>
                <?= $value['kunci_jawaban'] ?? ''; ?>
              </div>
            </div>
            <div class="card mt-3">
              <div class="card-body">
                <div class="card-title">
                  <p><b>Bobot Soal:</b></p>
                </div>
                <?= $value['bobot_soal'] ?? ''; ?>
              </div>
            </div>
          </td>
          <td>
            <?= $value['aktif'] == 1 ? 'Soal ditampilkan di CBT' : "Soal tidak ditampilkan di CBT" ?>
          </td>
          <td>
            <a href="<?= base_url('update_status_soal_uas/' . $kd_progstudi . '/' . $kd_matkul . '/' . $kd_kelas . '/' . $semester . '/' . $ctype . '/' . $value['kd_soal'] . '/' . $value['aktif']); ?>" class="update-status-soal btn btn-outline-secondary"><?= $value['aktif'] == 1 ? 'Soal Tidak Ditampilkan' : 'Soal Ditampilkan'; ?></a>
          </td>
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