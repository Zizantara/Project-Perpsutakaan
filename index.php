<?php
session_start();
require_once 'config/Database.php';

define('BASE_URL', 'http://zizantara.my.id/');

$dbObject = new Database();
$conn = $dbObject->conn;

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'index';

switch ($page) {
    case 'auth':
        include 'controllers/AuthController.php';
        break;
    case 'dashboard':
        include 'controllers/DashboardController.php';
        break;
    case 'buku':
        include 'controllers/BukuController.php';
        break;
    case 'anggota':
        include 'controllers/AnggotaController.php';
        break;
    case 'transaksi':
        include 'controllers/TransaksiController.php';
        break;
    default:
        include 'controllers/DashboardController.php';
        break;
}
?>