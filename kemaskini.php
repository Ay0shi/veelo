<?php
session_start();
include 'config.php';
include 'sidebar.php';

if (!isset($_GET['id'])) {
  echo "ID tidak sah.";
  exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM borangsewa WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
  echo "Data tidak dijumpai.";
  exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nama = $_POST['nama'];
  $no_telefon = $_POST['no_telefon'];
  $jenis_basikal = $_POST['jenis_basikal'];
  $tempoh_sewa = $_POST['tempoh_sewa'];
  $tarikh = $_POST['tarikh'];
  $masa = $_POST['masa'];
  $catatan = $_POST['catatan'];
  $jumlah_harga = $_POST['jumlah_harga'];
  $status = $_POST['status'];

  $previousStatus = $data['status'];
  if ($status === "Disahkan" && $previousStatus !== "Disahkan") {
      $bilangan = $data['bilangan'];

      // Semak unit yang ada
      $semakSql = "SELECT unit FROM status_basikal WHERE nama = ?";
      $stmtSemak = $conn->prepare($semakSql);
      $stmtSemak->bind_param("s", $jenis_basikal);
      $stmtSemak->execute();
      $resultSemak = $stmtSemak->get_result();
      $stok = $resultSemak->fetch_assoc();

      // Jika tiada data stok — anggap 0
      $unitAda = $stok ? intval($stok['unit']) : 0;

      if ($unitAda >= $bilangan) {
          // Tolak stok
          $updateUnitSql = "UPDATE status_basikal SET unit = unit - ? WHERE nama = ?";
          $stmtUnit = $conn->prepare($updateUnitSql);
          $stmtUnit->bind_param("is", $bilangan, $jenis_basikal);
          $stmtUnit->execute();
      } else {
          echo "<script>alert('Unit tidak mencukupi untuk disahkan!'); window.history.back();</script>";
          exit;
      }
  }

  // Kemaskini tempahan
  $sqlUpdate = "UPDATE borangsewa SET nama=?, no_telefon=?, jenis_basikal=?, tempoh_sewa=?, tarikh=?, masa=?, catatan=?, jumlah_harga=?, status=? WHERE id=?";
  $stmtUpdate = $conn->prepare($sqlUpdate);
  $stmtUpdate->bind_param("sssssssssi", $nama, $no_telefon, $jenis_basikal, $tempoh_sewa, $tarikh, $masa, $catatan, $jumlah_harga, $status, $id);

  if ($stmtUpdate->execute()) {
    echo "<script>alert('Data berjaya dikemaskini.'); window.location.href='admin_dashboard.php';</script>";
    exit;
  } else {
    echo "<script>alert('Ralat semasa mengemaskini.');</script>";
  }
}
?>


<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <title>Kemaskini Tempahan</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #fdfaf6;
      margin: 0;
      padding: 0;
    }

    section {
      max-width: 700px;
      margin: 3rem auto;
      background-color: #fff;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }

    h2 {
      color: #445735;
      margin-bottom: 1.5rem;
      text-align: center;
    }

    form label {
      display: block;
      margin-top: 1rem;
      font-weight: 500;
      color: #3d3d3d;
    }

    form input, form select, form textarea {
      width: 100%;
      padding: 10px 14px;
      margin-top: 6px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-family: inherit;
    }

    form textarea {
      resize: vertical;
    }

    .form-buttons {
      margin-top: 2rem;
      display: flex;
      justify-content: flex-end;
      gap: 10px;
    }

    button {
      background-color: #445735;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      font-size: 14px;
      cursor: pointer;
      font-family: inherit;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #5e7b48;
    }

    .btn-batal {
      background-color: #bc6c25;
    }

    .btn-batal:hover {
      background-color: #a45d1d;
    }
  </style>
</head>
<body>

<section>
  <h2>Kemaskini Tempahan</h2>
  <form method="post">
    <label>Nama</label>
    <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>

    <label>No Telefon</label>
    <input type="text" name="no_telefon" value="<?= htmlspecialchars($data['no_telefon']) ?>" required>

    <label>Jenis Basikal</label>
    <select name="jenis_basikal" required>
      <option value="mountain" <?= $data['jenis_basikal'] == 'mountain' ? 'selected' : '' ?>>Mountain Bike</option>
      <option value="city" <?= $data['jenis_basikal'] == 'city' ? 'selected' : '' ?>>City Bike</option>
      <option value="electric" <?= $data['jenis_basikal'] == 'electric' ? 'selected' : '' ?>>Electric Bike</option>
    </select>

    <label>Tempoh Sewa</label>
    <input type="text" name="tempoh_sewa" value="<?= htmlspecialchars($data['tempoh_sewa']) ?>" required>

    <label>Tarikh</label>
    <input type="date" name="tarikh" value="<?= $data['tarikh'] ?>" required>

    <label>Masa</label>
    <input type="text" name="masa" value="<?= htmlspecialchars($data['masa']) ?>" required>

    <label>Catatan</label>
    <textarea name="catatan"><?= htmlspecialchars($data['catatan']) ?></textarea>

    <label>Jumlah Harga (RM)</label>
    <input type="text" name="jumlah_harga" value="<?= $data['jumlah_harga'] ?>" required>

    <label>Status</label>
    <select name="status" required>
      <option value="Diproses" <?= $data['status'] == 'Diproses' ? 'selected' : '' ?>>Diproses</option>
      <option value="Disahkan" <?= $data['status'] == 'Disahkan' ? 'selected' : '' ?>>Disahkan</option>
      <option value="Dibatalkan" <?= $data['status'] == 'Dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
    </select>

    <div class="form-buttons">
      <button type="submit">Simpan</button>
      <button type="button" class="btn-batal" onclick="batal()">Batal</button>
    </div>
  </form>
</section>

<script>
  function batal() {
    if (confirm("Batalkan dan kembali ke dashboard?")) {
      window.location.href = "admin_dashboard.php";
    }
  }
</script>

</body>
</html>
