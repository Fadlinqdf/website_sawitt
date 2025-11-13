<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'Website Sawit'; ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* === Navbar Styling === */
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fff;
            padding: 10px 40px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1000;
            flex-wrap: wrap;
        }

        .logo-container img {
            height: 40px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            margin: 0 10px;
            font-weight: 500;
        }

        .nav-links a.active {
            color: #198754;
            border-bottom: 2px solid #198754;
        }

        /* Dropdown Menu */
        .user-operation {
            position: relative;
        }

        .user-operation>a {
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .user-operation .dropdown-content {
            position: absolute;
            top: 30px;
            left: 0;
            background: #fff;
            padding: 8px 0;
            min-width: 180px;
            border-radius: 6px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            display: none;
            z-index: 2000;
        }

        .user-operation .dropdown-content a {
            display: block;
            padding: 8px 15px;
            color: #333;
            text-decoration: none;
            font-size: 14px;
        }

        .user-operation .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        /* Auth Buttons */
        .auth-buttons a {
            text-decoration: none;
            padding: 6px 14px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            transition: 0.2s;
            margin-left: 10px;
        }

        .btn-signin {
            color: #198754;
            border: 2px solid #198754;
            background: transparent;
        }

        .btn-signin:hover {
            background: #198754;
            color: white;
        }

        .btn-register {
            background: #0d6efd;
            color: white;
            border: 2px solid #0d6efd;
        }

        .btn-register:hover {
            background: #0b5ed7;
        }

        /* User Menu */
        .user-menu {
            position: relative;
            display: inline-block;
        }

        .user-name {
            background: #198754;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .user-name i {
            font-size: 14px;
        }

        .dropdown-content-user {
            display: none;
            position: absolute;
            top: 45px;
            right: 0;
            background-color: #fff;
            min-width: 180px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            z-index: 2000;
            padding: 10px;
        }

        .dropdown-content-user.active {
            display: block;
        }

        .dropdown-content-user p {
            font-size: 14px;
            color: #555;
            margin: 5px 0;
            word-break: break-all;
        }

        .dropdown-content-user a.btn-logout {
            display: block;
            text-align: center;
            background: #dc3545;
            color: white;
            text-decoration: none;
            padding: 6px 10px;
            border-radius: 5px;
            margin-top: 8px;
            font-size: 14px;
        }

        .dropdown-content-user a.btn-logout:hover {
            background: #b02a37;
        }

        /* SweetAlert Button */
        .swal2-confirm {
            background-color: #198754 !important;
            border: none !important;
            box-shadow: none !important;
        }

        .swal2-confirm:hover {
            background-color: #157347 !important;
        }

        /* Responsive */
        @media(max-width:768px) {
            .navbar {
                padding: 10px 20px;
            }

            .nav-links {
                flex-wrap: wrap;
                gap: 10px;
            }
        }
    </style>
</head>

<body>
    <header class="navbar">
        <div class="logo-container">
            <img src="images/bumn.jpg" alt="Logo BUMN" class="logo">
        </div>

        <nav class="nav-links">
            <a href="index.php" class="<?php echo ($current_page == 'home') ? 'active' : ''; ?>">Home</a>

            <?php if (isset($_SESSION['status']) && $_SESSION['status'] == 'login'): ?>
                <a href="pendaftaran.php" class="<?php echo ($current_page == 'pendaftaran') ? 'active' : ''; ?>">Pendaftaran</a>
            <?php endif; ?>

            <a href="about.php" class="<?php echo ($current_page == 'about') ? 'active' : ''; ?>">About</a>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <a href="dashboard_admin.php" class="<?php echo ($current_page == 'admin') ? 'active' : ''; ?>">Grafik</a>

                <!-- Dropdown Data -->
                <div class="user-operation">
                    <a href="#">Data <i class="fa fa-caret-down"></i></a>
                    <div class="dropdown-content">
                        <a href="data_user.php">User</a>
                        <a href="data_pendaftar.php">Pendaftar</a>
                    </div>
                </div>
            <?php endif; ?>
        </nav>

        <div class="auth-buttons">
            <?php if (!isset($_SESSION['status']) || $_SESSION['status'] != 'login'): ?>
                <a href="login.php" class="btn-signin">Sign In</a>
                <a href="register.php" class="btn-register">Register</a>
            <?php else: ?>
                <div class="user-menu" id="userMenu">
                    <span class="user-name" id="userToggle">
                        <i class="fa fa-user"></i>
                        <?= htmlspecialchars($_SESSION['user_nama']) ?>
                    </span>
                    <div class="dropdown-content-user" id="dropdownMenu">
                        <p><?= htmlspecialchars($_SESSION['user_email']) ?></p>
                        <a href="logout.php" class="btn-logout">Logout</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </header>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // User dropdown
            const userToggle = document.getElementById("userToggle");
            const dropdownMenu = document.getElementById("dropdownMenu");
            if (userToggle && dropdownMenu) {
                userToggle.addEventListener("click", function(e) {
                    e.stopPropagation();
                    dropdownMenu.classList.toggle("active");
                });
                document.addEventListener("click", function(e) {
                    if (!dropdownMenu.contains(e.target) && !userToggle.contains(e.target)) {
                        dropdownMenu.classList.remove("active");
                    }
                });
            }

            // Admin dropdown (Data)
            const dropdownMenus = document.querySelectorAll('.user-operation > a');
            dropdownMenus.forEach(menu => {
                const dropdown = menu.nextElementSibling;
                menu.addEventListener('click', function(e) {
                    e.preventDefault();
                    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
                });
                document.addEventListener('click', function(e) {
                    if (!menu.contains(e.target) && !dropdown.contains(e.target)) {
                        dropdown.style.display = 'none';
                    }
                });
            });
        });
    </script>
