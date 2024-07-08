<?php
if (is_null($this->session->userdata('nip'))) {
  redirect('/login');
}
?>
<a href="<?= base_url('/') ?>" class="btn btn-primary mb-3"> <i class="bi bi-arrow-left"></i></a>

<?php
echo $this->session->flashdata('success');
echo $this->session->flashdata('message'); ?>
<form action="<?= base_url('input_soal'); ?>" class="tambah-data-soal" method="post">
  <input type="hidden" name="kd_progstudi" value="<?= $kd_progstudi ?>" id="">
  <input type="hidden" name="semester" value="<?= $semester ?>" id="">
  <input type="hidden" name="kd_kelas" value="<?= $kd_kelas ?>" id="">
  <input type="hidden" name="kd_matkul" value="<?= $kd_matkul ?>" id="">
  <input type="hidden" name="ctype" value="<?= $ctype ?>" id="">
  <input type="hidden" name="kd_soal" value="" id="kd_soal">
  <input type="hidden" name="aktif" value="" id="aktif">
  <div class="card box">
    <div class="card-header">
      <h4>Silakan Masukkan Soal Esai: <b><?= $kd_matkul ?></b></h4>
    </div>
    <div class="card-body">
      <div class="mt-3">
        <label class="form-label" for="soal">Soal Esai</label>
        <textarea name="soal" id="soal" cols="80"></textarea>
        <?= form_error('soal', '<small class="text-danger pl-3">', '</small>'); ?>
      </div>
      <div class="mt-3">
        <label class="form-label" for="kunci_jawaban">Kunci Jawaban</label>
        <textarea name="kunci_jawaban" id="kunci_jawaban" cols="80"></textarea>
        <?= form_error('kunci_jawaban', '<small class="text-danger pl-3">', '</small>'); ?>
      </div>
      <div class="mt-3">
        <label for="bobot" class="form-label ">Bobot Soal</label>
        <input type="number" name="bobot_soal" id="bobot_soal" class="form-control">
        <?= form_error('bobot_soal', '<small class="text-danger pl-3">', '</small>'); ?>
      </div>
      <button type="submit" class=" btn btn-primary mt-3">Simpan Data</button>
    </div>
  </div>
</form>
<div class="table-responsive">
  <table class="table mt-2">
    <thead>
      <tr>
        <th>No</th>
        <th>Soal</th>
        <th>Status CBT</th>
      </tr>
    </thead>
    <tbody class="table-group-divider">
      <?php
      if (count($soal_matkul) !== 0) {
        foreach ($soal_matkul as $key => $value) { ?>
          <tr>
            <td><?= $key + 1; ?></td>
            <td class="col-6">
              <div class="editable pe-auto"><?= $value['soal'] ?? ''; ?></div>
              <div class="card">
                <div class="card-body">
                  <div class="card-title">
                    <p><b>Kunci Jawaban:</b></p>
                  </div>
                  <div class="editable" style="display: none;">
                    <?= $value['kd_soal']; ?>
                  </div>
                  <div class="editable" style="display: none;">
                    <?= $value['aktif']; ?>
                  </div>
                  <div class="editable pe-auto">
                    <?= $value['kunci_jawaban'] !== '' ? $value['kunci_jawaban'] : 'Belum diinputkan'; ?>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <div class="card-body">
                  <div class="card-title">
                    <p><b>Bobot Soal:</b></p>
                  </div>
                  <div class="editable pe-auto">
                    <?= $value['bobot_soal']; ?>
                  </div>
                </div>
              </div>
              <button class="mt-2 btn btn-primary update-button">Perbarui Data</button>
            </td>
            <td>
              <?= $value['aktif'] == 1 ? 'Soal ditampilkan di CBT' : "Soal tidak ditampilkan di CBT" ?>
            </td>
            <td>
              <a href="<?= base_url('update_status_soal/' . $kd_progstudi . '/' . $kd_matkul . '/' . $kd_kelas . '/' . $semester . '/' . $ctype . '/' . $value['kd_soal'] . '/' . $value['aktif']); ?>" id="" class="update-status-soal btn btn-outline-secondary"><?= $value['aktif'] == 1 ? 'Soal Tidak Ditampilkan' : 'Soal Ditampilkan'; ?></a>
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
</div>
<script>
  CKEDITOR.replace('soal');
  CKEDITOR.replace('kunci_jawaban');

  document.addEventListener('DOMContentLoaded', function() {
    const updateButton = document.querySelectorAll('.update-button');
    const formData = document.querySelector('.tambah-data-soal');

    updateButton.forEach(button => {
      button.addEventListener('click', function() {
        const td = this.parentElement;
        const kodeSoalField = document.getElementById('kd_soal');
        const soalField = CKEDITOR.instances.soal;
        const kunciJawabanField = CKEDITOR.instances.kunci_jawaban;
        const bobotSoalField = document.getElementById('bobot_soal');
        const aktifField = document.getElementById('aktif');

        soalField.focus();
        const editableData = td.querySelectorAll('.editable');
        soalField.setData(editableData[0].innerText);
        kodeSoalField.value = editableData[1].innerText;
        aktifField.value = editableData[2].innerText;
        kunciJawabanField.setData(editableData[3].innerText);
        bobotSoalField.value = editableData[4].innerText;
        console.log(aktifField.value);
      });
    });
  });
</script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>