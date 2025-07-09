<!-- Sidebar -->
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
  @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css');

  .sidebar {
    width: 250px;
    background-color: #fdfaf6;
    color: #2e2e2e;
    position: fixed;
    height: 100vh;
    top: 0;
    left: 0;
    overflow-y: auto;
    transition: all 0.3s ease;
    font-family: 'Poppins', sans-serif;
    box-shadow: 2px 0 8px rgba(0,0,0,0.05);
    z-index: 999;
  }

  .sidebar.collapsed {
    width: 70px;
  }

  .sidebar-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px;
  }

  .sidebar-logo {
    max-width: 150px;
    transition: 0.3s;
  }

  .sidebar.collapsed .sidebar-logo {
    display: none;
  }

  .sidebar-toggle {
    background: none;
    border: none;
    font-size: 22px;
    cursor: pointer;
    color: #445735;
  }

  .sidebar-menu {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .sidebar-menu li {
    padding: 15px 20px;
  }

  .sidebar-menu li a {
    display: flex;
    align-items: center;
    color: #2e2e2e;
    text-decoration: none;
    font-weight: 500;
    transition: 0.3s;
  }

  .sidebar-menu li a i {
    margin-right: 12px;
    color: #a67c52;
    min-width: 20px;
  }

  .sidebar.collapsed li a span {
    display: none;
  }

  .sidebar-menu li a:hover {
    background-color: #f3f1ed;
    border-radius: 0 20px 20px 0;
  }
</style>

<div id="sidebar" class="sidebar">
  <div class="sidebar-header">
    <img src="img/logoveelo2.png" alt="Logo" class="sidebar-logo" />
    <button class="sidebar-toggle" onclick="toggleSidebar()">☰</button>
  </div>
  <ul class="sidebar-menu">
    <li><a href="admin_dashboard.php"><i class="fas fa-file-alt"></i> <span>Data Tempahan</span></a></li>
    <li><a href="status_basikal.php"><i class="fas fa-bicycle"></i> <span>Status Basikal</span></a></li>
<li>
  <a href="admin_logout.php" onclick="return confirm('Adakah anda pasti mahu log keluar?')">
    <i class="fas fa-sign-out-alt"></i> <span>Log Keluar</span>
  </a>
</li>
  </ul>
</div>

<script>
  function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    sidebar.classList.toggle("collapsed");
  }
</script>
