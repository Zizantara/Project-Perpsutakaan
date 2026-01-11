<div class="card">
    <div class="card-header bg-primary text-white">Riwayat Peminjaman Saya</div>
    <div class="card-body">
        <table class="table table-striped">
            <thead><tr><th>Buku</th><th>Pinjam</th><th>Kembali</th><th>Status</th><th>Denda</th></tr></thead>
            <tbody>
                <?php while($r=mysqli_fetch_array($query_riwayat)){ ?>
                <tr>
                    <td><?=$r['judul']?></td>
                    <td><?=$r['tgl_pinjam']?></td>
                    <td><?=$r['tgl_kembali']?></td>
                    <td><?=$r['status']?></td>
                    <td><?=$r['denda']?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>