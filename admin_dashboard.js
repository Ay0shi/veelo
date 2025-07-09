// admin_dashboard.js

function confirmHapus(nama) {
  return confirm('Adakah anda pasti mahu hapus data untuk: ' + nama + '?');
}

function confirmKemaskini(nama) {
  return confirm('Kemaskini data untuk: ' + nama + '?');
}

// Tambah fungsi lain jika perlu kemudian
function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");
  const main = document.querySelector(".main-content");
  sidebar.classList.toggle("collapsed");

  if (sidebar.classList.contains("collapsed")) {
    main.style.marginLeft = "70px";
  } else {
    main.style.marginLeft = "260px";
  }
}
function confirmHapus(nama) {
  return confirm("Adakah anda pasti mahu hapus sewaan atas nama '" + nama + "'?");
}
