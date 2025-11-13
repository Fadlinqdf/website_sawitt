<?php
$page_title = "Register - Website Sawit";
$current_page = "register";

include('includes/header.php'); 

// Jalankan session jika belum aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="form-container">
    <a href="index.php" style="float: left; color: var(--green-dark); font-size: 24px; text-decoration: none;">&larr;</a>
    <h2 style="clear: both;">Register</h2>

    <?php
    if (isset($_SESSION['error_message'])) {
        echo '<div class="alert-message alert-error">' . $_SESSION['error_message'] . '</div>';
        unset($_SESSION['error_message']);
    }
    if (isset($_SESSION['success_message'])) {
        echo '<div class="alert-message alert-success">' . $_SESSION['success_message'] . '</div>';
        unset($_SESSION['success_message']);
    }
    ?>

    <form action="config/register_process.php" method="POST">
        <script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>
        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Masukkan email aktif" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="********" required>
        </div>
        <div class="checkbox-group">
            <input type="checkbox" id="agreement" name="agreement" required>
            <label for="agreement">Saya setuju dengan syarat dan ketentuan.</label>
        </div>
        <button type="submit" name="register_submit" class="btn-submit">Register</button>
    </form>

    <div class="form-links">
        <p>Sudah punya akun? <a href="login.php">Masuk di sini</a></p>
    </div>
</div>

<?php include('includes/footer.php'); ?>
