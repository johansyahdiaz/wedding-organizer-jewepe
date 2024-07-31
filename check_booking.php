<?php
include('./includes/db_connection.php');
include('./includes/header.php');
?>

<main class="container mt-5 h-screen">
    <h1>Check Booking Status</h1>
    <form action="check_booking_status.php" method="GET">
        <div class="mb-3">
            <label for="booking_id" class="form-label">Booking ID</label>
            <input type="text" class="form-control" id="booking_id" name="booking_id" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Your Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <button type="submit" class="btn btn-primary">Check Status</button>
    </form>
</main>

<?php include('includes/footer.php'); ?>
