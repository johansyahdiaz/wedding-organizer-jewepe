<?php
include('./includes/header.php');

if (isset($_GET['booking_number'])) {
    $booking_number = $_GET['booking_number'];
} else {
    // Jika tidak ada nomor booking, kembali ke halaman utama
    header('Location: index.php');
    exit();
}
?>

<main class="container mt-5">
    <div class="card">
        <div class="card-body text-center">
            <h1 class="card-title">Booking Successful!</h1>
            <p class="card-text">Your booking number is:</p>
            <h2 id="bookingNumber"><?php echo $booking_number; ?></h2>
            <button class="btn btn-primary" onclick="copyToClipboard()">Copy Booking Number</button>
        </div>
    </div>
</main>

<script>
function copyToClipboard() {
    var copyText = document.getElementById("bookingNumber").innerText;
    navigator.clipboard.writeText(copyText).then(function() {
        alert("Booking number copied to clipboard");
    }, function() {
        alert("Failed to copy booking number");
    });
}
</script>

<?php include('./includes/footer.php'); ?>
