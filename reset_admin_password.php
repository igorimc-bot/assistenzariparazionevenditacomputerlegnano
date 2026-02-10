<?php
// Production Admin Password Reset Script
// INSTRUCTIONS:
// 1. Upload this file to the root of your website (e.g., public_html/reset_admin_password.php).
// 2. Open it in your browser (e.g., https://yourdomain.com/reset_admin_password.php).
// 3. COPY the new password displayed.
// 4. Log in immediately.
// 5. DELETE THIS FILE FROM THE SERVER.

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'includes/db_connect.php';

echo "<h1>Admin Password Reset Tool</h1>";

try {
    // 1. Check Connection
    if ($pdo) {
        echo "<p style='color:green'>Database connection successful.</p>";
    } else {
        throw new PDOException("Database connection object is null.");
    }

    // 2. Check if Users Table Exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'users'");
    if ($stmt->rowCount() == 0) {
        // Create table if it doesn't exist (safety fallback)
        $pdo->exec("CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
        echo "<p style='color:orange'>'users' table was missing and has been created.</p>";
    } else {
        echo "<p style='color:green'>'users' table exists.</p>";
    }

    // 3. Reset or Create Admin User
    $username = 'admin';
    // Generate a somewhat random password
    $new_password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()'), 0, 12);
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user) {
        // Update existing user
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->execute([$hashed_password, $user['id']]);
        echo "<p style='color:blue'>Password for existing user '<strong>$username</strong>' has been reset.</p>";
    } else {
        // Create new user
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $hashed_password]);
        echo "<p style='color:blue'>User '<strong>$username</strong>' did not exist and has been created.</p>";
    }

    echo "<div style='border:2px solid red; padding:20px; margin:20px 0; background:#fff0f0'>";
    echo "<h3>NEW CREDENTIALS:</h3>";
    echo "<p><strong>Username:</strong> $username</p>";
    echo "<p><strong>Password:</strong> <span style='font-size:1.2em; background:#eee; padding:5px;'>$new_password</span></p>";
    echo "</div>";

    echo "<p><a href='/admin/login.php' target='_blank'>Go to Admin Login</a></p>";

    echo "<hr>";
    echo "<p style='color:red; font-weight:bold'>WARNING: PLEASE DELETE THIS FILE (reset_admin_password.php) FROM YOUR SERVER IMMEDIATELY AFTER USE!</p>";

} catch (PDOException $e) {
    echo "<p style='color:red'>Database Error: " . htmlspecialchars($e->getMessage()) . "</p>";
} catch (Exception $e) {
    echo "<p style='color:red'>General Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>