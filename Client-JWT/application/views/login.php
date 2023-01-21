<html>
  <head>
  	<meta charset="utf-8">
  	<title>Login | Lampu</title>
    <link rel="stylesheet" href="<?php echo base_url("ext/style.css")?>" />
  </head>

  <body>
    
      <input name="username" id="username" type="text" placeholder="username" autocomplete="off" autofocus="on" required>
      <input name="password" id="password" type="password" placeholder="password" autocomplete="off" required>
      <button id="btn_masuk">Submit</button>
             
      <script>
        // inisialisasi object
        let btn_masuk = document.getElementById("btn_masuk");

        // buat event untuk "btn_lihat"
        btn_masuk.addEventListener('click',function(){
          let username = document.getElementById("username");
          let password = document.getElementById("password");

          const user = (username.value === "") ?
            [
                username.innerHTML = "Nama Lampu Harus Diisi !",
                username.style.color = "#FF0000",            
            ]
            :
            [
                
                username.innerHTML = "",
                username.style.color = "unset",             
            ]

            const pass = (password.value === "") ?
            [
                password.innerHTML = "Telepon Lampu Harus Diisi !",
                password.style.color = "#FF0000",          
            ]
            :
            [
                password.innerHTML = "",
                password.style.color = "unset",               
            ]
            // alihkan ke halaman view lampu
            // jika semua komponen terisi
            if(username.innerHTML === "" && pass[0] === "")
            {
                // panggil method setSave
                aksi_login(username.value,password.value);
                location.href='<?php echo site_url('Lampu/'); ?>'
            }            
            
        });     

        const aksi_login = (username,password) => {
            // buat variabel untuk form
            let form = new FormData();

            // isi/tambah nilai untuk form
            form.append("usernya",username);
            form.append("passnya",password);

            // proses kirim data ke controller
            fetch('<?php echo site_url("Login/aksi_login"); ?>',{
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
