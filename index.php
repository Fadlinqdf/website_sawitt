<?php
$page_title = "Home - Website Sawit";
$current_page = "home";
include('includes/header.php');
?>

<!-- HERO SECTION -->
<div class="hero-section">
    <img src="images/gambar_depan.jpg" alt="Pusat Penelitian Kelapa Sawit" class="hero-image">

    <div class="hero-overlay">
        <div class="hero-content">
            <h1>Pusat Penelitian<br>Kelapa Sawit</h1>
            <p>Website Pendaftaran Mahasiswa Magang / Siswa PKL</p>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="register.php" class="btn btn-hero-register">Register</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- WELCOME SECTION -->
<main class="content-section">
    <h2 class="welcome-title">SELAMAT DATANG di Pusat Penelitian Kelapa Sawit</h2>

    <div class="welcome-grid">
        <div class="image-column">
            <img src="images/foto_bos.jpg" alt="Foto Pimpinan/Staff" class="staff-photo">
        </div>
        <div class="text-column">
            <p>Dunia usaha saat ini tengah menghadapi fenomena disrupsi, ditandai dengan situasi pergerakan dunia usaha yang sangat cepat, perkembangan teknologi informasi 4.0, dan hampir semuanya serba VUCA (Volatile, Uncertain, Complex, Ambiguous). Menghadapi kondisi tersebut, dibutuhkan produsen yang kuat untuk bertahan, menyesuaikan diri, dan bahkan sukses terhadap berbagai tantangan. Pada intinya, sebuah perusahaan harus mampu mempertahankan eksistensinya, walaupun di tengah tekanan dan ujian, dan bahkan mampu mengatasi perubahan tersebut menjadi sebuah peluang untuk berkenda lebih baik lagi.</p>

            <p>Pusat Penelitian Kelapa Sawit (PPKS) merupakan cabang atau unit kerja dari PT. Riset Perkebunan Nusantara, yang berada di bawah Kementerian BUMN, yang memiliki peran strategis dalam riset dan pengembangan industri perkebunan kelapa sawit nasional. Keberadaan PPKS sejak 1916 memang didirikan tidak hanya untuk melayani pemerintah saja, tetapi untuk melayani semua kebutuhan masyarakat. Visi dan Misi unggulan PPKS adalah berkontribusi terhadap komoditas kelapa sawit yang berkontribusi besar bagi negara dalam bentuk devisa, pajak, penyerapan tenaga kerja, dan kemakmuran umum dan lingkungan. Hingga saat ini, PPKS adalah sumber riset dan teknologi yang dihasilkan PPKS dapat dimanfaatkan secara optimal bagi kemajuan kelapa sawit dan sektor hulu hingga hilir serta sumbangsih terhadap kebijakan pemerintah.</p>

            <p>Sejalan dengan perkembangan zaman dan teknologi yang semakin pesat, PPKS secara konsisten menerapkan dan memproduksi digitalisasi di dalam dunia riset dan inovasi kelapa sawit yang berfokus pada seperti: perakitan bahan tanaman unggul, teknologi precision agriculture 4.0, teknologi berbasis efisiensi atau cost reduction program, best management practices, serta...</p>

            <p><a href="#" class="read-more">Selengkapnya...</a></p>

            <p style="font-weight: bold; margin-top: 20px;">Hubungi Kami:</p>
            <ul>
                <li>Telp 1: (62) 61 7862486</li>
                <li>Telp 2: (62) 61 7864850</li>
                <li>Telp 3: (62) 61 7862488</li>
                <li>E-mail: admin@ppks.org</li>
            </ul>
        </div>
    </div>
</main>

<!-- FITUR SECTION -->
<div class="content-section features-section">
    <!-- 3 GAMBAR ATAS -->
    <div class="top-features-grid">
        <div class="feature-item large-feature">
            <img src="images/gambar1.jpg" alt="Regulasi Sawit" class="feature-image-full">
        </div>

        <div class="feature-item large-feature">
            <img src="images/gambar2.jpg" alt="Sawit Dalam Angka" class="feature-image-full">
        </div>

        <div class="feature-item large-feature">
            <img src="images/gambar3.jpg" alt="Product Knowledge 2023" class="feature-image-full">
        </div>
    </div>

    <!-- BAGIAN FITUR KAMI -->
    <h2 class="section-title-center">
        <span class="black-text">FITUR</span> <span class="green-text">KAMI</span>
    </h2>
    <div class="title-lines">
        <span class="line black-line"></span>
        <span class="line green-line"></span>
    </div>

    <p class="features-intro">
        Pusat Penelitian Kelapa Sawit menyediakan benih berkualitas, produk hasil riset di sisi hulu dan hilir,
        dan memberikan pelayanan serta jasa yang memuaskan untuk memenuhi kebutuhan rakyat dan stakeholder,
        serta mendukung keberlanjutan industri kelapa sawit Indonesia.
    </p>

    <div class="bottom-features-grid">
        <div class="feature-item small-feature">
            <img src="images/icon_produk.png" alt="Icon Produk" class="feature-icon-bottom">
            <h4>PRODUK</h4>
            <p>Produk yang ditawarkan ini merupakan hasil penelitian untuk menjawab permasalahan yang ada di tengah upaya kultur teknis pekebun. Produk juga sebagai buah karya berbasis sawit yang ditujukan menjadi barang bermanfaat untuk kebutuhan sehari-hari.</p>
        </div>

        <div class="feature-item small-feature">
            <img src="images/icon_pelayanan_jasa.png" alt="Icon Pelayanan & Jasa" class="feature-icon-bottom">
            <h4>PELAYANAN & JASA</h4>
            <p>Semangat memberikan layanan ini lahir dari pencarian jati diri untuk mengejawantahkan visi PPKS sebagai sumber referensi perkelapasawitan, juga tak lepas dari semangat mendampingi dengan sepenuh hati untuk produksi tinggi dan lestari.</p>
        </div>

        <div class="feature-item small-feature">
            <img src="images/icon_lab_pelayanan.png" alt="Icon Laboratorium Analisis" class="feature-icon-bottom">
            <h4>LABORATORIUM ANALISIS</h4>
            <p>Laboratorium ini menawarkan hasil pembacaan yang akurat dari suatu analisis oleh perangkat/instrumen terhadap suatu objek yang disampaikan pengguna. Laboratorium telah mendapatkan pengakuan kesesuaian terhadap standar yang berlaku.</p>
        </div>
    </div>
</div>
<section class="latest-news">
    <div class="container">
        <h2 class="section-title">
            <span class="black-text">LATEST</span> <span class="green-text">NEWS</span>
        </h2>
        <p class="section-subtitle">
            Ikuti berita kegiatan terkini di Pusat Penelitian Kelapa Sawit dan informasi terkait industri kelapa sawit.
        </p>

        <div class="news-grid">
            <!-- CARD 1 -->
            <div class="news-card">
                <img src="images/news1.png" alt="Berita 1">
                <div class="news-content">
                    <div class="news-date">25 Sep, 2025</div>
                    <h3 class="news-title">
                        Tingkatkan Keahlian Budidaya dan Pemetaan: PT RPN, BPDP dan Ditjenbun Latih Petani Sawit Labusel
                    </h3>
                    <p class="news-meta">👤 ADMIN IOPRI</p>
                    <p class="news-text">
                        <b>Medan, 5 Agustus 2025</b> – PT Riset Perkebunan Nusantara (RPN) melalui Pusat Penelitian Kelapa Sawit (PPKS),
                        bersama Badan Pengelola Dana P …
                    </p>
                    <a href="#" class="read-more">Read More »</a>
                </div>
            </div>

            <!-- CARD 2 -->
            <div class="news-card">
                <img src="images/news2.png" alt="Berita 2">
                <div class="news-content">
                    <div class="news-date">25 Sep, 2025</div>
                    <h3 class="news-title">
                        Kemitraan Strategis PT RPN & Technobiz Thailand Hadirkan Rubber Week: Solusi Inovatif untuk Masa Depan Industri Karet Dunia
                    </h3>
                    <p class="news-meta">👤 ADMIN IOPRI</p>
                    <p class="news-text">
                        <b>Bogor, 2 September 2025</b> – PT Riset Perkebunan Nusantara (RPN) berkolaborasi dengan TechnoBiz Thailand menyelenggarakan Rubber and Tire T …
                    </p>
                    <a href="#" class="read-more">Read More »</a>
                </div>
            </div>

            <!-- CARD 3 -->
            <div class="news-card">
                <img src="images/news3.png" alt="Berita 3">
                <div class="news-content">
                    <div class="news-date">25 Sep, 2025</div>
                    <h3 class="news-title">
                        PT RPN Dukung Rehabilitasi Ekosistem Pantai Kupang : Hijaukan Pesisir, Tanam 100 Pohon Bakau
                    </h3>
                    <p class="news-meta">👤 ADMIN IOPRI</p>
                    <p class="news-text">
                        <b>Kupang, 14 Agustus 2025</b> – PT Riset Perkebunan Nusantara sebagai sponsor utama, bersama Gamal Institute dan Carlo Institute, sukses menye …
                    </p>
                    <a href="#" class="read-more">Read More »</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="mitra-section">
    <div class="container-fluid">
        <h2 class="mitra-title">
            <span class="black-text">MITRA</span> <span class="green-text">KOLABORASI</span>
        </h2>

        <div class="mitra-grid">
            <img src="images/mitra1.png" alt="Mitra 1">
            <img src="images/mitra2.jpg" alt="Mitra 2">
            <img src="images/mitra3.png" alt="Mitra 3">
            <img src="images/mitra4.png" alt="Mitra 4">
            <img src="images/mitra5.png" alt="Mitra 5">

            <img src="images/mitra6.png" alt="Mitra 6">
            <img src="images/mitra7.png" alt="Mitra 7">
            <img src="images/mitra8.jpg" alt="Mitra 8">
            <img src="images/mitra9.png" alt="Mitra 9">
            <img src="images/mitra10.png" alt="Mitra 10">

            <img src="images/mitra11.svg" alt="Mitra 11">
            <img src="images/mitra12.jpg" alt="Mitra 12">
            <img src="images/mitra13.jpg" alt="Mitra 13">
            <img src="images/mitra14.png" alt="Mitra 14">
            <img src="images/mitra15.png" alt="Mitra 15">

            <img src="images/mitra16.png" alt="Mitra 16">
            <img src="images/mitra17.png" alt="Mitra 17">
            <img src="images/mitra18.png" alt="Mitra 18">
            <img src="images/mitra19.png" alt="Mitra 19">
            <img src="images/mitra20.png" alt="Mitra 20">

            <img src="images/mitra21.png" alt="Mitra 21">
            <img src="images/mitra22.png" alt="Mitra 22">
            <img src="images/mitra23.png" alt="Mitra 23">
            <img src="images/mitra24.png" alt="Mitra 24">
            <img src="images/mitra25.png" alt="Mitra 25">
            <img src="images/mitra26.png" alt="">
            <img src="images/mitra27.png" alt="">
            <img src="images/mitra28.png" alt="">
            <img src="images/mitra29.png" alt="">
            <img src="images/mitra30.png" alt="">
            <img src="images/mitra31.png" alt="">
            <img src="images/mitra32.png" alt="">
            <img src="images/mitra33.png" alt="">
            <img src="images/mitra34.png" alt="">
            <img src="images/mitra35.png" alt="">
            <img src="images/mitra36.png" alt="">

        </div>
    </div>
</section>



<?php include('includes/footer.php'); ?>