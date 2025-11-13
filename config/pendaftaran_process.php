<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Aktifkan error reporting (nonaktifkan saat online)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Pastikan PHPMailer tersedia
require __DIR__ . '/../PHPMailer/src/Exception.php';
require __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../PHPMailer/src/SMTP.php';

// Pastikan koneksi database aktif
if (!isset($koneksi)) {
    include('koneksi.php');
}

// Ambil data dari form
$nama = $koneksi->real_escape_string($_POST['nama']);
$jurusan = $koneksi->real_escape_string($_POST['jurusan']);
$fakultas = $koneksi->real_escape_string($_POST['fakultas']);
$universitas = $koneksi->real_escape_string($_POST['universitas']);
$email = $koneksi->real_escape_string($_POST['email']);
$peminatan = $koneksi->real_escape_string($_POST['peminatan']);
$bagian = $koneksi->real_escape_string($_POST['bagian']);
$deskripsi_pekerjaan = $koneksi->real_escape_string($_POST['deskripsi_pekerjaan']);
$sub_bagian = $koneksi->real_escape_string($_POST['sub_bagian']);
$bidang = $koneksi->real_escape_string($_POST['bidang']);
$tanggal_daftar = date('Y-m-d');

// 🔍 Cek apakah email sudah terdaftar
$cek_email = $koneksi->query("SELECT email FROM pendaftaran_magang WHERE email = '$email'");
if ($cek_email && $cek_email->num_rows > 0) {
    echo "<script>alert('❌ Email sudah pernah digunakan untuk mendaftar!'); window.location='/website_sawit/pendaftaran.php';</script>";
    exit();
}

// 📁 Upload file CV
$target_dir = __DIR__ . '/../uploads/cv/';
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$file_name = uniqid() . "-" . basename($_FILES["kurikulum_cv"]["name"]);
$target_file = $target_dir . $file_name;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Validasi file
if ($_FILES["kurikulum_cv"]["size"] > 1048576) {
    echo "<script>alert('❌ Ukuran file terlalu besar. Maksimal 1MB.'); window.location='/website_sawit/pendaftaran.php';</script>";
    exit();
}
if (!in_array($fileType, ["pdf", "doc", "docx"])) {
    echo "<script>alert('❌ Format file harus PDF, DOC, atau DOCX.'); window.location='/website_sawit/pendaftaran.php';</script>";
    exit();
}

// Proses upload file
if (move_uploaded_file($_FILES["kurikulum_cv"]["tmp_name"], $target_file)) {
    $file_path = 'uploads/cv/' . $file_name;

    // Simpan data ke database
    $insert = "
        INSERT INTO pendaftaran_magang 
        (nama, jurusan, fakultas, universitas, email, peminatan, kurikulum_cv_path,
        bagian, deskripsi_pekerjaan, sub_bagian, bidang, tanggal_daftar)
        VALUES 
        ('$nama', '$jurusan', '$fakultas', '$universitas', '$email', '$peminatan', '$file_path',
        '$bagian', '$deskripsi_pekerjaan', '$sub_bagian', '$bidang', '$tanggal_daftar')
    ";

    if ($koneksi->query($insert) === TRUE) {
        // Kirim Email Konfirmasi
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'afdalsmkmk@gmail.com'; // Email kamu
            $mail->Password = 'kvndkoxzpeeopxyz'; // App Password Gmail kamu
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('afdalsmkmk@gmail.com', 'Pusat Penelitian Kelapa Sawit');
            $mail->addAddress($email, $nama);

            $mail->isHTML(true);
            $mail->Subject = 'Konfirmasi Pendaftaran Magang / PKL';
            $mail->Body = "
                <div style='font-family:Arial,sans-serif;color:#333'>
                    <h2 style='color:#2e7d32;'>Konfirmasi Pendaftaran Magang / PKL</h2>
                    <p>Halo <strong>$nama</strong>,</p>
                    <p>Terima kasih telah mendaftar program Magang / PKL di <strong>Pusat Penelitian Kelapa Sawit</strong>.</p>
                    <p>Berikut data yang kamu kirimkan:</p>
                    <ul>
                        <li><strong>Nama:</strong> $nama</li>
                        <li><strong>Jurusan:</strong> $jurusan</li>
                        <li><strong>Universitas:</strong> $universitas</li>
                        <li><strong>Peminatan:</strong> $peminatan</li>
                    </ul>
                    <p>Kami akan menghubungi kamu kembali melalui email ini setelah seleksi selesai dilakukan.</p>
                    <br>
                    <p>Salam,</p>
                    <p><strong>PPKS - PT. RPN</strong></p>
                </div>
            ";

            $mail->send();
            echo "<script>alert('✅ Pendaftaran berhasil! Email konfirmasi telah dikirim ke $email'); window.location='/website_sawit/pendaftaran.php';</script>";
        } catch (Exception $e) {
            echo "<script>alert('✅ Pendaftaran berhasil, tetapi email gagal dikirim. Error: {$mail->ErrorInfo}'); window.location='/website_sawit/pendaftaran.php';</script>";
        }
    } else {
        echo "<script>alert('❌ Gagal menyimpan data ke database!'); window.location='/website_sawit/pendaftaran.php';</script>";
    }
} else {
    echo "<script>alert('❌ Gagal mengupload file!'); window.location='/website_sawit/pendaftaran.php';</script>";
}
?>
