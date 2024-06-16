<?php
include('./includes/db_connection.php');
include('./includes/header.php');

if (isset($_GET['service_id'])) {
    $service_id = $_GET['service_id'];
    $sql = "SELECT * FROM services WHERE id = '$service_id' AND is_published = 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $service = $result->fetch_assoc();
    } else {
        echo "Service not found or not available.";
        exit();
    }
} else {
    echo "Service ID not provided.";
    exit();
}
?>

<main class="container mt-5">
    <h1>Book Service: <?php echo $service['name']; ?></h1>
    <form action="process_booking.php" method="POST">
        <input type="hidden" name="service_id" value="<?php echo $service_id; ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Your Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Your Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Your Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="mb-3">
            <label for="booking_date" class="form-label">Booking Date</label>
            <input type="date" class="form-control" id="booking_date" name="booking_date" required>
        </div>
        <button type="submit" class="btn btn-primary">Book Now</button>
    </form>
</main>

<?php include('./includes/footer.php'); ?>
