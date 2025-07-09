<?php
session_start();
$_SESSION['sewaan_id'] = null;
$_SESSION['nama_penyewa'] = null;
unset($_SESSION['sewaan_id']);
unset($_SESSION['nama_penyewa']);
http_response_code(200);
header('Content-Type: application/json');
echo json_encode(["status" => "unset"]);
