    <?php
    if (is_null($this->session->userdata('nip'))) {
        redirect('/login');
    }
    ?>
    <div class="">
        <button class="btn btn-primary onboarding">Bantuan</button>
        <div class="row align-items-center">
            <div class="col-lg-12">
                <form class="mt-2 w-100 d-flex" action="<?= base_url('/'); ?>" method="post" id="thn_akademik">
                    <div class="input-group">
                        <label class="input-group-text" for="inputGroupSelect01">Tahun Akademik</label>
                        <select class="form-select" name="thn_akademik" aria-label="Default select example" onchange="document.getElementById('thn_akademik').submit();">
                            <option selected value="<?= $this->session->userdata('thn_akademik') ?? $thn_akademik[0]->thn_akademik; ?>"><?= $this->session->userdata('thn_akademik') ?? $thn_akademik[0]->thn_akademik ?></option>
                            <?php
                            foreach ($thn_akademik as $key => $value) {
                            ?>
                                <option value="<?= $value->thn_akademik; ?>"><?= $value->thn_akademik; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <div class="table-responsive">
        <table class="table mt-2">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Semester</th>
                    <th>Kelas</th>
                    <th>Mata Kuliah</th>
                    <th>Data Mahasiswa</th>
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
                            <th><?= $value['semester'] ?></th>
                            <th><?= $value['kd_kelas'] ?></th>
                            <th><?= $value['mata_kuliah'] ?></th>
                            <th><a href="<?= base_url('data_mahasiswa/' . $value['kd_progstudi'] . '/' . $value['kd_matkul'] . '/' . $value['kd_kelas'] . '/' . $value['semester']) ?>" class="btn btn-primary">Data Mahasiswa</a></th>
                            <th>
                                <a href="<?= base_url('input_soal_esai_uts/' . $value['kd_progstudi'] . '/' . $value['kd_matkul'] . '/' . $value['kd_kelas'] . '/' . $value['semester'] . '/' . 3); ?>" class="btn btn btn-primary">Input Soal</a>
                                <a href="<?= base_url('melihat_jawaban_esai_dan_nilai_uts/' . $value['kd_progstudi'] . '/' . $value['kd_matkul'] . '/' . $value['kd_kelas'] . '/' . $value['semester'] . '/' . 3); ?>" class="btn btn-primary mt-2 mt-lg-0">Jawaban Soal</a>
                            </th>
                            <th>
                                <a href="<?= base_url('input_soal_esai_uas/' . $value['kd_progstudi'] . '/' . $value['kd_matkul'] . '/' . $value['kd_kelas'] . '/' . $value['semester'] . '/' . 4); ?>" class="btn btn-primary">Input Soal</a>
                                <a href="<?= base_url('melihat_jawaban_esai_dan_nilai_uas/' . $value['kd_progstudi'] . '/' . $value['kd_matkul'] . '/' . $value['kd_kelas'] . '/' . $value['semester'] . '/' . 4); ?> " class="btn btn-primary mt-2 mt-lg-0">Jawaban Soal</a>
                            </th>
                        </tr>
                    <?php

                    }
                } else { ?>
                    <tr>
                        <td colspan="6">
                            <p class="text-center">Mata Kuliah Belum Tersedia</p>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        const onBoarding = document.querySelector('.onboarding');
        onBoarding.addEventListener('click', function() {
            introJs().start();
        })
    </script>