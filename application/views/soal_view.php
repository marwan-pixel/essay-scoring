<a href="<?= base_url('/') ?>" class="btn btn-primary mb-3"> <i class="bi bi-arrow-left"></i></a>

<h5 class="card-subtitle text-muted">Soal Esai: <?= $title; ?></h5>

<button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#tambahSoalEsai"><i class="bi bi-plus-circle me-1"></i> Soal</button>

<!-- Modal -->
<div class="modal fade" id="tambahSoalEsai" data-bs-backdrop="static" tabindex="-1" aria-labelledby="tambahSoalEsaiLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tambahSoalEsaiLabel"> Soal Esai</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('input_soal') ?>" method="post">
          <div class="mb-3">
            <label for="textarea_essay" class="form-label">Soal</label>
            <textarea name="input_soal" required class="form-control" id="textarea_essay" cols="20" rows="5" aria-describedby="soalHelp"></textarea>
          </div>
          <div class="mb-3">
            <label for="inputSkor" class="form-label">Skor</label>
            <input type="number" required name="input_skor" id="inputSkor" class="form-control" aria-describedby="skorHelp">
          </div>
          <div class="mb-3">
            <label for="inputBobot" class="forn-label">Bobot</label>
            <input type="number" required name="input_bobot" id="inputBobot" class="form-control" aria-describedby="bobotHelp">
          </div>
          <div class="mb-3">
            <label for="textarea_essay" class="form-label">Kunci Jawaban</label>
            <textarea required name="input_kunci_jawaban" class="form-control" id="textarea_essay" cols="20" rows="10" aria-describedby="soalHelp"></textarea>
          </div>
          <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ubahSoalEsai" data-bs-backdrop="static" tabindex="-1" aria-labelledby="ubahSoalEsaiLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="ubahSoalEsaiLabel">Ubah Soal Esai</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <input hidden type="text" name="" id="kodeSoal">
          <div class="mb-3">
            <label for="textarea_essay" class="form-label">Soal</label>
            <textarea name="input_soal" class="form-control" id="textarea_essay" cols="20" rows="5" aria-describedby="soalHelp"></textarea>
          </div>
          <div class="mb-3">
            <label for="inputSkor" class="form-label">Skor</label>
            <input type="number" name="input_skor" id="inputSkor" class="form-control" aria-describedby="skorHelp">
          </div>
          <div class="mb-3">
            <label for="inputBobot" class="forn-label">Bobot</label>
            <input type="number" name="input_bobot" id="inputBobot" class="form-control" aria-describedby="bobotHelp">
          </div>
          <div class="mb-3">
            <label for="textarea_essay" class="form-label">Kunci Jawaban</label>
            <textarea name="input_kunci_jawaban" class="form-control kunciJawaban" id="textarea_essay" cols="20" rows="10" aria-describedby="soalHelp"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Ubah</button>
        </form>
      </div>
    </div>
  </div>
</div>

<table class="table mt-2">
  <thead>
    <tr>
      <th>No</th>
      <th>Soal</th>
      <th>Skor</th>
      <th>Bobot</th>
      <th>Kunci Jawaban</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
    <?php
    if (count($soal_matkul) !== 0) {
      foreach ($soal_matkul as $key => $value) { ?>
        <tr>
          <td><?= $key + 1; ?></td>
          <td class="col-3"><?= $value->soal ?? ''; ?></td>
          <td><?= $value->skor ?? ''; ?></td>
          <td><?= $value->bobot ?? ''; ?></td>
          <td class="col-5"><?= $value->kunci_jawaban ?? ''; ?></td>
          <td>
            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
              <a href="javascript:;" kd-soal="<?= $value->kd_soal; ?>" data-soal="<?= $value->soal; ?>" data-bobot="<?= $value->bobot; ?>" data-skor="<?= $value->skor; ?>" data-kunci-jawaban="<?= $value->kunci_jawaban; ?>" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ubahSoalEsai">Ubah</a>
              <a href="<?= base_url('mahasiswa_view/' . $value->kd_soal); ?>" class="btn btn-success col-6">Jawaban Mahasiswa</a>
            </div>
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

<script>
  $(document).ready(() => {
    $('#ubahSoalEsai').on('show.bs.modal', (event) => {
      let div = $(event.relatedTarget);
      let modal = $(this);

      modal.find(`#kodeSoal`).attr("value", div.data('kd-soal'));
      modal.find(`#textarea_essay`).attr("value", div.data('soal'));
      modal.find(`#inputSkor`).attr("value", div.data('skor'));
      modal.find(`#inputBobot`).attr("value", div.data('bobot'));
      modal.find(`#kunciJawaban`).attr("value", div.data('kunci-jawaban'));
    });
  });
</script>