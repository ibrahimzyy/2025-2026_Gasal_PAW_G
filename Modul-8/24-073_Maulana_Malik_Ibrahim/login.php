<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Modern</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Poppins", sans-serif;
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: white;
            width: 350px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
            animation: fade 0.6s ease-in-out;
        }

        @keyframes fade {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 15px;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            background: #4e73df;
            color: white;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover {
            background: #3759c0;
        }

        .alert {
            margin-top: 10px;
            padding: 10px;
            background: #ffdddd;
            border-left: 5px solid red;
            color: #333;
            font-size: 14px;
            border-radius: 4px;
        }
    </style>
</head>

<body>
<div class="login-container">
    <h2>Login User</h2>

    <form action="cek_login.php" method="POST">
        <label>Username</label>
        <input type="text" name="username" placeholder="Masukkan username..." required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Masukkan password..." required>

        <button type="submit">Login</button>
    </form>

    
</div>
</body>
</html>
