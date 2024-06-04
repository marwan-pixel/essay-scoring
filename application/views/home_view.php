    <?php
    if (is_null($this->session->userdata('nip'))) {
        redirect('/login');
    }
    ?>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-6">
                <form class="mt-2 w-100 d-flex" action="<?= base_url('/'); ?>" method="post" id="thn_akademik">
                    <select class="form-select" name="thn_akademik" aria-label="Default select example" onchange="this.form.submit();">
                        <option selected value="<?= $this->session->userdata('thn_akademik') ?? $thn_akademik[0]->thn_akademik; ?>"><?= $this->session->userdata('thn_akademik') ?? $thn_akademik[0]->thn_akademik ?></option>
                        <?php
                        foreach ($thn_akademik as $key => $value) {
                        ?>
                            <option value="<?= $value->thn_akademik; ?>"><?= $value->thn_akademik; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <input type="submit" name="submit" class="btn btn-primary">
                </form>
            </div>
            <div class="col-6 d-flex justify-content-end align-items-center gap-4">
                <p class="py-2 border px-4 mt-3 rounded">NIP: <?= $this->session->userdata('nip'); ?></p>
                <a href="<?= base_url('logout'); ?>" class="btn btn-outline-secondary">Logout</a>
            </div>
        </div>
    </div>
    <table class="table mt-2">
        <thead>
            <tr>
                <th>No</th>
                <th>Semester</th>
                <th>Kelas</th>
                <th>Mata Kuliah</th>
                <th>UTS</th>
                <th>UAS</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            if (count($mata_kuliah) !== 0) {

                foreach ($mata_kuliah as $key => $value) { ?>
                    <tr>
                        <th><?= ++$key ?></th>
                        <th><?= $value->semester ?></th>
                        <th><?= $value->kd_kelas ?></th>
                        <th><?= $value->kd_matkul ?></th>
                        <th>
                            <a href="<?= base_url('soal_view_uts/' . $value->kd_progstudi . '/' . $value->kd_matkul . '/' . $value->kd_kelas . '/' . $value->semester . '/' . 3); ?>" class="btn btn-outline-secondary">Input Soal</a>
                            <a href="<?= base_url('jawaban_mahasiswa_view_uts/' . $value->kd_progstudi . '/' . $value->kd_matkul . '/' . $value->kd_kelas . '/' . $value->semester . '/' . 3); ?>" class="btn btn-outline-secondary">Jawaban Soal</a>
                        </th>
                        <th>
                            <a href="<?= base_url('soal_view_uas/' . $value->kd_progstudi . '/' . $value->kd_matkul . '/' . $value->kd_kelas . '/' . $value->semester . '/' . 4); ?>" class="btn btn-outline-secondary">Input Soal</a>
                            <a href="<?= base_url('jawaban_mahasiswa_view_uas/' . $value->kd_progstudi . '/' . $value->kd_matkul . '/' . $value->kd_kelas . '/' . $value->semester . '/' . 4); ?> " class="btn btn-outline-secondary">Jawaban Soal</a>
                        </th>
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
            $('#ubahSoalEsai').on('show.bs.modal', function(event) {
                let div = $(event.relatedTarget);
                let modal = $(this);

                modal.find(`#kodeSoal`).attr("value", div.data('kd-soal'));
                modal.find(`#inputSoal`).val(div.data('soal'));
                modal.find(`#inputSkor`).attr("value", div.data('skor'));
                modal.find(`#inputBobot`).attr("value", div.data('bobot'));
                modal.find(`#inputKunciJawaban`).val(div.data('kunci-jawaban'));
            });
        });
    </script>