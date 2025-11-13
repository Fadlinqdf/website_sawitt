<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('config/koneksi.php');

// Jalankan proses pendaftaran sebelum HTML
if (isset($_POST['submit_pendaftaran'])) {
    include('config/pendaftaran_process.php');
}

$page_title = "Pendaftaran Magang/PKL";
$current_page = "pendaftaran";

include('includes/header.php');
?>

<div class="registration-form-container">
    <h1>Form Pendaftaran Mahasiswa Magang / Siswa PKL</h1>
    <h2>Pusat Penelitian Kelapa Sawit</h2>

    <?php
    if (isset($success_message)) {
        echo '<div class="alert-message alert-success">' . $success_message . '</div>';
    }
    if (isset($error_message)) {
        echo '<div class="alert-message alert-error">' . $error_message . '</div>';
    }
    ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-section">
            <h3 class="form-section-title">Data Diri Pelamar</h3>
            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="jurusan">Jurusan</label>
                    <input type="text" id="jurusan" name="jurusan" required>
                </div>
                <div class="form-group">
                    <label for="fakultas">Fakultas / Kelas</label>
                    <input type="text" id="fakultas" name="fakultas" required>
                </div>
                <div class="form-group full-width">
                    <label for="universitas">Universitas / Sekolah</label>
                    <input type="text" id="universitas" name="universitas" required>
                </div>

                <!-- ✅ Tambahan: input email -->
                <div class="form-group">
                    <label for="email">Email Aktif</label>
                    <input type="email" id="email" name="email" placeholder="Masukkan email aktif" required>
                </div>

                <div class="form-group">
                    <label for="peminatan">Peminatan</label>
                    <input type="text" id="peminatan" name="peminatan" required>
                </div>
                <div class="form-group">
                    <label for="kurikulum_cv">Upload Kurikulum / CV (Max 1MB)</label>
                    <input type="file" id="kurikulum_cv" name="kurikulum_cv" accept=".pdf,.doc,.docx" required>
                    <p class="file-hint">*Upload file ukuran maks 1MB</p>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3 class="form-section-title">Bagian / Bidang Magang</h3>
            <div class="form-grid">
                <div class="form-group">
                    <label for="bagian">Bagian</label>
                    <input type="text" id="bagian" name="bagian">
                </div>
                <div class="form-group full-width">
                    <label for="deskripsi_pekerjaan">Deskripsi Pekerjaan</label>
                    <textarea id="deskripsi_pekerjaan" name="deskripsi_pekerjaan"></textarea>
                </div>
                <div class="form-group">
                    <label for="sub_bagian">Sub Bagian</label>
                    <input type="text" id="sub_bagian" name="sub_bagian">
                </div>
                <div class="form-group">
                    <label for="bidang">Bidang</label>
                    <input type="text" id="bidang" name="bidang">
                </div>
            </div>
        </div>

        <p class="agreement-text">
            Dengan mengajukan form ini saya siap mematuhi seluruh peraturan di lingkungan PPKS, PT. RPN
        </p>

        <div class="form-actions">
            <button type="submit" name="submit_pendaftaran" class="btn-action btn-apply">Apply</button>
            <a href="index.php" class="btn-action btn-cancel">Kembali</a>
        </div>
    </form>
</div>

<?php include('includes/footer.php'); ?>
