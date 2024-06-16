<?php
include('./includes/db_connection.php');
include('./includes/header.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM services WHERE id = '$id' AND is_published = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $service = $result->fetch_assoc();
?>

<main class="container mt-5">
    <div class="card">
        <img src="./uploads/service_images/<?php echo $service['image_url']; ?>" class="card-img-top" alt="<?php echo $service['name']; ?>">
        <div class="card-body">
            <h5 class="card-title"><?php echo $service['name']; ?></h5>
            <p class="card-text"><?php echo $service['description']; ?></p>
            <p class="card-text">Price: <?php echo $service['price']; ?></p>
            <a href="booking.php?service_id=<?php echo $service['id']; ?>" class="btn btn-primary">Book Now</a>
        </div>
    </div>
</main>

<?php
    } else {
        echo "<main class='container mt-5'><p>Service not found or not available.</p></main>";
    }
} else {
    echo "<main class='container mt-5'><p>Service ID not provided.</p></main>";
}

include('./includes/footer.php');
?>
