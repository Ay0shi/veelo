<?php
session_start();
include 'config.php';

$status_link = ""; // default kosong

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $jenis_basikal = $_POST['jenis_basikal'];

    // Semak stok untuk jenis basikal yang dipilih
    $stmt = $conn->prepare("SELECT unit FROM status_basikal WHERE nama = ?");
    $stmt->bind_param("s", $jenis_basikal);
    $stmt->execute();
    $result = $stmt->get_result();
    $stok = $result->fetch_assoc();
    $stmt->close();

    if (!$stok || $stok['unit'] <= 0) {
        echo "<script>alert('Maaf, stok untuk $jenis_basikal telah habis. Sila pilih jenis lain.'); window.history.back();</script>";
        exit();
    }

    // Proses insert tempahan seperti biasa
    $nama = $_POST['nama'];
    $no_telefon = $_POST['no_telefon'];
    $tempoh_sewa = $_POST['tempoh_sewa'];
    $tarikh = $_POST['tarikh'];
    $masa = $_POST['masa'];
    $catatan = $_POST['catatan'];
    $jumlah_harga = $_POST['jumlah_harga'];

    $stmt = $conn->prepare("INSERT INTO borangsewa (nama, no_telefon, jenis_basikal, tempoh_sewa, tarikh, masa, catatan, jumlah_harga, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Diproses')");
    $stmt->bind_param("ssssssss", $nama, $no_telefon, $jenis_basikal, $tempoh_sewa, $tarikh, $masa, $catatan, $jumlah_harga);

    if ($stmt->execute()) {
        $id = $conn->insert_id;
        $_SESSION['sewaan_id'] = $id;
        $_SESSION['nama_penyewa'] = $nama;
        echo "<script>window.location.href = 'sewa.php';</script>";
        exit;
    } else {
        echo "<script>alert('Ralat semasa menghantar sewaan.');</script>";
    }

    $stmt->close();
}

// Ambil senarai basikal & unit
$unit_data = [];
$sql = "SELECT nama, unit FROM status_basikal";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $unit_data[$row['nama']] = $row['unit'];
    }
}
?>



<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Sewa Basikal</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Poppins&display=swap" rel="stylesheet">
  <style>
    .toast {
  position: fixed;
  top: 20px;
  right: 20px;
  background-color: #a67c52;
  color: white;
  padding: 1rem 1.5rem;
  border-radius: 12px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.2);
  z-index: 9999;
  display: flex;
  align-items: center;
  justify-content: space-between;
  min-width: 280px;
  max-width: 400px;
  gap: 10px;
  animation: slideIn 0.5s ease;
}

.toast a {
  background-color: #445735;
  color: white;
  padding: 6px 12px;
  border-radius: 6px;
  text-decoration: none;
  font-weight: 600;
  margin-top: 8px;
  display: inline-block;
}

.toast a:hover {
  background-color: #5e7b48;
}

.close-toast {
  background: none;
  border: none;
  color: white;
  font-size: 18px;
  font-weight: bold;
  cursor: pointer;
  margin-left: auto;
}

@keyframes slideIn {
  from { transform: translateX(150%); opacity: 0; }
  to { transform: translateX(0); opacity: 1; }
}

    </style>
</head>
<body class="sewa-page">
  <?php include 'navbar.php'; // Memanggil navbar ?>
  <?php if (isset($_SESSION['sewaan_id']) && isset($_SESSION['nama_penyewa'])): ?>
<div class="toast" id="notiToast">
  <div>
    Terima kasih, <strong><?= htmlspecialchars($_SESSION['nama_penyewa']) ?></strong>! 👋<br>
    Sila semak status sewaan anda:
    <a href="semak_sewaan.php?id=<?= $_SESSION['sewaan_id'] ?>">📄 Semak Status</a>
  </div>
  <button class="close-toast" onclick="tutupNoti()">×</button>
</div>
<?php endif; ?>

  <div class="banner">
  <img src="img/banner.png" alt="Pilih Basikal" class="banner-img">
</div>
    <br>
    <br>
  <section id="portfolio" class="bike-section">
<div class="main-content">
  <h1>Jenis Basikal & Harga Sewaan</h1>
  <br>
  <div class="bike-grid">
    
    <!-- Kad Basikal 1 -->
    <div class="bike-card">
      <img src="img/b1.jpg" alt="Basikal Biasa" class="bike-image">
      <div class="bike-details">
        <h3>Basikal Biasa</h3>
        <p>Kapasiti: 1 orang</p>
        <p>Harga: RM5/jam</p>
        <p class="unit-left" data-units="<?= $unit_data['Basikal Biasa'] ?? 0 ?>">
          Unit tersedia: <span class="unit-count"><?= $unit_data['Basikal Biasa'] ?? 0 ?></span>
        </p>
<button class="button-info"
  onclick="openModal('Basikal Biasa', 'img/b1.jpg', 'Basikal Biasa sesuai untuk remaja & dewasa. Rangka ringan dan mudah dikendalikan, ideal untuk kegunaan santai.')">
  Maklumat
</button>
      </div>
    </div>

    <!-- Kad Basikal 2 -->
    <div class="bike-card">
      <img src="img/b2.jpg" alt="Basikal Comfort" class="bike-image">
      <div class="bike-details">
        <h3>Basikal Comfort</h3>
        <p>Kapasiti: 1 orang</p>
        <p>Harga: RM8/jam</p>
        <p class="unit-left" data-units="<?= $unit_data['Basikal Comfort'] ?? 0 ?>">
          Unit tersedia: <span class="unit-count"><?= $unit_data['Basikal Comfort'] ?? 0 ?></span>
        </p>
<button class="button-info"
  onclick="openModal('Basikal Comfort', 'img/b2.jpg', 'Dilengkapi tempat duduk empuk dan posisi menunggang ergonomik. Sesuai untuk perjalanan jauh dan selesa.')">
  Maklumat
</button>
      </div>
    </div>

    <!-- Kad Basikal 3 -->
    <div class="bike-card">
      <img src="img/b3.jpg" alt="Basikal Elektrik" class="bike-image">
      <div class="bike-details">
        <h3>Basikal Elektrik</h3>
        <p>Kapasiti: 1 orang</p>
        <p>Harga: RM15/jam</p>
        <p class="unit-left" data-units="<?= $unit_data['Basikal Elektrik'] ?? 0 ?>">
          Unit tersedia: <span class="unit-count"><?= $unit_data['Basikal Elektrik'] ?? 0 ?></span>
        </p>
<button class="button-info"
  onclick="openModal('Basikal Elektrik', 'img/b3.jpg', 'Basikal Elektrik membantu dengan motor elektrik. Mudah dikayuh, sesuai untuk warga emas dan kawasan berbukit.')">
  Maklumat
</button>
      </div>
    </div>

    <!-- Kad Basikal 4 -->
    <div class="bike-card">
      <img src="img/b4.jpg" alt="Basikal Tandem" class="bike-image">
      <div class="bike-details">
        <h3>Basikal Tandem</h3>
        <p>Kapasiti: 2 orang</p>
        <p>Harga: RM12/jam</p>
        <p class="unit-left" data-units="<?= $unit_data['Basikal Tandem'] ?? 0 ?>">
          Unit tersedia: <span class="unit-count"><?= $unit_data['Basikal Tandem'] ?? 0 ?></span>
        </p>
<button class="button-info"
  onclick="openModal('Basikal Tandem', 'img/b4.jpg', 'Basikal untuk 2 orang. Menyeronokkan bagi pasangan atau rakan, memerlukan koordinasi semasa menunggang.')">
  Maklumat
</button>
      </div>
    </div>

    <!-- Kad Basikal 5 -->
    <div class="bike-card">
      <img src="img/b5.jpg" alt="Basikal Family 3" class="bike-image">
      <div class="bike-details">
        <h3>Basikal Family (3 Orang)</h3>
        <p>Kapasiti: 3 orang</p>
        <p>Harga: RM20/jam</p>
        <p class="unit-left" data-units="<?= $unit_data['Basikal Family (3 Orang)'] ?? 0 ?>">
          Unit tersedia: <span class="unit-count"><?= $unit_data['Basikal Family (3 Orang)'] ?? 0 ?></span>
        </p>
<button class="button-info"
  onclick="openModal('Basikal Family (3 Orang)', 'img/b5.jpg', 'Basikal untuk 3 penumpang, sesuai untuk keluarga dengan anak kecil. Stabil dan selamat digunakan.')">
  Maklumat
</button>
      </div>
    </div>

    <!-- Kad Basikal 6 -->
    <div class="bike-card">
      <img src="img/b6.jpg" alt="Basikal Family 4" class="bike-image">
      <div class="bike-details">
        <h3>Basikal Family (4 Orang)</h3>
        <p>Kapasiti: 4 orang</p>
        <p>Harga: RM25/jam</p>
        <p class="unit-left" data-units="<?= $unit_data['Basikal Family (4 Orang)'] ?? 0 ?>">
          Unit tersedia: <span class="unit-count"><?= $unit_data['Basikal Family (4 Orang)'] ?? 0 ?></span>
        </p>
<button class="button-info"
  onclick="openModal('Basikal Family (4 Orang)', 'img/b6.jpg', 'Basikal keluarga 4 orang. Sesuai untuk bersiar-siar di taman, lengkap dengan tempat duduk hadapan dan belakang.')">
  Maklumat
</button>
      </div>
    </div>

  </div> <!-- end .bike-grid -->
</div> <!-- end .main-content -->

  </section>

  <!-- Modal Maklumat -->
<div id="infoModal" class="modal">
  <div class="modal-content">
    <span class="close-button" onclick="closeModal()">&times;</span>
    <img id="modalImage" src="" alt="" class="modal-image">
    <h2 id="modalTitle"></h2>
    <p id="modalDescription"></p>
  </div>
</div>

<section id="rent" class="scroll-reveal">
  <h2>Borang Sewa Basikal</h2>
  
<?php if (isset($_SESSION['sewaan_id']) && isset($_SESSION['nama_penyewa'])): ?>
<div class="toast" id="notiToast" style="
  position: fixed;
  top: 20px;
  right: 20px;
  background-color: #a67c52;
  color: #fff;
  padding: 16px 24px;
  border-radius: 12px;
  box-shadow: 0 6px 20px rgba(0,0,0,0.2);
  font-family: 'Poppins', sans-serif;
  z-index: 9999;
  display: flex;
  align-items: center;
  gap: 16px;
  max-width: 400px;
">
  <div>
    Hai <strong><?= htmlspecialchars($_SESSION['nama_penyewa']) ?></strong>! 👋<br>
    Sila <a href="semak_sewaan.php?id=<?= $_SESSION['sewaan_id'] ?>" style="color:#fff; text-decoration: underline;">semak status sewaan anda</a>.
  </div>
  <button onclick="tutupNoti()" style="background: none; border: none; color: white; font-size: 18px; cursor: pointer;">×</button>
</div>
<script>
function tutupNoti() {
  document.getElementById("notiToast").style.display = "none";
  fetch("unset_noti.php");
}
</script>
<?php endif; ?>
<form method="POST" action="sewa.php" class="rent-form" id="rentForm">

    <label for="name">Nama Penuh</label>
    <input type="text" id="name" name="nama" required />

    <label for="phone">No. Telefon</label>
    <input type="tel" id="phone" name="no_telefon" required />

<label for="bikeType">Jenis Basikal</label>
<select name="jenis_basikal" id="bikeType" required onchange="semakStok()">
  <option value="">-- Pilih Basikal --</option>
  <?php
  // Ambil senarai basikal & unit untuk dropdown
  $hargaMap = [
    "Basikal Biasa" => 5,
    "Basikal Comfort" => 8,
    "Basikal Elektrik" => 15,
    "Basikal Tandem" => 12,
    "Basikal Family (3 Orang)" => 20,
    "Basikal Family (4 Orang)" => 25,
  ];

  // Buat QUERY baru khas untuk dropdown
  $sql_dropdown = "SELECT nama, unit FROM status_basikal";
  $result_dropdown = $conn->query($sql_dropdown);

  if ($result_dropdown && $result_dropdown->num_rows > 0):
    while($row = $result_dropdown->fetch_assoc()):
      $nama = $row['nama'];
      $harga = $hargaMap[$nama] ?? 0;
      $unit = $row['unit'];
  ?>
    <option value="<?= $nama ?>" data-unit="<?= $unit ?>">
      <?= $nama ?> - RM<?= $harga ?>/jam 
      <?= ($unit == 0) ? '(Tiada unit tersedia)' : '(Unit: '.$unit.')' ?>
    </option>
  <?php
    endwhile;
  endif;
  ?>
</select>








    <label for="duration">Tempoh Sewa (jam)</label>
    <input type="number" id="duration" name="tempoh_sewa" min="1" max="4" placeholder="Contoh: 2" required />

    <!-- Tarikh & Waktu -->
    <label for="tarikh">Tarikh Sewa</label>
    <input type="date" id="tarikh" name="tarikh" required />

    <label for="masa">Masa Sewa</label>
    <select id="masa" name="masa" required>
    <option value="">-- Pilih Masa --</option>
    <option value="10:00 pagi – 1:00 petang">10:00 pagi – 1:00 petang</option>
    <option value="7:00 malam – 10:00 malam">7:00 malam – 10:00 malam</option>
    </select>


    <label for="notes">Catatan Tambahan</label>
    <textarea id="notes" name="catatan" rows="3" placeholder="Contoh: Saya ingin helmet."></textarea>

    <div class="price-display" id="totalPrice">Jumlah Harga: RM 0</div>
    <input type="hidden" name="jumlah_harga" id="jumlahHargaInput">



    <button type="submit">Hantar Tempahan</button>
 

  </form>
</section>

<script>
  // Harga setiap jenis basikal (RM per jam)
  const bikePrices = {
  "Basikal Biasa": 5,
  "Basikal Comfort": 8,
  "Basikal Elektrik": 15,
  "Basikal Tandem": 12,
  "Basikal Family (3 Orang)": 20,
  "Basikal Family (4 Orang)": 25
  };

  document.addEventListener('DOMContentLoaded', () => {
    // Dapatkan elemen input dari form
    const bikeTypeSelect = document.getElementById('bikeType');
    const durationInput = document.getElementById('duration');
    const totalPriceDisplay = document.getElementById('totalPrice');
    const rentForm = document.getElementById('rentForm');

    // Pastikan elemen hidden untuk hantar jumlah ke PHP
    const jumlahHargaInput = document.getElementById('jumlahHargaInput');

    // Fungsi untuk update jumlah harga bila user pilih jenis basikal atau ubah tempoh
    function updateTotalPrice() {
      const type = bikeTypeSelect.value;
      const duration = parseInt(durationInput.value) || 0;
      let total = 0;

      if (type && duration > 0) {
        total = bikePrices[type] * duration;
        totalPriceDisplay.textContent = `Jumlah Harga: RM ${total}`;
      } else {
        totalPriceDisplay.textContent = 'Jumlah Harga: RM 0';
      }

      // Tetap set value kepada hidden input
      if (jumlahHargaInput) {
        jumlahHargaInput.value = total;
      }
    }

    // Event listeners
    bikeTypeSelect.addEventListener('change', updateTotalPrice);
    durationInput.addEventListener('input', updateTotalPrice);

    // Reset form & harga
    rentForm.reset();
    updateTotalPrice();
  });
</script>


<script>
  function revealOnScroll() {
    const reveals = document.querySelectorAll('.scroll-reveal');

    reveals.forEach(el => {
      const windowHeight = window.innerHeight;
      const elementTop = el.getBoundingClientRect().top;
      const elementVisible = 100;

      if (elementTop < windowHeight - elementVisible) {
        el.classList.add('visible');
      }
    });
  }

  window.addEventListener('scroll', revealOnScroll);
  window.addEventListener('load', revealOnScroll);
</script>
<script>
function tutupNoti() {
  document.getElementById('notiToast').style.display = 'none';
  fetch('unset_noti.php'); // Hapus session dari server
}
</script>
<script>
  function openModal(title, imageSrc, description) {
    document.getElementById('modalTitle').innerText = title;
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('modalDescription').innerText = description;
    document.getElementById('infoModal').style.display = 'block';
  }

  function closeModal() {
    document.getElementById('infoModal').style.display = 'none';
  }

  // Tutup modal bila klik luar kawasan
  window.onclick = function(event) {
    const modal = document.getElementById('infoModal');
    if (event.target == modal) {
      modal.style.display = 'none';
    }
  };
</script>
<script>
function semakStok() {
    var select = document.getElementById('jenis_basikal');
    var selectedOption = select.options[select.selectedIndex];
    var unit = selectedOption.getAttribute('data-unit');

    if (unit == "0") {
        alert('Maaf, stok untuk ' + selectedOption.value + ' telah habis.');
        select.selectedIndex = 0; // reset pilihan
    }
}
</script>


 <?php include 'footer.php'; // Memanggil footer ?>
  <script src="script.js"></script>
  
</body>
</html>
