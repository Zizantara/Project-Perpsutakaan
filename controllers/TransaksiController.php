<?php
if (!defined('BASE_URL')) {
    die("Akses langsung ditolak");
}

global $conn;

if ($aksi == 'pinjam_user') {
    $id_buku = $_POST['id_buku'];
    $id_anggota = $_POST['id_anggota'];
    $tgl_pinjam = date('Y-m-d');
    
    $email = $_POST['email'];
    $no_telp = $_POST['no_telp'];
    $alamat = $_POST['alamat'];
    $tgl_rencana = $_POST['tgl_rencana'];

    mysqli_query($conn, "UPDATE anggota SET email='$email', no_telp='$no_telp', alamat='$alamat' WHERE id_anggota='$id_anggota'");
    
    $_SESSION['email'] = $email;
    $_SESSION['no_telp'] = $no_telp;
    $_SESSION['alamat'] = $alamat;

    $cek = mysqli_query($conn, "SELECT stok FROM buku WHERE id_buku='$id_buku'");
    $d = mysqli_fetch_assoc($cek);

    if ($d['stok'] > 0) {
        mysqli_query($conn, "UPDATE buku SET stok = stok - 1 WHERE id_buku='$id_buku'");
        
        $q = mysqli_query($conn, "INSERT INTO transaksi (id_buku, id_anggota, tgl_pinjam, tgl_rencana, status) 
                                  VALUES ('$id_buku', '$id_anggota', '$tgl_pinjam', '$tgl_rencana', 'pinjam')");
        
        header("Location: " . BASE_URL . "dashboard?pesan=sukses");
        exit;
    } else {
        header("Location: " . BASE_URL . "dashboard?pesan=stok_habis");
        exit;
    }
}

elseif ($aksi == 'kembali') {
    if(isset($_GET['id'])) {
        $id_transaksi = $_GET['id'];
        $tgl_kembali = date('Y-m-d');

        $q = mysqli_query($conn, "SELECT * FROM transaksi WHERE id_transaksi='$id_transaksi'");
        $dt = mysqli_fetch_assoc($q);
        
        if($dt) {
            $tgl_p = new DateTime($dt['tgl_pinjam']);
            $tgl_k = new DateTime($tgl_kembali);
            $jarak = $tgl_p->diff($tgl_k);
            $hari  = $jarak->days;
            
            $denda = 0;
            if($hari > 7) {
                $denda = ($hari - 7) * 1000;
            }

            mysqli_query($conn, "UPDATE transaksi SET tgl_kembali='$tgl_kembali', status='kembali', denda='$denda' WHERE id_transaksi='$id_transaksi'");
            
            $id_buku = $dt['id_buku'];
            mysqli_query($conn, "UPDATE buku SET stok = stok + 1 WHERE id_buku='$id_buku'");
            
            header("Location: " . BASE_URL . "dashboard?pesan=kembali&denda=$denda");
            exit;
        }
    }
    header("Location: " . BASE_URL . "dashboard");
    exit;
}

elseif ($aksi == 'riwayat') {
    if($_SESSION['role'] != 'user'){
        header("Location: " . BASE_URL . "dashboard");
        exit;
    }

    $id_anggota = $_SESSION['id_anggota'];
    
    $query_riwayat = mysqli_query($conn, "SELECT t.*, b.judul 
                                          FROM transaksi t 
                                          JOIN buku b ON t.id_buku = b.id_buku 
                                          WHERE t.id_anggota='$id_anggota' 
                                          ORDER BY t.id_transaksi DESC");

    include 'views/layouts/header.php';
    include 'views/transaksi/riwayat.php';
    include 'views/layouts/footer.php';
}
?>