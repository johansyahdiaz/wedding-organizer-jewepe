<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
include('../includes/header_admin.php');
?>

<main>
    <h1>Welcome to Admin Dashboard</h1>
    <p>Hello, <?php echo $_SESSION['admin_username']; ?>. You are logged in as admin.</p>
</main>

<?php include('../includes/footer.php'); ?>
