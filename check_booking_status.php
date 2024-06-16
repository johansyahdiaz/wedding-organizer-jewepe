<?php
include('includes/db_connection.php');
include('includes/header.php');

if (isset($_GET['booking_id']) && isset($_GET['phone'])) {
    $booking_id = $_GET['booking_id'];
    $phone = $_GET['phone'];

    $sql = "SELECT b.*, s.name AS service_name 
            FROM bookings b 
            JOIN services s ON b.service_id = s.id 
            WHERE b.booking_number = '$booking_id' AND b.customer_phone = '$phone'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $booking = $result->fetch_assoc();

        // Determine the badge class based on status
        $badge_class = 'badge-warning'; // Default to 'menunggu'
        if ($booking['status'] == 'ditolak') {
            $badge_class = 'badge-danger';
        } elseif ($booking['status'] == 'diterima') {
            $badge_class = 'badge-success';
        }
        ?>
        <main class="container mt-5">
            <div class="card shadow">
                <div class="card-header text-center">
                    <h2>Booking Status</h2>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Service Name: <strong><?php echo $booking['service_name']; ?></strong></h5>
                    <p class="card-text">Your Name: <strong><?php echo $booking['customer_name']; ?></strong></p>
                    <p class="card-text">Status: 
                        <span class="badge text-black-50 <?php echo $badge_class; ?>">
                            <?php echo ucfirst($booking['status']); ?>
                        </span>
                    </p>
                    <?php if ($booking['status'] == 'ditolak' && !empty($booking['admin_message'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>Message from Admin:</strong> <?php echo $booking['admin_message']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-footer text-muted text-center">
                    <a href="index.php" class="btn btn-primary">Back to Home</a>
                </div>
            </div>
        </main>
        <?php
    } else {
        ?>
        <main class="container mt-5">
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Error!</h4>
                <p>Booking not found or phone number incorrect.</p>
            </div>
            <div class="text-center">
                <a href="index.php" class="btn btn-primary">Back to Home</a>
            </div>
        </main>
        <?php
    }
} else {
    ?>
    <main class="container mt-5">
        <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">Warning!</h4>
            <p>Booking ID and phone number required.</p>
        </div>
        <div class="text-center">
            <a href="index.php" class="btn btn-primary">Back to Home</a>
        </div>
    </main>
    <?php
}

include('includes/footer.php');
?>
