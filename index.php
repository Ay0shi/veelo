<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap" rel="stylesheet">

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Panggil CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body class="index-page">
    <?php include 'navbar.php'; // Memanggil navbar ?>

      <header class="masterhead">
    <video autoplay muted loop playsinline class="video-bg">
        <source src="img/videotaman.mp4" type="video/mp4">
        Your browser does not support the video tag. 
    </video>
    <div class="overlay">
    <img src="img/logoveelo1.png" alt="Logo Besar" width="600" height="auto" class="mb-4" />        
    <div class="buttons">
           <a href="sewa.php#rent" class="btn user">
           <i class="fas fa-user"></i>Sewa sekarang!</a>
        </div>
    </div>
</header>
        <section id="about" class="about-section">
            <div class="container text-center py-5">
                <h2 class="section-title">Tentang VEELO</h2>
                <p class="section-description">VEELO menawarkan perkhidmatan sewa basikal yang menarik dengan harga yang berpatutan. Basikal kami direka untuk keselesaan dan gaya, sesuai untuk semua peringkat umur. Sistem ini hanya beroperasi di kawasan Taman Botani Putrajaya, menjadikan ia pengalaman eksklusif di lokasi yang indah ini.</p>
                <p class="section-timing">Waktu Operasi: <strong>10:00 pagi - 1:00 petang</strong> & <strong>7:00 malam - 10:00 malam</strong> (Slot masa tetap & terhad ✔️)</p>
                <p class="section-highlight">Jangan lepaskan peluang untuk meneroka keindahan Taman Botani Putrajaya dengan VEELO!</p>
                <a href="sewa.php#portfolio" class="btn btn-primary mt-3">Ketahui Lebih Lanjut</a>
            </div>
        </section>
        <section id="services" class="services-section">
    <div class="container text-center">
        <h2 class="section-title">Mengapa Pilih Kami?</h2>
        <p class="section-subtitle">Empat sebab utama untuk menyewa basikal dari kami di Taman Botani Putrajaya</p>
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="service-card">
                    <i class="fas fa-thumbs-up"></i>
                    <h3>Harga Berpatutan</h3>
                    <p>Basikal berkualiti tinggi dengan harga mampu milik untuk semua lapisan masyarakat.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="service-card">
                    <i class="fas fa-bicycle"></i>
                    <h3>Pelbagai Jenis Basikal</h3>
                    <p>Pilih daripada basikal standard, basikal gunung, dan banyak lagi mengikut keperluan anda.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="service-card">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3>Lokasi Strategik</h3>
                    <p>Kami berada di tengah-tengah Taman Botani Putrajaya, mudah diakses oleh semua.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="service-card">
                    <i class="fas fa-clock"></i>
                    <h3>Waktu Operasi Fleksibel</h3>
                    <p>Slot masa tetap: 10 Pagi - 1 Petang & 7 Malam - 10 Malam, sesuai dengan jadual anda.</p>
                </div>
            </div>
        </div>
    </div>
</section>
 <?php include 'footer.php'; // Memanggil footer ?>
    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Panggil JavaScript -->
    <script src="script.js"></script>
</body>
</html>
