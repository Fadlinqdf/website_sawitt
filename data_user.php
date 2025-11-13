<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$page_title = "Data User - Website Sawit";
$current_page = "data_user";
include('includes/header.php');
include('config/koneksi.php');

// ====== PROSES UBAH ROLE ======
if (isset($_POST['ubah_role'])) {
    $user_id = $_POST['user_id'];
    $new_role = $_POST['new_role'];

    $stmt = $koneksi->prepare("UPDATE users SET role = ? WHERE id = ?");
    $stmt->bind_param("si", $new_role, $user_id);

    if ($stmt->execute()) {
        echo "<script>Swal.fire('Berhasil!', 'Role berhasil diubah.', 'success').then(()=>{window.location='data_user.php';});</script>";
    } else {
        echo "<script>Swal.fire('Gagal!', 'Terjadi kesalahan saat mengubah role.', 'error');</script>";
    }

    $stmt->close();
}

// ====== PROSES HAPUS USER ======
if (isset($_POST['hapus_user'])) {
    $hapus_id = $_POST['hapus_id'];
    $stmt = $koneksi->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $hapus_id);

    if ($stmt->execute()) {
        echo "<script>Swal.fire('Berhasil!', 'User berhasil dihapus.', 'success').then(()=>{window.location='data_user.php';});</script>";
    } else {
        echo "<script>Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus user.', 'error');</script>";
    }

    $stmt->close();
}

// ====== PENCARIAN ======
$keyword = '';
if (isset($_GET['search'])) {
    $keyword = trim($_GET['search']);
}
?>

<h2 style="padding:20px;">📋 Data User</h2>

<div style="padding:0 20px 20px 20px;">
    <form method="GET" style="margin-bottom:10px;">
        <input type="text" name="search" placeholder="Cari nama atau email..." value="<?= htmlspecialchars($keyword) ?>"
            style="padding:6px 10px; border:1px solid #ccc; border-radius:4px; width:250px;">
        <button type="submit" style="padding:6px 12px; background:#198754; color:white; border:none; border-radius:4px;">Cari</button>
        <?php if ($keyword): ?>
            <a href="data_user.php" style="padding:6px 12px; background:#6c757d; color:white; border-radius:4px; text-decoration:none;">Reset</a>
        <?php endif; ?>
    </form>
</div>

<div style="overflow-x:auto; padding:0 20px 20px 20px;">
    <table border="1" cellpadding="10" cellspacing="0" style="border-collapse:collapse; width:100%; background:#fff; border-radius:8px;">
        <thead style="background:#198754; color:white;">
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Tanggal Daftar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM users WHERE nama LIKE ? OR email LIKE ? ORDER BY id DESC";
            $stmt = $koneksi->prepare($sql);
            $like_keyword = "%$keyword%";
            $stmt->bind_param("ss", $like_keyword, $like_keyword);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>" . htmlspecialchars($row['nama']) . "</td>
                    <td>" . htmlspecialchars($row['email']) . "</td>
                    <td>
                        <form method='POST' style='margin:0;'>
                            <input type='hidden' name='user_id' value='{$row['id']}'>
                            <select name='new_role' onchange='this.form.submit()' style='padding:4px 6px; border-radius:4px;'>
                                <option value='user' " . ($row['role'] == 'user' ? 'selected' : '') . ">User</option>
                                <option value='admin' " . ($row['role'] == 'admin' ? 'selected' : '') . ">Admin</option>
                            </select>
                            <input type='hidden' name='ubah_role' value='1'>
                        </form>
                    </td>
                    <td>{$row['created_at']}</td>
                    <td style='text-align:center;'>
                        <button type='button' onclick=\"resetPassword('{$row['email']}')\" 
                            style='padding:4px 8px; background:#0d6efd; color:white; border:none; border-radius:4px; margin-right:5px; cursor:pointer;'>Reset</button>
                        <form method='POST' style='display:inline;' onsubmit=\"return confirm('Yakin ingin menghapus akun ini?');\">
                            <input type='hidden' name='hapus_id' value='{$row['id']}'>
                            <button type='submit' name='hapus_user' 
                                style='padding:4px 8px; background:#dc3545; color:white; border:none; border-radius:4px;'>Hapus</button>
                        </form>
                    </td>
                </tr>";
                }
            } else {
                echo "<tr><td colspan='6' style='text-align:center;'>Tidak ada data user</td></tr>";
            }

            $stmt->close();
            ?>
        </tbody>
    </table>
</div>

<script>
    // === RESET PASSWORD DENGAN SWEETALERT + AJAX ===
    function resetPassword(email) {
        Swal.fire({
            title: 'Reset Password',
            html: `
            <p>Masukkan password baru untuk <b>${email}</b>:</p>
            <input type="password" id="newPassword" class="swal2-input" placeholder="Minimal 2 karakter">
        `,
            confirmButtonText: 'Reset',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            preConfirm: () => {
                const newPassword = document.getElementById('newPassword').value.trim();
                if (!newPassword || newPassword.length < 2) {
                    Swal.showValidationMessage('Password minimal 2 karakter!');
                    return false;
                }
                return newPassword;
            }
        }).then(result => {
            if (result.isConfirmed) {
                fetch('admin_reset_password.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `email=${encodeURIComponent(email)}&password_baru=${encodeURIComponent(result.value)}`
                    })
                    .then(res => res.text())
                    .then(response => {
                        if (response.trim() === 'success') {
                            Swal.fire('Berhasil!', 'Password berhasil direset.', 'success');
                        } else {
                            Swal.fire('Gagal!', 'Terjadi kesalahan saat reset password.', 'error');
                        }
                    });
            }
        });
    }
</script>

<?php include('includes/footer.php'); ?>