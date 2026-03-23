<?php
session_start();

// ТВОЙ ПАРОЛЬ (поменяй его на что-то сложное)
$correct_password = 'YOUR_SECURE_PASSWORD_HERE';
// Note: Set this in your server environment.

// Обработка входа
if (isset($_POST['password'])) {
    if ($_POST['password'] === $correct_password) {
        $_SESSION['logged_in'] = true;
    } else {
        $error = "Неверный пароль!";
    }
}

// Обработка выхода
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin.php");
    exit();
}

// Проверка статуса авторизации
$is_logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leads Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #0f172a;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --accent: #3b82f6;
            --card-bg: #1e293b;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 50px 20px;
            margin: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            background: var(--card-bg);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.3);
        }
        h2 { margin-top: 0; text-align: center; }
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 15px 0;
            border-radius: 6px;
            border: 1px solid #334155;
            background: var(--bg-color);
            color: white;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            background-color: var(--accent);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
        }
        button:hover { background-color: #2563eb; }
        .error { color: #ef4444; text-align: center; margin-bottom: 10px; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #334155; }
        th { color: var(--text-muted); font-weight: 600; }
        .header-flex { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .logout { color: #ef4444; text-decoration: none; font-size: 0.9rem; }
    </style>
</head>
<body>

<div class="container">
    <?php if (!$is_logged_in): ?>
        <h2>Admin Access</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <input type="password" name="password" placeholder="Enter password" required>
            <button type="submit">Login</button>
        </form>
    <?php else: ?>
        <div class="header-flex">
            <h2 style="margin: 0;">Collected Leads</h2>
            <a href="?logout=1" class="logout">Logout</a>
        </div>
        
        <table>
            <tr>
                <th>Date / Time</th>
                <th>Email Address</th>
            </tr>
            <?php
            $file_path = "leads_secure_77x.csv";
            if (file_exists($file_path)) {
                $file = fopen($file_path, "r");
                while (($data = fgetcsv($file)) !== FALSE) {
                    echo "<tr><td>" . htmlspecialchars($data[0]) . "</td><td>" . htmlspecialchars($data[1]) . "</td></tr>";
                }
                fclose($file);
            } else {
                echo "<tr><td colspan='2' style='text-align: center; color: var(--text-muted);'>No leads yet.</td></tr>";
            }
            ?>
        </table>
    <?php endif; ?>
</div>

</body>
</html>