<div class="card mb-4 shadow-sm">
    <div class="card-header bg-success text-white fw-bold">
        <i class="fas fa-user-edit me-1"></i> Form Kelola Anggota
    </div>
    <div class="card-body">
        <form action="<?= BASE_URL ?>anggota/simpan" method="POST">
            <?php if(isset($data_edit)) echo "<input type='hidden' name='id_anggota' value='$data_edit[id_anggota]'>"; ?>
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama Anggota" value="<?= @$data_edit['nama_anggota'] ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Alamat</label>
                    <input type="text" name="alamat" class="form-control" placeholder="Alamat Domisili" value="<?= @$data_edit['alamat'] ?>" required>
                </div>
                
                <div class="col-12 text-end">
                     <?php if(isset($data_edit)) { ?>
                        <a href="<?= BASE_URL ?>anggota" class="btn btn-secondary me-1">Batal Edit</a>
                    <?php } ?>
                    <button class="btn btn-success" type="submit">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center">
        <span><i class="fas fa-users me-1"></i> Daftar Anggota</span>
        <form action="<?= BASE_URL ?>anggota" method="GET" class="d-flex" style="width: 250px;">
            <input type="text" name="cari" class="form-control form-control-sm me-2" placeholder="Cari Nama..." value="<?= isset($_GET['cari']) ? $_GET['cari'] : '' ?>">
            <button class="btn btn-sm btn-outline-success"><i class="fas fa-search"></i></button>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-success">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Anggota</th>
                        <th>Username (Login)</th>
                        <th>Alamat</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1; 
                    if(isset($query_anggota) && mysqli_num_rows($query_anggota) > 0) {
                        while($r = mysqli_fetch_array($query_anggota)){ 
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td class="fw-bold"><?= $r['nama_anggota'] ?></td>
                        <td><span class="badge bg-secondary"><?= $r['username'] ?></span></td>
                        <td><?= $r['alamat'] ?></td>
                        <td>
                            <a href="<?= BASE_URL ?>anggota/edit/<?= $r['id_anggota'] ?>" class="btn btn-warning btn-sm text-white"><i class="fas fa-edit"></i></a>
                            <a href="<?= BASE_URL ?>anggota/hapus/<?= $r['id_anggota'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus user ini?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php 
                        } 
                    } else {
                        echo "<tr><td colspan='5' class='text-center text-muted'>Data tidak ditemukan.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>