<?php
include('koneksi.php');

// Jalankan session jika belum aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama     = trim($_POST['nama']);
    $email    = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // 🔍 Cek apakah email sudah terdaftar
    $cek = $koneksi->prepare("SELECT id FROM users WHERE email = ?");
    $cek->bind_param("s", $email);
    $cek->execute();
    $result = $cek->get_result();
    $cek->close();

    if ($result->num_rows > 0) {
        $_SESSION['error_message'] = "Email sudah terdaftar!";
        header("Location: ../register.php");
        exit;
    }

    // ✅ Simpan data baru
    $stmt = $koneksi->prepare("INSERT INTO users (nama, email, password) VALUES (?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sss", $nama, $email, $password);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Pendaftaran berhasil! Silakan login.";
            header("Location: ../login.php");
        } else {
            $_SESSION['error_message'] = "Gagal menyimpan data: " . $stmt->error;
            header("Location: ../register.php");
        }
        $stmt->close();
    } else {
        $_SESSION['error_message'] = "Gagal menyiapkan query: " . $koneksi->error;
        header("Location: ../register.php");
    }

    $koneksi->close();
    exit;
}
?>
