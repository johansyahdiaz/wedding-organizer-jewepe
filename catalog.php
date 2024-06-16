<?php
include('includes/db_connection.php');
include('includes/header.php');

$sql = "SELECT * FROM services WHERE is_published = 1";
$result = $conn->query($sql);
?>

<main class="container mt-5">
    <h1>Our Services</h1>
    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='col-md-4 mb-4'>
                        <div class='card'>
                            <img src='uploads/service_images/{$row['image_url']}' class='card-img-top' alt='{$row['name']}'>
                            <div class='card-body'>
                                <h5 class='card-title'>{$row['name']}</h5>
                                <p class='card-text'>{$row['description']}</p>
                                <p class='card-text'>Price: {$row['price']}</p>
                                <a href='catalog_detail.php?id={$row['id']}' class='btn btn-primary'>Details</a>
                            </div>
                        </div>
                      </div>";
            }
        } else {
            echo "<p>No services available.</p>";
        }
        ?>
    </div>
</main>

<?php include('includes/footer.php'); ?>
