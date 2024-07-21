<?php
if (is_null($this->session->userdata('npm'))) {
    redirect('/login');
}
echo $this->session->flashdata('message');
?>
<div class="container">
    <?php
    if (count($soal_matakuliah) > 0) :
    ?>
        <table class="table">
            <tbody class="table-group-divider">
                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                <?= $soal_matakuliah[0]['soal'] ?>
                <?php
                if ($soal_matakuliah[0]['gambar'] != '') :
                ?>
                    <img src=" <?= base_url() . 'assets/gambar/' . $soal_matakuliah[0]['gambar'] ?>" alt="">
                <?php
                endif;
                ?>
                <div class="card">
                    <div class="card-title">

                    </div>
                    <div class="card-body">
                        <form class="simpan-data-jawaban" action="<?= base_url('simpan_jawaban_esai') ?>" method="post">
                            <input type="hidden" name="thn_akademik" value="<?= $this->session->userdata('thn_akademik'); ?>">
                            <input type="hidden" name="semester" value="<?= $semester; ?>">
                            <input type="hidden" name="kd_kelas" value="<?= $kd_kelas; ?>">
                            <input type="hidden" name="kd_progstudi" value="<?= $this->session->userdata('kd_progstudi'); ?>">
                            <input type="hidden" name="kd_matkul" value="<?= $kd_matkul; ?>">
                            <input type="hidden" name="kd_soal" value="<?= $soal_matakuliah[0]['kd_soal']; ?>">
                            <input type="hidden" name="npm" value="<?= $this->session->userdata('npm'); ?>">
                            <input type="hidden" name="bobot_soal" value="<?= $soal_matakuliah[0]['bobot_soal']; ?>">
                            <input type="hidden" name="ctype" value="<?= $soal_matakuliah[0]['ctype']; ?>">
                            <input type="hidden" name="kunci_jawaban" value="<?= $soal_matakuliah[0]['kunci_jawaban']; ?>">
                            <label for="jawaban" class="form-label">Silakan Masukkan Jawaban di bawah</label>
                            <textarea name="jawaban" id="<?= 'jawaban' ?>" cols="80" rows="80">
                            <?php
                            echo $jawaban_mahasiswa[0]['jawaban'] ?? '';
                            ?>
                            </textarea>
                            <button type="submit" class="btn btn-primary mt-2">Simpan Jawaban </button>
                        </form>
                        <script>
                            CKEDITOR.replace("jawaban");
                        </script>
                    </div>
                </div>
            </tbody>
        </table>

    <?php
    else :
    ?>
        <table class="table mt-5">
            <tr>
                <td>
                    <p class="card-subtitle fw-bold mb-3 fs-6">Mata kuliah </p>
                </td>
                <td>
                    <p class="card-subtitle fw-bold mb-3 fs-6"><?= $nama_matkul . " (" . $kd_matkul . ")"; ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="card-subtitle fw-bold mb-3 fs-6">Nama Dosen </p>
                </td>
                <td>
                    <p class="card-subtitle fw-bold mb-3 fs-6"> <?= $this->session->userdata('nama_dosen'); ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="card-subtitle fw-bold mb-3 fs-6">Semester </p>
                </td>
                <td>
                    <p class="card-subtitle fw-bold mb-3 fs-6"> <?= $semester; ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="card-subtitle fw-bold mb-3 fs-6">Kelas </p>
                </td>
                <td>
                    <p class="card-subtitle fw-bold mb-3 fs-6"> <?= $kd_kelas; ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="card-subtitle fw-bold mb-3 fs-6">Program Studi </p>
                </td>
                <td>
                    <p class="card-subtitle fw-bold mb-3 fs-6"> <?= $progstudi; ?></p>
                </td>
            </tr>
        </table>
    <?php
    endif;
    ?>
</div>