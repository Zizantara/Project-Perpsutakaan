<?php
if (!defined('BASE_URL')) {
    define('BASE_URL', 'http://localhost/perpustakaan2/');
}

if ($aksi == 'login') {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $q = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
        
        if (mysqli_num_rows($q) > 0) {
            $d = mysqli_fetch_assoc($q);
            $_SESSION['login'] = true;
            $_SESSION['id_user'] = $d['id_user'];
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $d['role'];
            
            if($d['role'] == 'user'){
                $da = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM anggota WHERE id_user='$d[id_user]'"));
                if($da){
                    $_SESSION['id_anggota'] = $da['id_anggota'];
                    $_SESSION['nama_anggota'] = $da['nama_anggota'];
                    $_SESSION['alamat'] = $da['alamat'];
                    $_SESSION['email'] = $da['email'];
                    $_SESSION['no_telp'] = $da['no_telp'];
                }
            }
            
            header("Location: " . BASE_URL . "dashboard");
            exit;

        } else {
            $error = "Username/Password Salah";
            include 'views/auth/login.php';
        }
    } else {
        include 'views/auth/login.php';
    }
} 
elseif ($aksi == 'register') {
    if(isset($_POST['daftar'])){
        $nama = $_POST['nama']; $user = $_POST['username']; 
        $pass = md5($_POST['password']); $alamat = $_POST['alamat'];
        
        mysqli_query($conn, "INSERT INTO users (username, password, role) VALUES ('$user','$pass','user')");
        $id_new = mysqli_insert_id($conn);
        
        mysqli_query($conn, "INSERT INTO anggota (id_user, nama_anggota, alamat) VALUES ('$id_new','$nama','$alamat')");
        
        echo "<script>alert('Berhasil daftar, silakan login'); location.href='" . BASE_URL . "auth/login';</script>";
    } else {
        include 'views/auth/register.php';
    }
}
elseif ($aksi == 'logout') {
    session_destroy();
    header("Location: " . BASE_URL . "auth/login");
    exit;
}
?>