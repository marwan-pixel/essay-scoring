<div class="login">
    <?= $this->session->flashdata('message'); ?>
    <form method="post" class="mt-2" action="<?= base_url('loginService'); ?>">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Username</label>
            <input type="text" class="form-control" name="nip" id="exampleInputEmail1" aria-describedby="emailHelp">
            <?= form_error('nip', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>