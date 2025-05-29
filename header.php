<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            margin: 0;
            padding-top: 60px; /* ruang untuk header fixed */
            font-family: Arial, sans-serif;
        }

        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #007BFF;
            color: white;
            padding: 10px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 1000;
        }

        .header .title {
            font-size: 24px;
            font-weight: bold;
        }

        .akun {
            position: relative;
            display: flex;
            align-items: center;
            cursor: pointer;
            margin-right: 55px; /* geser ke kiri dari sisi kanan layar */
        }

        .akun span {
            font-weight: bold;
            color: white;
        }

        .akun img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
            margin-left: 10px;
        }

        .dropdown {
            display: none;
            position: absolute;
            top: 50px;
            right: 0;
            background-color: white;
            color: #007BFF;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            border-radius: 5px;
            overflow: hidden;
            z-index: 1001;
            min-width: 120px;
        }

        .dropdown a {
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }

        .dropdown a:hover {
            background-color: #f0f0f0;
        }

        .login-btn {
            background: white;
            color: #007BFF;
            padding: 8px 14px;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
        }

        .login-btn:hover {
            background: #e0e0e0;
        }

        @media screen and (max-width: 480px) {
            .header {
                padding: 10px 15px;
            }
            .akun span {
                display: none;
            }
        }
    </style>
    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById("akunDropdown");
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
        }

        window.addEventListener("click", function(e) {
            const akun = document.getElementById("akunContainer");
            const dropdown = document.getElementById("akunDropdown");
            if (!akun.contains(e.target)) {
                dropdown.style.display = "none";
            }
        });
    </script>
</head>
<body>

<div class="header">
    <div class="title">VocaVerse</div>

    <div class="akun" id="akunContainer" onclick="toggleDropdown()">
        <?php if (isset($_SESSION['username'])): ?>
            <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <img src="uploads/<?php echo htmlspecialchars($_SESSION['foto']); ?>" alt="Foto Profil">
            <div class="dropdown" id="akunDropdown">
                <a href="logout.php">Logout</a>
            </div>
        <?php else: ?>
            <a href="login.php" class="login-btn">Login</a>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
