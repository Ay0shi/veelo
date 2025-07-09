<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Custom</title>

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap" rel="stylesheet">

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- CUSTOM CSS -->
    <style>
        body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
}

.navbar {
    transition: all 0.3s ease;
    background-color: transparent;
    padding: 1rem 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.navbar .nav-link {
    color: #fbf3e7;
    font-weight: bold;
    transition: color 0.3s;
}

.navbar .nav-link:hover {
    color: #d6ffd9;
}

.navbar .logo-scroll {
    display: none;
    height: 40px;
}

.navbar .logo-default {
    height: 40px;
    transition: all 0.3s;
}

.navbar-shrink {
    background-color: #fbf3e7 !important;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 0.5rem 0;
}

.navbar-shrink .nav-link {
    color: #473925;
}

.navbar-shrink .nav-link:hover {
    color: #7ab150;
}

.navbar-shrink .logo-default {
    display: none;
}

.navbar-shrink .logo-scroll {
    display: inline;
}
/* Gaya khas untuk butang Admin */
.navbar .btn-admin {
    background-color: #8a5e3a; /* Warna coklat */
    color: #fbf3e7;
    padding: 10px 18px;
    font-size: 14px;
    border-radius: 6px;
    font-weight: bold;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    transition: background-color 0.3s ease;
    margin: auto; /* Untuk memastikan ia berada di tengah */
    margin-left: 15px; /* Tambah jarak */
}

.navbar .btn-admin:hover {
    background-color: #66462c; /* Warna coklat lebih gelap */
    color: #ffffff;
}


.masterhead {
    position: relative;
    height: 100vh;
    overflow: hidden;
}

.video-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 1;
}

.overlay {
    position: relative;
    z-index: 2;
    background-color: rgba(71, 57, 37, 0.6); /* coklat gelap transparent */
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.logo {
    max-width: 300px;
    margin-bottom: 30px;
}

.buttons {
    display: flex;
    gap: 20px;
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 14px 32px;
    font-size: 18px;
    font-weight: bold;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    text-decoration: none;
    color: white !important;
    transition: background-color 0.3s ease;
    gap: 8px; /* jarak antara icon & teks */
}

.btn.user {
    background-color: #5e7b48; /* purple */
}

.btn.user:hover {
    background-color: #445735;
}

    </style>
    <!-- CUSTOM JS -->
    <script>
        function navbarShrink() {
    const navbar = document.querySelector('#mainNav');
    if (!navbar) return;

    if (window.scrollY === 0) {
        navbar.classList.remove('navbar-shrink');
    } else {
        navbar.classList.add('navbar-shrink');
    }
}

document.addEventListener('DOMContentLoaded', () => {
    navbarShrink();
    document.addEventListener('scroll', navbarShrink);
});

    </script>
</head>
<body id="page-top">
    <nav id="mainNav" class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#page-top">
            <img src="img/logoveelo1.png" class="logo-default" alt="Logo Default" />
            <img src="img/logoveelo2.png" class="logo-scroll" alt="Logo Scroll" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto my-2 my-lg-0">
                <li class="nav-item"><a class="nav-link" href="index.php#about">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php#services">Perkhidmatan</a></li>
                <li class="nav-item"><a class="nav-link" href="sewa.php#portfolio">Galeri</a></li>
                <li class="nav-item"><a class="nav-link" href="sewa.php#rent">Sewa Basikal</a></li>
                <!-- Butang Admin -->
                <li class="nav-item">
                    <a href="admin_login.php" class="btn-admin" style="padding: 6px 14px; font-size: 14px;">
                        <i class="fas fa-lock"></i> Admin
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>


    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
