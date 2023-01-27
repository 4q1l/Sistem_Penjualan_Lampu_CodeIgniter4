<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?> </h1>

    </div>

    <div class="card">
        <div class="card-body" style="width: 70%; margin-bottom: 80px">
            <form action="<?= base_url('/admin/DataLampu/tambah_data_aksi') ?>" method="post">
                <div class="form-group">
                    <label">Nama Lampu</label>
                    <input type="text" name="nama_lampu" class="form-control">
                    <?= form_error('nama_lampu', '<div class="text-small text-danger"></div>') ?>
                </div>

                <div class="form-group">
                    <label">Kode Lampu</label>
                    <input type="number" name="kode_lampu" class="form-control">
                    <?= form_error('kode_lampu', '<div class="text-small text-danger"></div>') ?>
                </div>

                <div class="form-group">
                    <label">Harga</label>
                    <input type="number" name="harga" class="form-control">
                    <?= form_error('harga', '<div class="text-small text-danger"></div>') ?>
                </div>

                <div class="form-group">
                    <label">Tegangan</label>
                    <input type="number" name="tegangan" class="form-control">
                    <?= form_error('tegangan', '<div class="text-small text-danger"></div>') ?>
                </div>

                <button type="submit" class="btn btn-success">SIMPAN</button>
            </form>
        </div>
    </div>

</div>