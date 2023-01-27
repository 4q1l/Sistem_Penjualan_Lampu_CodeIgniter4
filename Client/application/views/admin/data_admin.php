<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?> </h1>

    </div>

    <a class="btn btn-sm btn-success mb-3" href="<?= base_url('admin/DataAdmin/tambah_data') ?>">
        <i class="fas fa-plus"> Tambah Data</i>
    </a>

    <?= $this->session->flashdata('pesan') ?>

    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0" style="margin-bottom: 100px">
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama Admin</th>
                <th>Jenis Kelamin</th>
                <th>Jabatan</th>
                <th>Tanggal Masuk</th>
                <th>Status</th>
                <th>Photo</th>
                <th>Hak Akses</th>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama Admin</th>
                <th>Jenis Kelamin</th>
                <th>Jabatan</th>
                <th>Tanggal Masuk</th>
                <th>Status</th>
                <th>Photo</th>
                <th>Hak Akses</th>
                <th>Action</th>
            </tr>
        </tfoot>
        <tbody>

            <?php $no = 0; foreach($admin as $j){ $no++ ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $j->nik ?></td>
                    <td><?= $j->nama_admin ?></td>
                    <td><?= $j->jenis_kelamin ?></td>
                    <td><?= $j->jabatan ?></td>
                    <td><?= $j->tanggal_masuk ?></td>
                    <td><?= $j->status ?></td>
                    <td><img src="<?= base_url('ext/photo/' . $j->photo) ?>" width="75px"></td>
                    <td><?= (strcmp($j->hak_akses, "1") == 1) ? "Admin" : "Karyawan" ?></td>
                    <td>
                        <center>
                            <a class="btn btn-sm btn-primary" href="<?= base_url('admin/DataAdmin/update_data/' . $j->id_admin) ?>">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger" href="<?= base_url('admin/DataAdmin/delete_data/' . $j->id_admin) ?>">
                                <i class="fas fa-trash"></i>
                            </a>
                        </center>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
</div>