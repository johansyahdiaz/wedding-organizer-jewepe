<?php
include('../../includes/db_connection.php');
include('../../includes/header.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM bookings WHERE id = '$id'";
    $result = $conn->query($sql);
    $booking = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $admin_message = $_POST['admin_message'];

    $sql = "UPDATE bookings SET status = '$status', admin_message = '$admin_message' WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        header('Location: index.php');
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<main class="container mt-5">
    <h1>Update Booking</h1>
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $booking['id']; ?>">
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="menunggu" <?php if ($booking['status'] == 'menunggu') echo 'selected'; ?>>Menunggu</option>
                <option value="diterima" <?php if ($booking['status'] == 'diterima') echo 'selected'; ?>>Diterima</option>
                <option value="ditolak" <?php if ($booking['status'] == 'ditolak') echo 'selected'; ?>>Ditolak</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="admin_message" class="form-label">Admin Message</label>
            <textarea class="form-control" id="admin_message" name="admin_message"><?php echo $booking['admin_message']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Booking</button>
    </form>
</main>

<?php include('../../includes/footer.php'); ?>
