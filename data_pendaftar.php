<?php
session_start();
include('config/koneksi.php');

// Cek role admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit;
}

$page_title = "Data Pendaftar";
$current_page = "data";

include('includes/header.php');
?>

<div class="data-container">
    <h1>Data Pendaftar Magang / PKL</h1>

    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Fakultas</th>
                    <th>Universitas</th>
                    <th>Email</th>
                    <th>Peminatan</th>
                    <th>Bagian</th>
                    <th>Sub Bagian</th>
                    <th>Bidang</th>
                    <th>Deskripsi Pekerjaan</th>
                    <th>Tanggal Daftar</th>
                    <th>CV</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $query = "SELECT * FROM pendaftaran_magang ORDER BY id DESC";
                $result = $koneksi->query($query);

                if ($result && $result->num_rows > 0):
                    while ($row = $result->fetch_assoc()):
                ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nama']); ?></td>
                            <td><?= htmlspecialchars($row['jurusan']); ?></td>
                            <td><?= htmlspecialchars($row['fakultas']); ?></td>
                            <td><?= htmlspecialchars($row['universitas']); ?></td>
                            <td><?= htmlspecialchars($row['email']); ?></td>
                            <td><?= htmlspecialchars($row['peminatan']); ?></td>
                            <td><?= htmlspecialchars($row['bagian']); ?></td>
                            <td><?= htmlspecialchars($row['sub_bagian']); ?></td>
                            <td><?= htmlspecialchars($row['bidang']); ?></td>
                            <td><?= htmlspecialchars($row['deskripsi_pekerjaan']); ?></td>
                            <td><?= htmlspecialchars($row['tanggal_daftar']); ?></td>
                            <td>
                                <?php if (!empty($row['kurikulum_cv_path']) && file_exists($row['kurikulum_cv_path'])): ?>
                                    <a href="<?= htmlspecialchars($row['kurikulum_cv_path']); ?>" target="_blank" class="btn-cv">Lihat CV</a>
                                <?php else: ?>
                                    <span class="no-file">Tidak ada</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                <?php
                    endwhile;
                else:
                    echo '<tr><td colspan="13" class="no-data">Belum ada data pendaftar.</td></tr>';
                endif;
                ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    .data-container {
        padding: 40px;
        max-width: 95%;
        margin: auto;
    }

    .data-container h1 {
        text-align: center;
        color: #198754;
        margin-bottom: 25px;
    }

    .table-wrapper {
        overflow-x: auto;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1000px;
    }

    .data-table th,
    .data-table td {
        border: 1px solid #ddd;
        padding: 10px 12px;
        text-align: left;
        font-size: 14px;
    }

    .data-table th {
        background: #198754;
        color: white;
        position: sticky;
        top: 0;
        z-index: 2;
    }

    .data-table tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    .data-table tr:hover {
        background-color: #eaf7ee;
    }

    .btn-cv {
        display: inline-block;
        background: #0d6efd;
        color: white;
        padding: 5px 10px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 13px;
    }

    .btn-cv:hover {
        background: #0b5ed7;
    }

    .no-data,
    .no-file {
        text-align: center;
        color: #888;
        font-style: italic;
    }

    @media (max-width: 768px) {
        .data-container {
            padding: 20px;
        }

        .data-table th,
        .data-table td {
            font-size: 12px;
            padding: 8px;
        }

        .btn-cv {
            padding: 4px 8px;
            font-size: 12px;
        }
    }
</style>

<?php include('includes/footer.php'); ?>