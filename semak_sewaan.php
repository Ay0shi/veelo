<?php
include 'config.php';

$id = $_GET['id'] ?? null;
if (!$id) {
  echo "ID tidak sah.";
  exit;
}

$stmt = $conn->prepare("SELECT * FROM borangsewa WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

if (!$data) {
  echo "Data tidak dijumpai.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <title>Resit Sewaan</title>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Quicksand', sans-serif;
      background-color: #fdfaf6;
      margin: 0;
      padding: 0;
    }

    .container {
      width: 794px;
      margin: 2rem auto;
      background-color: #fff;
      padding: 3rem;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
      
    }

    h2 {
      text-align: center;
      color: #445735;
      margin-bottom: 2rem;
    }

    .alert {
      border-left: 6px solid;
      padding: 1.2rem;
      font-size: 1.15rem;
      margin-bottom: 2rem;
      border-radius: 10px;
      animation: fadeIn 0.6s ease-out;
    }

    .alert.pink {
      background-color: #ffe4e6;
      color: #9f1239;
      border-color: #f43f5e;
    }

    .alert.yellow {
      background-color: #fef9c3;
      color: #92400e;
      border-color: #facc15;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .resit-wrapper {
      border: 2px solid #a67c52;
      padding: 35px;
      border-radius: 10px;
      background-color: #fffaf4;
      color: #333;
    }

    .resit-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 2rem;
    }

    .resit-logo {
      max-height: 65px;
    }

    .resit-section {
      margin-bottom: 1.8rem;
    }

    .resit-section h4 {
      margin-bottom: 0.5rem;
      color: #445735;
    }

    .resit-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
    }

    .resit-table th, .resit-table td {
      border: 1px solid #ccc;
      padding: 10px;
      font-size: 15px;
      text-align: left;
    }

    .resit-footer {
      margin-top: 3rem;
      font-size: 0.9rem;
      text-align: center;
      color: #666;
    }

    .btn-print, .btn-back {
      margin-top: 1.8rem;
      padding: 10px 20px;
      background-color: #445735;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 14px;
      transition: 0.3s;
      margin-right: 10px;
    }

    .btn-print:hover, .btn-back:hover {
      background-color: #5e7b48;
    }

    .btn-group {
      text-align: center;
      margin-top: 1rem;
    }

    .btn-back {
      background-color: #a67c52;
    }

    .btn-back:hover {
      background-color: #bc6c25;
    }

    a.btn-back {
      text-decoration: none;
      display: inline-block;
    }
    @media print {
  body, html {
    margin: 0;
    padding: 0;
  }
}

  </style>
</head>
<body>
  <div class="container">
    <h2>Semakan Resit Sewaan</h2>

    <?php if ($data['status'] === 'Disahkan'): ?>
      <div id="resit" class="resit-wrapper">
        <div class="resit-header">
          <img src="img/logoveelo2.png" class="resit-logo" alt="Logo">
          <div style="text-align: right;">
            <div><strong>No. Resit:</strong> SEWA<?= $data['id'] ?></div>
            <div><strong>Tarikh:</strong> <?= $data['tarikh'] ?></div>
          </div>
        </div>

        <div class="resit-section">
          <b><h4>MAKLUMAT PENYEWA</h4></b>
          <p><strong>Nama:</strong> <?= htmlspecialchars($data['nama']) ?></p>
          <p><strong>No. Telefon:</strong> <?= htmlspecialchars($data['no_telefon']) ?></p>
        </div>

        <div class="resit-section">
          <h4>Butiran Sewaan</h4>
          <table class="resit-table">
            <thead>
              <tr>
                <th>Item</th>
                <th>Tempoh</th>
                <th>Masa</th>
                <th>Catatan</th>
                <th>Jumlah (RM)</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?= htmlspecialchars($data['jenis_basikal']) ?></td>
                <td><?= htmlspecialchars($data['tempoh_sewa']) ?> jam</td>
                <td><?= htmlspecialchars($data['masa']) ?></td>
                <td><?= htmlspecialchars($data['catatan']) ?></td>
                <td><?= number_format($data['jumlah_harga'], 2) ?></td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <th colspan="4" style="text-align: right;">Jumlah Keseluruhan</th>
                <th>RM <?= number_format($data['jumlah_harga'], 2) ?></th>
              </tr>
            </tfoot>
          </table>
        </div>

        <div class="resit-footer">
          Resit ini dikeluarkan oleh Veelo Sdn. Bhd. - Taman Botani Putrajaya.
        </div>
      </div>

      <div class="btn-group">
        <button id="btnDownloadPDF" class="btn-print">📄 Muat Turun PDF</button>
        <button id="btnDownloadIMG" class="btn-print">🖼️ Muat Turun Imej</button>
        <a href="sewa.php" class="btn-back">← Kembali ke Halaman Utama</a>
      </div>

    <?php elseif ($data['status'] === 'Dibatalkan'): ?>
      <div class="alert pink">❌ Maaf, tempahan anda telah dibatalkan oleh pihak pengurusan.</div>
      <div class="btn-group">
        <a href="sewa.php" class="btn-back">← Kembali ke Halaman Utama</a>
      </div>

    <?php elseif ($data['status'] === 'Diproses'): ?>
      <div class="alert yellow">⚠️ Tempahan anda masih diproses. Sila semak semula kemudian.</div>
      <div class="btn-group">
        <a href="sewa.php" class="btn-back">← Kembali ke Halaman Utama</a>
      </div>

    <?php else: ?>
      <p>Status tidak dikenali.</p>
    <?php endif; ?>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
  // Bersihkan nama untuk fail
  const namaPenyewa = <?= json_encode(trim(preg_replace('/[^A-Za-z0-9\s]/', '', $data['nama']))) ?>;
  const namaFail = "Resit Tempahan " + namaPenyewa;

  document.getElementById("btnDownloadPDF")?.addEventListener("click", function () {
    const element = document.getElementById("resit");

    const opt = {
      margin:       [0, 0, 0, 0],
      filename:     namaFail + ".pdf",
      image:        { type: 'jpeg', quality: 0.98 },
      html2canvas:  { scale: 3, useCORS: true, logging: false },
      jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
    };

    html2pdf().set(opt).from(element).save();
  });

  document.getElementById("btnDownloadIMG")?.addEventListener("click", function () {
    const element = document.getElementById("resit");
    html2canvas(element, { scale: 3 }).then(function (canvas) {
      const link = document.createElement('a');
      link.download = namaFail + ".png";
      link.href = canvas.toDataURL("image/png");
      link.click();
    });
  });
</script>

</body>
</html>
