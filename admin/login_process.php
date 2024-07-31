<?php
session_start();
include('../includes/db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Bersihkan dan validasi input
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Siapkan dan eksekusi query untuk mengambil password hash dari database
    $sql = $conn->prepare("SELECT password FROM admins WHERE username=?");
    $sql->bind_param("s", $username);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        // Verifikasi password
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION['error'] = "Invalid username or password.";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Invalid username or password.";
        header("Location: login.php");
        exit();
    }
}
?>
