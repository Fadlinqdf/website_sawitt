<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('koneksi.php');
session_start();

if (isset($_POST['login_submit'])) {
    $user_input = trim($_POST['user_input']);
    $password = $_POST['password'];

    // Cek user berdasarkan email ATAU nama
    $query = "SELECT * FROM users WHERE email = ? OR nama = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ss", $user_input, $user_input);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // Simpan session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_nama'] = $user['nama'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['status'] = 'login';
            $_SESSION['login_success'] = true;
            $_SESSION['role'] = $user['role']; // simpan role

            // Redirect berdasarkan role
            if ($user['role'] === 'admin') {
                header("Location: ../dashboard_admin.php");
            } else {
                header("Location: ../index.php");
            }
            exit;
        } else {
            $_SESSION['error_message'] = "Password salah!";
            header("Location: ../login.php");
            exit;
        }
    } else {
        $_SESSION['error_message'] = "Email atau Nama tidak ditemukan!";
        header("Location: ../login.php");
        exit;
    }

    $stmt->close();
}
