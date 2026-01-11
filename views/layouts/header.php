<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Perpus MVC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="<?= BASE_URL ?>dashboard">
          <i class="fas fa-book-reader me-2"></i>E-PERPUS
      </a>
      
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
              <a class="nav-link" href="<?= BASE_URL ?>dashboard"><i class="fas fa-home me-1"></i> Dashboard</a>
          </li>

          <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin') { ?>
              <li class="nav-item">
                  <a class="nav-link" href="<?= BASE_URL ?>buku"><i class="fas fa-book me-1"></i> Kelola Buku</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="<?= BASE_URL ?>anggota"><i class="fas fa-users me-1"></i> Kelola Anggota</a>
              </li>
          <?php } elseif(isset($_SESSION['role']) && $_SESSION['role'] == 'user') { ?>
              <li class="nav-item">
                  <a class="nav-link" href="<?= BASE_URL ?>transaksi/riwayat"><i class="fas fa-history me-1"></i> Riwayat</a>
              </li>
          <?php } ?>
        </ul>
        
        <?php if(isset($_SESSION['login'])) { ?>
            <span class="navbar-text text-white me-3">Halo, <b><?= $_SESSION['username'] ?></b></span>
            <a href="<?= BASE_URL ?>auth/logout" class="btn btn-danger btn-sm"><i class="fas fa-sign-out-alt"></i> Logout</a>
        <?php } ?>
      </div>
    </div>
  </nav>
<div class="container">