<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?> </h1>

    </div>

    <div class="card">
        <div class="card-body" style="width: 70%; margin-bottom: 80px">
            <form action="<?= base_url('/admin/DataAdmin/update_data_aksi') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_admin" value="<?= $admin[0]->id_admin ?>">
            
                <div class="form-group">
                    <label">NIK</label>
                    <input type="number" name="nik" class="form-control" value="<?= $admin[0]->nik ?>">
                    <?= form_error('nik', '<div class="text-small text-danger"></div>') ?>
                </div>

                <div class="form-group">
                    <label">Nama Admin</label>
                    <input type="text" name="nama_admin" class="form-control" value="<?= $admin[0]->nama_admin ?>">
                    <?= form_error('nama_admin', '<div class="text-small text-danger"></div>') ?>
                </div>

                <div class="form-group">
                    <input type="email" class="form-control form-control-user" name="username" placeholder="Username..." value="<?= $admin[0]->username ?>>
                    <?= form_error('username', '<div class="text-small text-danger"></div>') ?>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control form-control-user" name="password" placeholder="Password" value="<?= $admin[0]->password ?>>
                    <?= form_error('password', '<div class="text-small text-danger"></div>') ?>
                </div>

                <div class="form-group">
                    <label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control">
                        <option value="<?= $admin[0]->jenis_kelamin ?>"><?= $admin[0]->jenis_kelamin ?></option>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    <?= form_error('jenis_kelamin', '<div class="text-small text-danger"></div>') ?>
                </div>

                <div class="form-group">
                    <label">Jabatan</label>
                    <select name="jabatan" class="form-control">
                        <option value="<?= $admin[0]->jabatan ?>"><?= $admin[0]->jabatan ?></option>
                        <?php foreach($jabatan as $j){ ?>
                            <option value="<?= $j->nama_jabatan ?>"><?= $j->nama_jabatan ?></option>
                        <?php } ?>
                    </select>
                    <?= form_error('jabatan', '<div class="text-small text-danger"></div>') ?>
                </div>

                <div class="form-group">
                    <label">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" class="form-control" value="<?= $admin[0]->tanggal_masuk ?>">
                    <?= form_error('tanggal_masuk', '<div class="text-small text-danger"></div>') ?>
                </div>

                <div class="form-group">
                    <label">Status</label>
                    <select name="status" class="form-control">
                        <option value="<?= $admin[0]->status ?>"><?= $admin[0]->status ?></option>
                        <option value="Admin Tetap">Admin Tetap</option>
                        <option value="Admin Tidak Tetap">Admin Tidak Tetap</option>
                    </select>
                    <?= form_error('status', '<div class="text-small text-danger"></div>') ?>
                </div>

                <div class="form-group">
                    <label">Photo</label>
                    <input type="file" name="photo" class="form-control">
                    <?= form_error('photo', '<div class="text-small text-danger"></div>') ?>
                </div>

                <div class="form-group">
                    <label">Hak Akses</label>
                    <select name="hak_akses" class="form-control">
                        <option value="<?= $admin[0]->status ?>"><?= ($admin[0]->status == 1) ? "Admin" : "Karyawan" ?></option>
                        <option value="1">Admin</option>
                        <option value="2">Karyawan</option>
                    </select>
                    <?= form_error('hak_akses', '<div class="text-small text-danger"></div>') ?>
                </div>

                <button type="submit" class="btn btn-success">UPDATE</button>
            </form>
        </div>
    </div>

</div>