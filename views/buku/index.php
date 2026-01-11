<div class="card mb-4 shadow-sm">
    <div class="card-header fw-bold bg-primary text-white">
        <i class="fas fa-book me-1"></i> Form Kelola Buku
    </div>
    <div class="card-body">
        <form action="<?= BASE_URL ?>buku/simpan" method="POST">
            <?php if(isset($data_edit)) echo "<input type='hidden' name='id_buku' value='$data_edit[id_buku]'>"; ?>
            
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Judul Buku</label>
                    <input type="text" name="judul" class="form-control" placeholder="Masukkan Judul" value="<?= @$data_edit['judul'] ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Penulis</label>
                    <input type="text" name="penulis" class="form-control" placeholder="Nama Penulis" value="<?= @$data_edit['penulis'] ?>" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-bold">Tahun</label>
                    <input type="number" name="tahun" class="form-control" placeholder="Tahun" value="<?= @$data_edit['tahun_terbit'] ?>" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-bold">Stok</label>
                    <input type="number" name="stok" class="form-control" placeholder="0" value="<?= @$data_edit['stok'] ?>" required>
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button class="btn btn-success w-100" type="submit">
                        <i class="fas fa-save"></i> Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-white fw-bold">
        <i class="fas fa-list me-1"></i> Daftar Koleksi Buku
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Tahun</th> <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    if(mysqli_num_rows($query_buku) > 0) {
                        while($r = mysqli_fetch_array($query_buku)){ 
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $r['judul'] ?></td>
                        <td><?= $r['penulis'] ?></td>
                        <td><?= $r['tahun_terbit'] ?></td> <td>
                             <span class="badge <?= ($r['stok'] > 0) ? 'bg-success' : 'bg-danger' ?>">
                                <?= $r['stok'] ?>
                            </span>
                        </td>
                        <td>
                            <a href="<?= BASE_URL ?>buku/edit/<?= $r['id_buku'] ?>" class="btn btn-warning btn-sm text-white"><i class="fas fa-edit"></i></a>
                            <a href="<?= BASE_URL ?>buku/hapus/<?= $r['id_buku'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php 
                        } 
                    } else {
                        echo "<tr><td colspan='6' class='text-center text-muted'>Belum ada data buku.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>