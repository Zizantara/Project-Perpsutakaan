<?php if($_SESSION['role'] == 'admin') { ?>
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">Dashboard Admin</h2>
        <p class="text-muted">Selamat datang di panel pengelolaan perpustakaan.</p>
    </div>

    <div class="row justify-content-center mb-4">
        <div class="col-md-5">
            <div class="card p-4 shadow-sm border-0 text-center h-100">
                <div class="card-body">
                    <i class="fas fa-book fa-3x text-primary mb-3"></i>
                    <h4>Kelola Buku</h4>
                    <a href="<?= BASE_URL ?>buku" class="btn btn-primary mt-2">Buka Menu Buku</a>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card p-4 shadow-sm border-0 text-center h-100">
                <div class="card-body">
                    <i class="fas fa-users fa-3x text-success mb-3"></i>
                    <h4>Kelola Anggota</h4>
                    <a href="<?= BASE_URL ?>anggota" class="btn btn-success mt-2">Buka Menu Anggota</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-warning fw-bold">
            <i class="fas fa-clock me-1"></i> Peminjaman Aktif (Perlu Konfirmasi)
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark"><tr><th>Peminjam</th><th>Buku</th><th>Tgl Pinjam</th><th>Aksi</th></tr></thead>
                    <tbody>
                    <?php
                    $q = mysqli_query($conn, "SELECT t.*, a.nama_anggota, b.judul FROM transaksi t JOIN anggota a ON t.id_anggota=a.id_anggota JOIN buku b ON t.id_buku=b.id_buku WHERE t.status='pinjam'");
                    if(mysqli_num_rows($q) > 0){
                        while($d = mysqli_fetch_array($q)){
                            echo "<tr>
                                    <td>$d[nama_anggota]</td>
                                    <td>$d[judul]</td>
                                    <td>$d[tgl_pinjam]</td>
                                    <td><a href='".BASE_URL."transaksi/kembali/$d[id_transaksi]' class='btn btn-sm btn-success' onclick=\"return confirm('Kembalikan?')\">Proses Kembali</a></td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='text-center text-muted'>Tidak ada peminjaman aktif.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php } else { ?>
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm border-primary">
                <div class="card-header bg-primary text-white fw-bold">
                    <i class="fas fa-edit me-1"></i> Form Peminjaman
                </div>
                <div class="card-body">
                    <?php if(isset($_GET['pesan']) && $_GET['pesan']=='sukses') echo "<div class='alert alert-success'>Berhasil Pinjam!</div>"; ?>
                    
                    <form action="<?= BASE_URL ?>transaksi/pinjam_user" method="post">
                        <input type="hidden" name="id_anggota" value="<?=$_SESSION['id_anggota']?>">
                        
                        <div class="mb-2">
                            <label class="small text-muted">Nama Peminjam</label>
                            <input type="text" value="<?=$_SESSION['nama_anggota']?>" class="form-control bg-light" readonly>
                        </div>
                        
                        <div class="mb-3">
                             <label class="small text-muted fw-bold">Judul Buku</label>
                             <select name="id_buku" class="form-select" required>
                                <option value="">-- Pilih Buku --</option>
                                <?php 
                                mysqli_data_seek($query_buku, 0); 
                                
                                while($b=mysqli_fetch_array($query_buku)){ 
                                    $selected = (isset($_GET['id_buku']) && $_GET['id_buku'] == $b['id_buku']) ? 'selected' : '';
                                    
                                    $disabled = ($b['stok'] == 0) ? 'disabled' : '';
                                    $ket_stok = ($b['stok'] == 0) ? '(HABIS)' : '';
                                    
                                    echo "<option value='$b[id_buku]' $selected $disabled>$b[judul] $ket_stok</option>";
                                } 
                                ?>
                             </select>
                        </div>

                        <hr>
                        <div class="mb-2">
                            <label class="small text-muted">Email</label>
                            <input type="email" name="email" value="<?=$_SESSION['email']?>" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label class="small text-muted">No HP</label>
                            <input type="number" name="no_telp" value="<?=$_SESSION['no_telp']?>" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label class="small text-muted">Alamat</label>
                            <textarea name="alamat" class="form-control" required><?=$_SESSION['alamat']?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="small text-muted fw-bold">Rencana Kembali</label>
                            <input type="date" name="tgl_rencana" class="form-control" min="<?= date('Y-m-d') ?>" required>
                        </div>
                        <button class="btn btn-primary w-100">Pinjam Sekarang</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            
            <div class="card mb-3 shadow-sm border-0">
                <div class="card-body p-2">
                    <form action="<?= BASE_URL ?>dashboard" method="GET" class="d-flex gap-2">
                        <input type="text" name="cari" class="form-control border-0 bg-light" placeholder="Cari judul buku atau penulis..." value="<?= isset($_GET['cari']) ? $_GET['cari'] : '' ?>">
                        <button class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
                    </form>
                </div>
            </div>

            <div class="row">
                <?php 
                mysqli_data_seek($query_buku, 0);
                
                if(mysqli_num_rows($query_buku) > 0) {
                    while($row = mysqli_fetch_array($query_buku)) { 
                ?>
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="card-title fw-bold text-primary"><?= $row['judul'] ?></h5>
                                <p class="text-muted small mb-2">
                                    <i class="fas fa-user me-1"></i> <?= $row['penulis'] ?> <br>
                                    <i class="fas fa-calendar me-1"></i> <?= $row['tahun_terbit'] ?>
                                </p>
                                
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="badge <?= ($row['stok']>0)?'bg-success':'bg-danger'; ?>">
                                        Stok: <?= $row['stok'] ?>
                                    </span>
                                    
                                    <?php if($row['stok'] > 0) { ?>
                                        <a href="<?= BASE_URL ?>dashboard?id_buku=<?= $row['id_buku'] ?>&cari=<?= isset($_GET['cari']) ? $_GET['cari'] : '' ?>" class="btn btn-sm btn-outline-primary">
                                            Pilih <i class="fas fa-arrow-left"></i>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php 
                    }
                } else {
                    echo "<div class='col-12'><div class='alert alert-warning'>Buku tidak ditemukan.</div></div>";
                }
                ?>
            </div>
        </div>
    </div>
<?php } ?>