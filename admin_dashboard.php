<?php
session_start();
include 'sidebar.php';
include 'config.php';

$sql = "SELECT * FROM borangsewa ORDER BY tarikh DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>

<div class="main-content">
  <section class="data-section">
    <h2>Senarai Tempahan</h2>
    <table class="data-table">
      <thead>
        <tr>
          <th>Nama</th>
          <th>No Telefon</th>
          <th>Jenis Basikal</th>
          <th>Tempoh Sewa</th>
          <th>Tarikh</th>
          <th>Masa</th>
          <th>Catatan</th>
          <th>Jumlah Harga (RM)</th>
          <th>Status</th>
          <th>Tindakan</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result->num_rows > 0): ?>
          <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td><?= htmlspecialchars($row['no_telefon']) ?></td>
            <td><?= htmlspecialchars($row['jenis_basikal']) ?></td>
            <td><?= htmlspecialchars($row['tempoh_sewa']) ?></td>
            <td><?= htmlspecialchars($row['tarikh']) ?></td>
            <td><?= htmlspecialchars($row['masa']) ?></td>
            <td><?= htmlspecialchars($row['catatan']) ?></td>
            <td><?= number_format($row['jumlah_harga'], 2) ?></td>
            <td><?= htmlspecialchars($row['status']) ?></td>
            
              <td>
  <div class="tindakan-btn">
    <a href="kemaskini.php?id=<?= $row['id'] ?>">
      <button class="btn-update">Kemaskini</button>
    </a>
    <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirmHapus('<?= $row['nama'] ?>')">
  <button class="btn-delete">Hapus</button>
</a>




    </a>
  </div>
</td>


          </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="10">Tiada data ditemui.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </section>
</div>

<script src="admin_dashboard.js"></script>
</body>
</html>
