<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Lampu</title>

    <!-- import file "style.css" -->
    <link rel="stylesheet" href="<?php echo base_url("ext/style.css") ?>">
</head>

<body>
    <!-- buat area menu -->
    <nav class="area-menu">
        <button id="btn_lihat" class="btn-primary">Lihat Data</button>
        <button id="btn_refresh" class="btn-secondary" onclick="return setRefresh()">Refresh Data</button>
    </nav>

    <!-- buat area untuk entry data lampu -->
    <main class="area-grid">
        <section class="item-label1">
            <label id="lbl_kode" for="txt_kode">
                KODE Lampu :
            </label>
        </section>
        <section class="item-input1">
            <input type="text" id="txt_kode" class="text-input" maxlength="9">
        </section>
        <section class="item-error1">
            <p id="err_kode" class="error-info">Ini Error</p>
        </section>

        <section class="item-label2">
            <label id="lbl_nama" for="txt_nama">
                Nama Lampu :
            </label>
        </section>
        <section class="item-input2">
            <input type="text" id="txt_nama" class="text-input" maxlength="100">
        </section>
        <section class="item-error2">
            <p id="err_nama" class="error-info"></p>
        </section>

        <section class="item-label3">
            <label id="lbl_harga" for="txt_harga">
                Harga Lampu :
            </label>
        </section>
        <section class="item-input3">
            <input type="text" id="txt_harga" class="text-input" maxlength="15"
            onkeypress="return setNumber(event)">
        </section>
        <section class="item-error3">
            <p id="err_harga" class="error-info"></p>
        </section>

        <section class="item-label4">
            <label id="lbl_tegangan" for="txt_tegangan">
                Tegangan Lampu :
            </label>
        </section>
        <section class="item-input4">
            <input type="text" id="txt_harga" class="text-input" maxlength="15"
            onkeypress="return setNumber(event)">
        </section>
        <section class="item-error4">
            <p id="err_tegangan" class="error-info"></p>
        </section>
    </main>

    <!-- buat area menu -->
    <nav class="area-menu" style="margin-top: 10px;">
        <button id="btn_simpan" class="btn-primary">Simpan Data</button>
    </nav>

    <!-- import file "script.js -->
    <script src="<?php echo base_url("ext/script.js"); ?>"></script>

    <script>
        // inisialisasi object
        let btn_lihat = document.getElementById("btn_lihat");
        let btn_simpan = document.getElementById("btn_simpan");

        // buat event untuk "btn_lihat"
        btn_lihat.addEventListener('click', function() {
            // alihkan ke halaman view lampu
            location.href = '<?php echo base_url(); ?>'
        });

        // buat fungsi untuk refresh
        function setRefresh() {
            location.href = '<?php echo site_url("Lampu/addLampu"); ?>';
        }

        //buat event untuk "btn_simpan"
        btn_simpan.addEventListener('click', function() {
            //inisialisasi object
            let lbl_kode = document.getElementById("lbl_kode");
            let txt_kode = document.getElementById("txt_kode");
            let err_kode = document.getElementById("err_kode");

            let lbl_nama = document.getElementById("lbl_nama");
            let txt_nama = document.getElementById("txt_nama");
            let err_nama = document.getElementById("err_nama");

            let lbl_harga = document.getElementById("lbl_harga");
            let txt_harga = document.getElementById("txt_harga");
            let err_harga = document.getElementById("err_harga");

            let lbl_tegangan = document.getElementById("lbl_tegangan");
            let txt_tegangan = document.getElementById("cbo_tegangan");
            let err_tegangan = document.getElementById("err_tegangan");

            //jika kode tidak di isi
            if (txt_kode.value === "") {
                err_kode.style.display = 'unset';
                err_kode.innerHTML = "KODE Harus Diisi !";
                lbl_kode.style.color = "#FF0000";
                txt_kode.style.borderColor = "#FF0000";
            }
            //jika kode diisi
            else {
                err_kode.style.display = 'none';
                err_kode.innerHTML = "";
                lbl_kode.style.color = "unset";
                txt_kode.style.borderColor = "unset";
            }

            // ternary operator
            const nama = (txt_nama.value === "") ? [
                err_nama.style.display = 'unset',
                err_nama.innerHTML = "Nama Lampu Harus Diisi !",
                lbl_nama.style.color = "#FF0000",
                txt_nama.style.borderColor = "#FF0000"
            ] : [
                err_nama.style.display = 'none',
                err_nama.innerHTML = "",
                lbl_nama.style.color = "unset",
                txt_nama.style.borderColor = "unset"
            ]

            const harga = (txt_harga.value === "") ? [
                err_harga.style.display = 'unset',
                err_harga.innerHTML = "Harga Lampu Harus Diisi !",
                lbl_harga.style.color = "#FF0000",
                txt_harga.style.borderColor = "#FF0000"
            ] : [
                err_harga.style.display = 'none',
                err_harga.innerHTML = "",
                lbl_harga.style.color = "unset",
                txt_harga.style.borderColor = "unset"
            ]

            const tegangan = (cbo_tegangan.selectedIndex === 0) ? [
                err_tegangan.style.display = 'unset',
                err_tegangan.innerHTML = "tegangan Lampu Harus Dipilih !",
                lbl_tegangan.style.color = "#FF0000",
                cbo_tegangan.style.borderColor = "#FF0000"
            ] : [
                err_tegangan.style.display = 'none',
                err_tegangan.innerHTML = "",
                lbl_tegangan.style.color = "unset",
                cbo_tegangan.style.borderColor = "unset"
            ]

            // jika semua komponen terisi
            if (err_kode.innerHTML === "" && nama[1] === "" && harga[1] ===
                "" && tegangan[1] === "") {
                // panggil method setSave
                setSave(txt_kode.value, txt_nama.value, txt_harga.value, cbo_tegangan.value);

            }
            // alert(`tegangan : ${cbo_tegangan.value}`)
        });

        const setSave = (kode, nama, harga, tegangan) => {
            // buat variabel untuk form
            let form = new FormData();
            // isi/tambah nilai untuk form
            form.append("kodenya", kode);
            form.append("namanya", nama);
            form.append("harganya", harga);
            form.append("tegangannya", tegangan);

            // Proses kirim data ke controller
            fetch('<?php echo site_url("Lampu/setSave"); ?>', {
                    method: "POST",
                    body: form
                })
                .then((response) => response.json())
                .then((result) => alert(result.statusnya))
                .catch((error) => alert("Data Gagal Dikirim !"))

        }
    </script>

</body>

</html>