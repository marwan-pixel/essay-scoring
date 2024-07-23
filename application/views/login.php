<?php
if (!is_null($this->session->userdata('nip'))) {
    redirect('/');
} else if (!is_null($this->session->userdata('npm'))) {
<<<<<<< HEAD
    redirect('essay_scoring_view');
}
?>
<div class="login">
    <?= $this->session->flashdata('message'); ?>
    <form method="post" class="mt-2" action="<?= base_url('loginService'); ?>">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">ID</label>
            <input type="text" class="form-control" name="id" id="exampleInputEmail1" aria-describedby="emailHelp">
            <?= form_error('id', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>
=======
    redirect('dashboard_home_mahasiswa');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Esai</title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="<?= base_url(); ?>assets/ckeditor/ckeditor.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="d-flex align-items-center justify-content-center flex-column" style="height: 100vh;">
        <h3 class="text-center mb-4">Aplikasi Penilaian Esai</h3>
        <div class="card w-md-25">
            <div class="card-body">
                <h4 class="text-center mb-3">LOGIN</h4>
                <div class="login">
                    <?= $this->session->flashdata('message'); ?>
                    <form method="post" class="mt-2" action="<?= base_url('loginService'); ?>">
                        <p class="text-center">Silakan Masukkan User ID dan Password Anda</p>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text" id="addon-wrapping"><i class="bi bi-person-fill"></i></span>
                                <input type="text" class="form-control" placeholder="ID" name="id" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <?= form_error('id', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text" id="addon-wrapping"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" placeholder="password" name="password" class="form-control" id="exampleInputPassword1">
                            </div>
                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="<?= base_url(); ?>assets/js/dist/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/myscript.js"></script>
</body>

</html>
>>>>>>> 518c5dffa9444c60e25e8ff5f447792e3b9daee0
