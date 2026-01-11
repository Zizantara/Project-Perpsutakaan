<?php
if (!isset($_SESSION['login'])) {
    header("Location: " . BASE_URL . "auth/login");
    exit;
}

global $conn;

$cari = isset($_GET['cari']) ? $_GET['cari'] : "";
$where_sql = "";

if (!empty($cari)) {
    $where_sql = "WHERE judul LIKE '%$cari%' OR penulis LIKE '%$cari%'";
}

$query_buku = mysqli_query($conn, "SELECT * FROM buku $where_sql ORDER BY id_buku DESC");

include 'views/layouts/header.php';
include 'views/dashboard/index.php';
include 'views/layouts/footer.php';
?>