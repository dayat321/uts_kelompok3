<?php
session_start();

// Data login beserta role
$users = [
    'admin' => ['password' => '12345', 'role' => 'admin'],
    'user'  => ['password' => 'abcde', 'role' => 'user']
];

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek kredensial dan role
    if (isset($users[$username]) && $users[$username]['password'] === $password) {
        $_SESSION['user'] = $username;
        $_SESSION['role'] = $users[$username]['role'];

        // Arahkan ke dashboard sesuai role
        if ($_SESSION['role'] === 'admin') {
            header("Location: dashboard_admin.php");
        } else {
            header("Location: dashboard_user.php");
        }
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 25rem;">
        <h4 class="text-center mb-4">Login</h4>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>
</body>
</html>
