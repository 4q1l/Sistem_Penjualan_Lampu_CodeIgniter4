<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?> </h1>

    </div>

    <a class="btn btn-sm btn-success mb-3" href="<?= base_url('admin/DataLampu/tambah_data') ?>">
        <i class="fas fa-plus"> Tambah Data</i>
    </a>

    <?= $this->session->flashdata('pesan') ?>

    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0" style="margin-bottom: 100px">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lampu</th>
                <th>Kode Lampu</th>
                <th>Harga</th>
                <th>Tegangan</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Nama Lampu</th>
                <th>Kode Lampu</th>
                <th>Harga</th>
                <th>Tegangan</th>
                <th>Action</th>
            </tr>
        </tfoot>
        <tbody>

            <?php $no = 0; foreach($lampu as $j){ $no++ ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $j->nama_lampu ?></td>
                    <td><?= $j->kode_lampu ?></td>
                    <td><?= 'Rp. ' . number_format($j->harga, 0, ',', '.') ?></td>
                    <td><?= 'Rp. ' . number_format($j->tegangan, 0, ',', '.') ?></td>
                    <td>
                        <center>
                            <a class="btn btn-sm btn-primary" href="<?= base_url('admin/DataLampu/update_data/' . $j->id_lampu) ?>">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger" href="<?= base_url('admin/DataLampu/delete_data/' . $j->id_lampu) ?>">
                                <i class="fas fa-trash"></i>
                            </a>
                        </center>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    
</div>