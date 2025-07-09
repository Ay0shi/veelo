<?php
session_start();
include 'config.php';

$error = '';

// Kalau form dihantar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $username;
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error = "Kata laluan salah!";
        }
    } else {
        $error = "Pengguna tidak wujud!";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">  <meta charset="UTF-8">
  <title>Admin Login</title>
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
    body.login-page {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(120deg, rgb(110, 108, 102), #e3d5ca);
    }
    .page-wrapper {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    .main-content {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
    }
   
    .login-container {
      background-color: #fff;
      padding: 2.5rem;
      border-radius: 1rem;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
      max-width: 400px;
      width: 90%;
      text-align: center;
    }
    .login-container h2 {
      margin-bottom: 1.5rem;
      color: #5e5240;
      font-size: 2rem;
    }
    .login-container input[type="text"],
    .login-container input[type="password"] {
      width: 100%;
      padding: 0.8rem;
      margin-bottom: 1.2rem;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1rem;
      font-family: inherit;
    }
    .login-container button {
      background-color: #5e7b48;
      color: white;
      padding: 0.75rem 1.5rem;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .login-container button:hover {
      background-color: #445735;
    }
    /* Tambah hanya ini untuk susunan kiri dan icon */
.login-container .form-group {
  text-align: left;
  margin-bottom: 1.2rem;
}

.login-container label {
  font-weight: bold;
  display: block;
  margin-bottom: 0.5rem;
  color: #5e5240;
}

.login-container label i {
  margin-right: 6px;
  color: #5e7b48;
}

/* Untuk toggle mata */
.password-wrapper {
  position: relative;
}

.toggle-password {
  position: absolute;
  top: 50%;
  right: 1rem;
  transform: translateY(-50%);
  cursor: pointer;
  color: #5e7b48;
}

.toggle-password:hover {
  color: #445735;
}

    .error-msg {
      color: #c0392b;
      margin-bottom: 1rem;
      font-size: 0.95rem;
    }
  </style>
</head>
<body class="login-page">
  <div class="page-wrapper">
          <br>
      <br>
      <br>
      <br>
      <br>
    <div class="main-content">
      <div class="login-container">
<h2 style="font-family: 'Anton', sans-serif; font-size: 40px; color: #445735; text-align: center;">
  ADMIN LOG MASUK
</h2>
        <?php if ($error) echo "<div class='error-msg'>$error</div>"; ?>

<form action="admin_login.php" method="post">
  <div class="form-group">
    <label for="username"><i class="fa fa-user"></i> Nama Admin :</label>
    <input type="text" id="username" name="username" placeholder="admin" required>
  </div>

  <div class="form-group">
    <label for="password"><i class="fa fa-lock"></i> Kata Laluan :</label>
    <div class="password-wrapper">
      <input type="password" id="password" name="password" placeholder="••••••••" required>
      <span class="toggle-password" onclick="togglePassword()">
        <i class="fa fa-eye" id="eye-icon"></i>
      </span>
    </div>
  </div>

  <button type="submit">Log Masuk</button>
</form>


      </div>
    </div>
    <br>
    <br>
    <br>
    <br>

    <?php include 'navbar.php'; ?>
    <?php include 'footer.php'; ?>
  </div>
  <script>
  function togglePassword() {
    const passwordInput = document.getElementById("password");
    const eyeIcon = document.getElementById("eye-icon");
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      eyeIcon.classList.remove("fa-eye");
      eyeIcon.classList.add("fa-eye-slash");
    } else {
      passwordInput.type = "password";
      eyeIcon.classList.remove("fa-eye-slash");
      eyeIcon.classList.add("fa-eye");
    }
  }
</script>

</body>
</html>
