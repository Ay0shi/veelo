<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Footer VEELO</title>
    <!-- Link to Font Awesome for social icons -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
      rel="stylesheet"
    />
    <style>
        /* Footer Styles */
        .footer-section {
            background-color: #2d572c; /* Forest Green */
            color: #ffffff;
            padding: 40px 0;
            font-family: 'Poppins', sans-serif;
        }

        .footer-logo {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #ffffff;
        }

        .footer-section h4 {
            font-size: 18px;
            margin-bottom: 15px;
            color: #ffffff;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: #fbf3e7;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: #a8e063; /* Warna cerah */
        }

        .social-icons {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }

        .social-icon {
            color: #ffffff;
            font-size: 20px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .social-icon:hover {
            color: #a8e063;
        }

        .app-icons img {
            height: 40px;
            margin-right: 10px;
            vertical-align: middle;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 15px;
            border-top: 1px solid #1e3c1e;
            margin-top: 20px;
            font-size: 14px;
            color: #d9d9d9;
        }

        /* Responsive columns for mobile */
        @media (max-width: 767px) {
            .footer-section .row > div {
                margin-bottom: 30px;
                text-align: center;
            }
            .social-icons {
                justify-content: center;
            }
            .app-icons {
                justify-content: center;
            }
        }
    </style>
</head>
<body>

<footer class="footer-section">
    <div class="container" style="max-width: 1140px; margin: 0 auto; padding: 0 15px;">
        <div class="row" style="display: flex; flex-wrap: wrap; gap: 30px;">
            <!-- Logo dan Deskripsi -->
            <div class="col-md-4 col-sm-12" style="flex: 1 1 300px; min-width: 250px;">
                <h3 class="footer-logo">VEELO</h3>
                <p>
                    Sistem penyewaan basikal di Taman Botani Putrajaya. Nikmati pengalaman berbasikal dengan harga terbaik dan basikal berkualiti.
                </p>
            </div>

            <!-- Navigasi Pautan -->
            <div class="col-md-4 col-sm-12" style="flex: 1 1 300px; min-width: 250px;">
                <h4>Menu Pantas</h4>
                <ul class="footer-links">
                    <li><a href="#about">Tentang Kami</a></li>
                    <li><a href="#services">Perkhidmatan</a></li>
                    <li><a href="#contact">Hubungi Kami</a></li>
                </ul>
            </div>

            <!-- Ikon Sosial dan App -->
            <div class="col-md-4 col-sm-12" style="flex: 1 1 300px; min-width: 250px;">
                <h4>Ikuti Kami</h4>
                <div class="social-icons">
                    <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                </div>
                <h4>Muat Turun Aplikasi</h4>
                <div class="app-icons" style="display: flex; gap: 10px;">
                    <a href="https://play.google.com/store/games?hl=en"><img src="img/googleplay.png" alt="Google Play"></a>
                    <a href="https://www.apple.com/my/app-store/"><img src="img/appstore.png" alt="App Store"></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 VEELO. Semua Hak Cipta Terpelihara.</p>
        </div>
    </div>
</footer>

</body>
</html>
