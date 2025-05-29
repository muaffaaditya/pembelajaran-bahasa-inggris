<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password_input = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password_input, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['foto'] = $user['foto'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - VocaVerse</title>
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

        .login-container {
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

        .login-container h2 {
            margin-bottom: 24px;
            font-size: 30px;
            font-weight: 700;
            letter-spacing: 1px;
            user-select: none;
        }

        .login-container input[type="text"],
        .login-container input[type="password"],
        .login-container button {
            width: 100%;
            padding: 14px;
            margin: 12px 0 18px;
            border-radius: 6px;
            font-size: 16px;
            box-sizing: border-box;
            display: block;
            transition: all 0.3s ease;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            border: 2px solid rgba(255,255,255,0.8);
            background: rgba(255,255,255,0.15);
            color: white;
        }

        .login-container input[type="text"]::placeholder,
        .login-container input[type="password"]::placeholder {
            color: rgba(255,255,255,0.7);
        }

        .login-container input[type="text"]:focus,
        .login-container input[type="password"]:focus {
            border-color: #FFC107;
            box-shadow: 0 0 8px #FFC107aa;
            background: rgba(255,255,255,0.25);
            outline: none;
        }

        .login-container button {
            background: #FFC107;
            color: #333;
            font-weight: 700;
            border: none;
            cursor: pointer;
            border-radius: 6px;
            transition: background 0.3s ease;
        }

        .login-container button:hover {
            background: #e6ac00;
        }

        .login-container a {
            color: #FFD54F;
            text-decoration: none;
            font-weight: 700;
            display: block;
            margin-top: 12px;
            user-select: none;
        }

        .login-container a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #ff6b6b;
            margin-bottom: 12px;
            font-weight: 600;
        }

        .copyright {
            margin-top: 16px;
            font-size: 14px;
            color: #e0e0e0;
            font-weight: 500;
            user-select: none;
        }

        @media screen and (max-width: 480px) {
            .login-container {
                padding: 30px 20px 20px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>VocaVerse</h2>
        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" autocomplete="off">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <a href="register.php">Don't have an account yet? Register here</a>
        <div class="copyright">
            &copy; <?php echo date("Y"); ?> VocaVerse. All rights reserved.
        </div>
    </div>
</body>
</html>
