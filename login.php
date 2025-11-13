<?php 
$page_title = "Sign In - Website Sawit";
$current_page = "sign_in";

include('includes/header.php'); 
include('config/koneksi.php');

// Pastikan session hanya dijalankan jika belum aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="form-container">
    <a href="index.php" style="float: left; color: var(--green-dark); font-size: 24px; text-decoration: none;">&larr;</a>
    <h2 style="clear: both;">Sign in</h2>
    
    <?php 
    if (isset($_SESSION['success_message'])) {
        echo '<div class="alert-message alert-success">' . $_SESSION['success_message'] . '</div>';
        unset($_SESSION['success_message']); 
    }
    if (isset($_SESSION['error_message'])) {
        echo '<div class="alert-message alert-error">' . $_SESSION['error_message'] . '</div>';
        unset($_SESSION['error_message']); 
    }
    ?>
    
    <form action="config/login_process.php" method="POST">
        <div class="form-group">
            <label for="user_input">Email atau Username</label>
            <input type="text" id="user_input" name="user_input" placeholder="Masukkan email atau username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="********" required>
        </div>
        <button type="submit" name="login_submit" class="btn-submit">Sign In</button>
    </form>
    
    <div class="form-links">
        <p><a href="#">Forgot password?</a></p>
        <p>Don't have an account? <a href="register.php">Register</a></p>
    </div>
</div>

<?php include('includes/footer.php'); ?>
