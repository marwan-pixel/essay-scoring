<?php
if (is_null($this->session->userdata('nip'))) {
  redirect('/login');
}
?>
<a href="<?= base_url('/') ?>" class="btn btn-primary mb-3"> <i class="bi bi-arrow-left"></i></a>
<<<<<<< HEAD
=======
<button class="btn btn-primary onboarding_input mb-3">Bantuan</button>
>>>>>>> 518c5dffa9444c60e25e8ff5f447792e3b9daee0

<?php
echo $this->session->flashdata('success');
echo $this->session->flashdata('message'); ?>
<<<<<<< HEAD
<table class="table mt-2">
=======

<form data-intro="Ini adalah form untuk meng-upload Soal Esai" action="<?= base_url('input_soal'); ?>" enctype="multipart/form-data" class="tambah-data-soal" method="post">
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
      <div class="mt-3" data-intro="Form Input ini untuk meng-upload soal esai yang ingin di-upload">
        <label class="form-label" for="soal">Soal Esai</label>
        <textarea name="soal" id="soal" cols="80"></textarea>
        <?= form_error('soal', '<small class="text-danger pl-3">', '</small>'); ?>
      </div>
      <div class="mt-3" data-intro="Form Input ini untuk meng-upload gambar yang ingin dilampirkan">
        <label for="gambar" class="form-label">Silakan Upload Lampiran Gambar</label>
        <input type="file" class="form-control" name="gambar" id="gambar">
      </div>
      <div class="mt-3" data-intro="Form Input ini untuk meng-upload kunci jawaban esai">
        <label class="form-label mt-3" for="kunci_jawaban">Kunci Jawaban</label>
        <textarea name="kunci_jawaban" id="kunci_jawaban" cols="80"></textarea>
        <?= form_error('kunci_jawaban', '<small class="text-danger pl-3">', '</small>'); ?>
      </div>
      <div class="mt-3" data-intro="Form Input ini untuk menginput nilai bobot pada soal">
        <label for="bobot" class="form-label">Bobot Soal</label>
        <input type="number" name="bobot_soal" id="bobot" class="form-control">
        <?= form_error('bobot_soal', '<small class="text-danger pl-3">', '</small>'); ?>
      </div>
      <button type="submit" class="btn btn-primary mt-3">Simpan Data</button>
    </div>
  </div>
</form>

<table class="table mt-2" data-intro="Soal esai, kunci jawaban, dan bobot soal yang telah diinputkan akan disimpan di sini">
>>>>>>> 518c5dffa9444c60e25e8ff5f447792e3b9daee0
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
<<<<<<< HEAD
            <?= $value['soal'] ?? ''; ?>
=======
            <div class="editable pe-auto"><?= $value['soal'] ?? ''; ?></div>
>>>>>>> 518c5dffa9444c60e25e8ff5f447792e3b9daee0
            <div class="card">
              <div class="card-body">
                <div class="card-title">
                  <p><b>Kunci Jawaban:</b></p>
                </div>
<<<<<<< HEAD
                <?= $value['kunci_jawaban'] ?? ''; ?>
              </div>
            </div>
=======
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
            </div>
>>>>>>> 518c5dffa9444c60e25e8ff5f447792e3b9daee0
            <div class="card mt-3">
              <div class="card-body">
                <div class="card-title">
                  <p><b>Bobot Soal:</b></p>
                </div>
<<<<<<< HEAD
                <?= $value['bobot_soal'] ?? ''; ?>
              </div>
            </div>
=======
                <div class="update_bobot_soal editable">
                  <?= $value['bobot_soal']; ?>
                </div>
              </div>
            </div>
            <button class="mt-2 btn btn-primary update-button">Perbarui Data</button>
>>>>>>> 518c5dffa9444c60e25e8ff5f447792e3b9daee0
          </td>
          <td>
            <?= $value['aktif'] == 1 ? 'Soal ditampilkan di CBT' : "Soal tidak ditampilkan di CBT" ?>
          </td>
          <td>
<<<<<<< HEAD
            <a href="<?= base_url('update_status_soal/' . $kd_progstudi . '/' . $kd_matkul . '/' . $kd_kelas . '/' . $semester . '/' . $ctype . '/' . $value['kd_soal'] . '/' . $value['aktif']); ?>" id="" class="update-status-soal btn btn-outline-secondary"><?= $value['aktif'] == 1 ? 'Soal Tidak Ditampilkan' : 'Soal Ditampilkan'; ?></a>
=======
            <a href="<?= base_url('update_status_soal/' . $kd_progstudi . '/' . $kd_matkul . '/' . $kd_kelas . '/' . $semester . '/' . $ctype . '/' . $value['kd_soal'] . '/' . $value['aktif']); ?>" id="" class="update-status-soal btn btn-primary"><?= $value['aktif'] == 1 ? 'Soal Tidak Ditampilkan' : 'Soal Ditampilkan'; ?></a>
>>>>>>> 518c5dffa9444c60e25e8ff5f447792e3b9daee0
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
<<<<<<< HEAD
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
=======
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
        const bobotSoalField = document.getElementById('bobot');
        const aktifField = document.getElementById('aktif');

        soalField.focus();
        const editableData = td.querySelectorAll('.editable');
        soalField.setData(editableData[0].innerHTML);
        kodeSoalField.value = editableData[1].innerHTML;
        aktifField.value = editableData[2].innerHTML;
        console.log(editableData[4])
        if (editableData[3].innerText == "Belum diinputkan") {
          editableData[3].innerText = "";
        }
        kunciJawabanField.setData(editableData[3].innerHTML);
        bobotSoalField.value = editableData[4].innerText;
        console.log(aktifField.value);
      });
    });

    const onBoardingInput = document.querySelector('.onboarding_input');
    console.log(document.querySelector('.table tbody tr:first-child td .update-button'));
    document.querySelector('.table tbody tr:first-child td .update-button').setAttribute('data-intro', "Jika ada soal esai, kunci jawaban, atau bobot soal yang ingin diubah, bisa mengklik tombol ini untuk memperbarui data");
    document.querySelector('.table tbody tr:first-child td .update-status-soal').setAttribute('data-intro', "Jika soal esai tidak ingin ditampilkan, bisa mengklik tombol ini untuk mengubah status soal esai");
    onBoardingInput.addEventListener('click', function() {
      introJs().start();
    });
  });
</script>
>>>>>>> 518c5dffa9444c60e25e8ff5f447792e3b9daee0
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>