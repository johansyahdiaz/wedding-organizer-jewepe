<?php
include('./includes/db_connection.php');

function generateBookingNumber($conn) {
    $number = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
    $sql = "SELECT * FROM bookings WHERE booking_number = '$number'";
    $result = $conn->query($sql);
    
    // Jika nomor booking sudah ada, coba lagi
    if ($result->num_rows > 0) {
        return generateBookingNumber($conn);
    }
    
    return $number;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_id = $_POST['service_id'];
    $customer_name = $_POST['name'];
    $customer_email = $_POST['email'];
    $customer_phone = $_POST['phone'];
    $booking_date = $_POST['booking_date'];
    $booking_number = generateBookingNumber($conn);

    $sql = "INSERT INTO bookings (service_id, customer_name, customer_phone, customer_email, booking_date, status, booking_number) 
            VALUES ('$service_id', '$customer_name', '$customer_phone', '$customer_email', '$booking_date', 'menunggu', '$booking_number')";
    
    if ($conn->query($sql) === TRUE) {
        // Redirect to the confirmation page
        header('Location: booking_confirmation.php?booking_number=' . $booking_number);
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
