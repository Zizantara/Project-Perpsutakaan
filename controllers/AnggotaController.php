<?php
if (!isset($_SESSION['login'])) {
    header("Location: " . BASE_URL . "auth/login");
    exit;
}

global $conn;

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'index';

if ($aksi == 'simpan') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    
    if (isset($_POST['id_anggota']) && !empty($_POST['id_anggota'])) {
        $id = $_POST['id_anggota'];
        mysqli_query($conn, "UPDATE anggota SET nama_anggota='$nama', alamat='$alamat' WHERE id_anggota='$id'");
    } else {
        $username_default = strtolower(explode(" ", $nama)[0]) . rand(1,100);
        $password_default = md5('123');
        
        mysqli_query($conn, "INSERT INTO users (username, password, role) VALUES ('$username_default', '$password_default', 'user')");
        $id_user_baru = mysqli_insert_id($conn);

        mysqli_query($conn, "INSERT INTO anggota (id_user, nama_anggota, alamat) VALUES ('$id_user_baru', '$nama', '$alamat')");
    }
    header("Location: " . BASE_URL . "anggota");
    exit;
}

elseif ($aksi == 'hapus') {
    $id = $_GET['id'];
    $cek = mysqli_query($conn, "SELECT id_user FROM anggota WHERE id_anggota='$id'");
    $d = mysqli_fetch_assoc($cek);
    
    if($d) {
        $id_user = $d['id_user'];
        mysqli_query($conn, "DELETE FROM users WHERE id_user='$id_user'");
    }
    
    header("Location: " . BASE_URL . "anggota");
    exit;
}

$data_edit = null;
if ($aksi == 'edit') {
    $id = $_GET['id'];
    $q = mysqli_query($conn, "SELECT * FROM anggota WHERE id_anggota='$id'");
    $data_edit = mysqli_fetch_assoc($q);
}

$cari = isset($_GET['cari']) ? $_GET['cari'] : "";
$where = "";
if($cari != "") {
    $where = "WHERE nama_anggota LIKE '%$cari%' OR alamat LIKE '%$cari%'";
}

$query_anggota = mysqli_query($conn, "SELECT anggota.*, users.username 
                                      FROM anggota 
                                      JOIN users ON anggota.id_user = users.id_user 
                                      $where 
                                      ORDER BY anggota.id_anggota DESC");

include 'views/layouts/header.php';
include 'views/anggota/index.php'; 
include 'views/layouts/footer.php';
?>