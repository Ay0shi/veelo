<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST['id']);
    $unit = intval($_POST['unit']);

    $sql = "UPDATE status_basikal SET unit = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $unit, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Unit basikal berjaya dikemaskini.'); window.location.href = 'status_basikal.php';</script>";
        exit;
    } else {
        echo "<script>alert('Ralat semasa mengemaskini.'); window.history.back();</script>";
        exit;
    }
} else {
    echo "Permintaan tidak sah.";
}
?>
