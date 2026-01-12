<?php
class Database {
    private $host = "localhost:3306";
    private $user = "zizc2973_root";
    private $pass = "zizan2410";
    private $db   = "izc2973_perpustakaan";
    public $conn;

    public function __construct() {
        $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        if (mysqli_connect_errno()) {
            echo "Koneksi database gagal: " . mysqli_connect_error();
            exit();
        }
    }
}
?>