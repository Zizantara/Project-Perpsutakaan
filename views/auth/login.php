<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login E-Perpus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    
    <div class="card shadow" style="width: 400px; border: none;">
        <div class="card-header bg-primary text-white text-center py-3">
            <h4 class="mb-0 fw-bold">LOGIN APLIKASI</h4>
        </div>
        <div class="card-body p-4">
            
            <?php if(isset($error)) { ?>
                <div class="alert alert-danger text-center" role="alert">
                    <?= $error ?>
                </div>
            <?php } ?>

            <form action="<?= BASE_URL ?>auth/login" method="post">
                <div class="mb-3">
                    <label class="form-label text-muted">Username</label>
                    <input type="text" name="username" class="form-control" required autofocus>
                </div>
                <div class="mb-4">
                    <label class="form-label text-muted">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary w-100 py-2 fw-bold">Masuk Sekarang</button>
            </form>

            <div class="text-center mt-4 pt-3 border-top">
                <small class="text-muted">Belum punya akun?</small><br>
                
                <a href="<?= BASE_URL ?>auth/register" class="btn btn-outline-success btn-sm mt-2">Daftar Anggota Baru</a>
            </div>
        </div>
    </div>

</body>
</html>