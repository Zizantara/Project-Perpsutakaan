<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Anggota Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="min-height: 100vh;">

    <div class="card shadow my-5" style="width: 450px; border: none;">
        <div class="card-header bg-success text-white text-center py-3">
            <h4 class="mb-0 fw-bold">REGISTRASI ANGGOTA</h4>
        </div>
        <div class="card-body p-4">
            
            <form action="<?= BASE_URL ?>auth/register" method="post">
                <div class="mb-3">
                    <label class="form-label text-muted">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama sesuai KTP" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-muted">Alamat Lengkap</label>
                    <textarea name="alamat" class="form-control" rows="2" placeholder="Alamat tempat tinggal" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Username (untuk Login)</label>
                    <input type="text" name="username" class="form-control" placeholder="Buat username unik" required>
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Buat password" required>
                </div>

                <button type="submit" name="daftar" class="btn btn-success w-100 py-2 fw-bold">Daftar Sekarang</button>
            </form>

            <div class="text-center mt-4">
                <small>Sudah punya akun? <a href="<?= BASE_URL ?>auth/login" class="text-decoration-none fw-bold">Login disini</a></small>
            </div>
        </div>
    </div>

</body>
</html>