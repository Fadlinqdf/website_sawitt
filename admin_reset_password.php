<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

include('includes/header.php');
include('config/koneksi.php');
?>

<h2 style="padding:20px;">🔑 Reset Password Pengguna</h2>

<form method="POST" action="" style="padding:20px;">
    <label for="email">Masukkan Email Pengguna:</label><br>
    <input type="email" name="email" placeholder="contoh: user@email.com" required
        style="padding:8px;width:300px;margin-top:8px;border:1px solid #ccc;border-radius:4px;"><br><br>

    <label for="password_baru">Password Baru:</label><br>
    <input type="password" name="password_baru" placeholder="Minimal 6 karakter" minlength="6" required
        style="padding:8px;width:300px;margin-top:8px;border:1px solid #ccc;border-radius:4px;"><br><br>

    <button type="submit" name="reset" style="padding:8px 14px;background:#198754;color:white;border:none;border-radius:4px;cursor:pointer;">
        Reset Password
    </button>
</form>

<?php
if (isset($_POST['reset'])) {
    $email = trim($_POST['email']);
    $password_baru = password_hash($_POST['password_baru'], PASSWORD_DEFAULT);

    // Cek apakah user ada dengan prepared statement
    $stmt = $koneksi->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $stmtUpdate = $koneksi->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmtUpdate->bind_param("ss", $password_baru, $email);

        if ($stmtUpdate->execute()) {
            echo "<script>
            Swal.fire('Berhasil!', 'Password untuk $email berhasil direset.', 'success').then(() => {
                window.location='admin_reset_password.php';
            });
            </script>";
        } else {
            echo "<script>Swal.fire('Gagal!', 'Terjadi kesalahan saat memperbarui password.', 'error');</script>";
        }
    } else {
        echo "<script>Swal.fire('Info', 'Email $email tidak ditemukan dalam database.', 'info');</script>";
    }

    $stmt->close();
}
?>

<?php include('includes/footer.php'); ?>