<?php
include('koneksi.php');

$aksi = $_GET['aksi'];
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$alamat = $_POST['alamat'];
$no_telp = $_POST['no_telp'];

if($aksi == 'tambah') {
    // Insert query with parameters
    $query = "INSERT INTO anggota (nama, jenis_kelamin, alamat, no_telp) VALUES (?, ?, ?, ?)";
    $params = array($nama, $jenis_kelamin, $alamat, $no_telp);
    
    $stmt = sqlsrv_query($conn, $query, $params);
    
    if ($stmt === false) {
        die("Gagal menambahkan data: " . print_r(sqlsrv_errors(), true));
    } else {
        sqlsrv_free_stmt($stmt);
        header("Location: index.php");
        exit();
    }
}

else if ($aksi == 'ubah') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Update query with parameters
        $query = "UPDATE anggota SET nama = ?, jenis_kelamin = ?, alamat = ?, no_telp = ? WHERE id = ?";
        $params = array($nama, $jenis_kelamin, $alamat, $no_telp, $id);

        $stmt = sqlsrv_query($conn, $query, $params);
        
        if ($stmt === false) {
            die("Gagal mengupdate data: " . print_r(sqlsrv_errors(), true));
        } else {
            sqlsrv_free_stmt($stmt);
            header("Location: index.php");
            exit();
        }
    } else {
        echo "ID tidak valid.";
    }
}

elseif ($aksi == 'hapus') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Delete query with parameter
        $query = "DELETE FROM anggota WHERE id = ?";
        $params = array($id);

        $stmt = sqlsrv_query($conn, $query, $params);
        
        if ($stmt === false) {
            die("Gagal menghapus data: " . print_r(sqlsrv_errors(), true));
        } else {
            sqlsrv_free_stmt($stmt);
            header("Location: index.php");
            exit();
        }
    } else {
        echo "ID tidak valid.";
    }
} else {
    header("Location: index.php");
}

// No need to explicitly close the connection in SQL Server
?>