<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'koneksi.php';

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Folder upload
    $upload_dir = 'uploads/';

    // Buat folder upload otomatis jika belum ada
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    // Ambil ekstensi file foto
    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

    // Buat nama file unik dan aman
    $foto_name = uniqid('foto_', true) . '.' . $ext;
    $foto_tmp = $_FILES['foto']['tmp_name'];
    $target_file = $upload_dir . $foto_name;

    if (move_uploaded_file($foto_tmp, $target_file)) {
        $stmt = $conn->prepare("INSERT INTO users (username, password, foto) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $foto_name);

        if ($stmt->execute()) {
            $success = "Registrasi berhasil! <a href='login.php'>Login di sini</a>";
        } else {
            $error = "Gagal menyimpan data ke database.";
        }
        $stmt->close();
    } else {
        $error = "Gagal mengupload foto.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - VocaVerse</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #007BFF 0%, #8E2DE2 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            overflow: hidden;
        }

        .register-container {
            background: linear-gradient(135deg, #007BFF, #8E2DE2);
            color: white;
            padding: 40px 30px 30px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 400px;
            text-align: center;
            opacity: 0;
            transform: translateY(100px);
            animation: slideUp 0.8s forwards ease-out;
            animation-delay: 0.4s;
        }

        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .register-container h2 {
            margin-bottom: 24px;
            font-size: 30px;
            font-weight: 700;
            letter-spacing: 1px;
            text-shadow: 0 0 8px rgba(255,255,255,0.6);
        }

        .register-container input[type="text"],
        .register-container input[type="password"],
        .register-container input[type="file"],
        .register-container button {
            width: 100%;
            padding: 14px;
            margin: 12px 0 18px;
            border-radius: 6px;
            font-size: 16px;
            box-sizing: border-box;
            display: block;
            transition: all 0.3s ease;
            border: none;
        }

        .register-container input[type="text"],
        .register-container input[type="password"],
        .register-container input[type="file"] {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.4);
        }

        .register-container input::placeholder {
            color: #ddd;
        }

        .register-container input[type="text"]:focus,
        .register-container input[type="password"]:focus,
        .register-container input[type="file"]:focus {
            outline: none;
            border-color: #fff;
            box-shadow: 0 0 6px #fff;
            background: rgba(255, 255, 255, 0.3);
        }

        .register-container button {
            background: #fff;
            color: #007BFF;
            font-weight: 700;
            cursor: pointer;
            border-radius: 6px;
            border: none;
            transition: background 0.3s ease;
        }

        .register-container button:hover {
            background: #e6e6e6;
        }

        .register-container a {
            color: #fff;
            text-decoration: none;
            font-weight: 700;
            display: block;
            margin-top: 12px;
            text-shadow: 0 0 4px rgba(0,0,0,0.3);
        }

        .register-container a:hover {
            text-decoration: underline;
        }

        .message {
            margin-bottom: 12px;
            font-weight: 600;
            text-shadow: 0 0 4px rgba(0,0,0,0.4);
        }

        .error-message {
            color: #ff6b6b;
        }

        .success-message {
            color: #d4ffb0;
        }

        label[for="foto"] {
            display: block;
            text-align: left;
            margin-bottom: 6px;
            font-weight: 600;
            color: #fff;
            text-shadow: 0 0 4px rgba(0,0,0,0.4);
        }

        @media screen and (max-width: 480px) {
            .register-container {
                padding: 30px 20px 20px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>VocaVerse Register</h2>
        <?php if (isset($error)): ?>
            <div class="message error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <div class="message success-message"><?php echo $success; ?></div>
        <?php endif; ?>
        <form method="POST" enctype="multipart/form-data" autocomplete="off">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            
            <label for="foto">Foto Profile:</label>
            <input type="file" name="foto" id="foto" accept="image/*" required>
            
            <button type="submit">Register</button>
        </form>
        <a href="login.php">Already have an account? Login</a>
    </div>
</body>
</html>
