<?php
session_start();
include 'config.php'; // pastikan sambungan DB betul

// Semak jika admin login
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Semak jika ada ID dihantar
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // SQL delete
    $stmt = $conn->prepare("DELETE FROM borangsewa WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Berjaya padam → kembali ke dashboard
        header("Location: admin_dashboard.php?padam=berjaya");
    } else {
        // Gagal padam
        header("Location: admin_dashboard.php?padam=gagal");
    }

    $stmt->close();
    $conn->close();
} else {
    // Kalau tak ada ID → redirect je
    header("Location: admin_dashboard.php");
}
?>
