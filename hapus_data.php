<?php
session_start();
include 'koneksi.php';
include 'csrf.php';

$id = $_POST['id'];

// Prepare the query
$query = "DELETE FROM anggota WHERE id = ?";
$params = array($id);

// Execute the query
$stmt = sqlsrv_query($conn, $query, $params);

if ($stmt === false) {
    // If there's an error, return error message
    $errors = sqlsrv_errors();
    echo json_encode(['error' => $errors[0]['message']]);
} else {
    // If successful, return success message
    echo json_encode(['success' => 'Sukses']);
    
    // Free the statement
    sqlsrv_free_stmt($stmt);
}

// Note: No need to explicitly close the connection in SQL Server
?>