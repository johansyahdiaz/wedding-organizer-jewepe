<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit();
}
include('../../includes/db_connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM services WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "Service deleted successfully.";
    } else {
        $_SESSION['error'] = "Error: " . $sql . "<br>" . $conn->error;
    }
}
header("Location: index.php");
?>
