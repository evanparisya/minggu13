<?php
include 'auth.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= $_SESSION['csrf_token'] ?>">

    <title>Data Anggota</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/1.11.5/dataTables.bootstrap5.min.css">

</head>
<body>
    <nav class="navbar navbar-dark bg-primary">
        <a href="index.php" class="navbar-brand" style="color: #fff">CRUD Dengan Aax
        </a>
    </nav>

    <div class="container">
        <h2 align="center" style="margin-top: 30px;">Data Anggota</h2>

        <form method="post" class="form-data" id="form-data">
            <div class="row">
                <div class="col-sm-9">
                    <div class="form-group">
                        <label for="">nama</label>
                        <input type="hidden" name="id" id="id">
                        <input type="text" name="nama" id="nama" class="form-control" required="true">
                        <p class="text-danger" id="err_nama"></p>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Jenis Kelamin:</label><br>
                        <input type="radio" name="jenis_kelamin" id="jenkel1" value="L" required> Laki-Laki
                        <input type="radio" name="jenis_kelamin" id="jenkel2" value="P"> Perempuan
                    </div>
                    <p class="text-danger" id="err_jenis_kelamin"></p>
                </div>
                
                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <textarea name="alamat" id="alamat" class="form-control"></textarea>
                    <p class="text-danger" id="err_alamat"></p>
                </div>
            
            <div class="form-group">
                <label for="no_telp">No. Telp:</label>
                <input class="form-control" type="number" name="no_telp" id="no_telp" required="true">
                <p class="text-danger" id="err_no_telp"></p>
            </div>

            <div class="form-group mt-3 mb-3">
                <button type="button" name="simpan" id="simpan" class="btn btn-primary">
                    <i class="fa fa-save"></i>Simpan Data
                </button>
            </div>
        </form>
        <hr>

        <div class="data"></div>

        
    </div>

    <div class="text-center">@
    <?php echo date('Y'); ?> Copyright:
    <a href="https://google.com/">Desain Dan Pemrograman Web</a>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'Csrf-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.data').load("data.php");
    });

    $("#simpan").click(function() {
    var data = $(".form-data").serialize();
    var jenkel1 = document.getElementById("jenkel1").value;
    var jenkel2 = document.getElementById("jenkel2").value;
    var nama = document.getElementById("nama").value;
    var alamat = document.getElementById("alamat").value;
    var no_telp = document.getElementById("no_telp").value;

    if (nama == "") {
        document.getElementById("err_nama").innerHTML = "Nama Harus Diisi";
    } else {
        document.getElementById("err_nama").innerHTML = "";
    }

    if (alamat == "") {
        document.getElementById("err_alamat").innerHTML = "Alamat Harus Diisi";
    } else {
        document.getElementById("err_alamat").innerHTML = "";
    }

    if (document.getElementById("jenkel1").checked == false && document.getElementById("jenkel2").checked == false) {
        document.getElementById("err_jenis_kelamin").innerHTML = "Jenis Kelamin Harus Dipilih";
    } else {
        document.getElementById("err_jenis_kelamin").innerHTML = "";
    }

    if (no_telp == "") {
        document.getElementById("err_no_telp").innerHTML = "No Telepon Harus Diisi";
    } else {
        document.getElementById("err_no_telp").innerHTML = "";
    }

    if (nama != "" && alamat != "" && (document.getElementById("jenkel1").checked == true|| document.getElementById("jenkel2").checked==true) && no_telp != "") {
        $.ajax({
            type: "POST",
            url: "form_action.php", 
            data: data,
            success: function() {
                $('.data').load("data.php");
                document.getElementById("id").value = "";
                document.getElementById("form-data").reset();
            },
            error: function(response) {
                console.log(response.responseText);
            }
        });
    }
});

</script>

</body>
</html>