<?php
if (!isset($_SESSION['login'])) {
    header("Location: " . BASE_URL . "auth/login");
    exit;
}
if ($_SESSION['role'] != 'admin') {
    header("Location: " . BASE_URL . "dashboard");
    exit;
}

global $conn;

if ($aksi == 'hapus') {
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        mysqli_query($conn, "DELETE FROM buku WHERE id_buku = '$id'");
    }
    header("Location: " . BASE_URL . "buku");
    exit;
}

if ($aksi == 'simpan') {
    $judul   = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $tahun   = $_POST['tahun'];
    $stok    = $_POST['stok'];

    if(isset($_POST['id_buku']) && !empty($_POST['id_buku'])){
        $id = $_POST['id_buku'];
        mysqli_query($conn, "UPDATE buku SET judul='$judul', penulis='$penulis', tahun_terbit='$tahun', stok='$stok' WHERE id_buku='$id'");
    } else {
        mysqli_query($conn, "INSERT INTO buku (judul, penulis, tahun_terbit, stok) VALUES ('$judul', '$penulis', '$tahun', '$stok')");
    }
    
    header("Location: " . BASE_URL . "buku");
    exit;
}

$data_edit = null;
if ($aksi == 'edit') {
    $id = $_GET['id'];
    $q = mysqli_query($conn, "SELECT * FROM buku WHERE id_buku='$id'");
    $data_edit = mysqli_fetch_assoc($q);
}

$cari = isset($_GET['cari']) ? $_GET['cari'] : "";
$where = "";
if($cari != "") {
    $where = "WHERE judul LIKE '%$cari%' OR penulis LIKE '%$cari%'";
}

$query_buku = mysqli_query($conn, "SELECT * FROM buku $where ORDER BY id_buku DESC");

include 'views/layouts/header.php';
include 'views/buku/index.php';
include 'views/layouts/footer.php';
?>