<?php
include('../../includes/db_connection.php');
include('../../includes/header_admin.php');

// Query untuk mengambil semua booking
$sql = "SELECT b.*, s.name as service_name FROM bookings b JOIN services s ON b.service_id = s.id";
$result = $conn->query($sql);
?>

<main class="container mt-5">
    <h1>Manage Bookings</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Service</th>
                <th>Customer Name</th>
                <th>Customer Phone</th>
                <th>Customer Email</th>
                <th>Booking Date</th>
                <th>Status</th>
                <th>Booking Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['service_name']; ?></td>
                    <td><?php echo $row['customer_name']; ?></td>
                    <td><?php echo $row['customer_phone']; ?></td>
                    <td><?php echo $row['customer_email']; ?></td>
                    <td><?php echo $row['booking_date']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['booking_number']; ?></td>
                    <td>
                        <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Update</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<?php include('../../includes/footer.php'); ?>
