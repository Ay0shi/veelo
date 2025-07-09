<?php
session_start();
include 'config.php';
include 'sidebar.php'; // Jika ada sidebar
?>

<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <title>Status Basikal</title>
  <link rel="stylesheet" href="style_status.css"> <!-- CSS yang kau bagi sebelum ni -->
</head>
<body>
  <div class="main-content">
    <?php if (isset($_GET['updated']) && $_GET['updated'] == 'true'): ?>
  <div style="padding:10px; background-color:#dff0d8; color:#3c763d; border-radius:8px; margin-bottom:20px; text-align:center;">
    Unit berjaya dikemaskini!
  </div>
<?php endif; ?>

    <h2>Status Unit Basikal</h2>
    <div class="bike-grid">
      <?php
      $result = $conn->query("SELECT * FROM status_basikal");
      while ($row = $result->fetch_assoc()):
      ?>
        <div class="bike-card">
          <img src="<?= $row['gambar'] ?>" alt="<?= $row['nama'] ?>" class="bike-image">
          <div class="bike-details">
            <h3><?= $row['nama'] ?></h3>
<p>Kapasiti: <?= $row['kapasiti'] ?></p>
<p class="<?= $row['unit'] == 0 ? 'unit-habis' : 'unit-ada' ?>">
  Status: <?= $row['unit'] == 0 ? 'Habis Disewa' : 'Tersedia' ?>
</p>
            <p>Harga: RM<?= $row['harga'] ?>/jam</p>
           <form action="update_unit.php" method="POST" class="unit-form">
  <input type="hidden" name="id" value="<?= $row['id'] ?>">
  <label for="unit">Unit tersedia:</label>
  <div class="unit-control">
    <button type="button" class="btn-decrement">−</button>
    <input type="number" name="unit" value="<?= $row['unit'] ?>" min="0" required>
    <button type="button" class="btn-increment">+</button>
  </div>
  <button type="submit" class="btn-update">Kemaskini</button>
</form>

          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
  <script>
  document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll(".unit-form");

    forms.forEach((form) => {
      const incrementBtn = form.querySelector(".btn-increment");
      const decrementBtn = form.querySelector(".btn-decrement");
      const input = form.querySelector("input[name='unit']");

      incrementBtn.addEventListener("click", () => {
        input.value = parseInt(input.value) + 1;
      });

      decrementBtn.addEventListener("click", () => {
        if (parseInt(input.value) > 0) {
          input.value = parseInt(input.value) - 1;
        }
      });
    });
  });
</script>

</body>
</html>
