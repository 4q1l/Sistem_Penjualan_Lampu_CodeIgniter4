<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?> </h1>
    </div>

    <div class="card">
        <div class="card-body" style="width: 70%; margin-bottom: 80px">
            <?= $this->session->flashdata('pesan'); ?>
            <form action="<?= base_url('/GantiPassword/ganti_password_aksi') ?>" method="post">
                
                <div class="form-group">
                    <label">Password Baru</label>
                    <input type="password" class="form-control form-control-user" name="password_baru">
                    <?= form_error('password_baru', '<div class="text-small text-danger"></div>') ?>
                </div>

                <div class="form-group">
                    <label">Ulangi Password</label>
                    <input type="password" class="form-control form-control-user" name="ulangi_password">
                    <?= form_error('ulangi_password', '<div class="text-small text-danger"></div>') ?>
                </div>

                <button type="submit" class="btn btn-success">SIMPAN</button>
            </form>
        </div>
    </div>

</div>