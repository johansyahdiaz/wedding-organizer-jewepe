<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit();
}
ob_start();
include('../../includes/db_connection.php');
include('../../includes/header.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $published = isset($_POST['published']) ? 1 : 0;
    
    $image = $_FILES['image']['name'];
    $target = "../../uploads/service_images/" . basename($image);

    $sql = "INSERT INTO services (name, description, price, is_published, image_url) VALUES ('$name', '$description', '$price', '$published', '$image')";
    if ($conn->query($sql) === TRUE) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $_SESSION['success'] = "New service added successfully.";
        } else {
            $_SESSION['error'] = "Failed to upload image.";
        }
        header("Location: index.php");
    } else {
        $_SESSION['error'] = "Error: " . $sql . "<br>" . $conn->error;
    }
}
ob_end_flush();
?>

<main>
    <h1>Add New Service</h1>
    <?php
    if(isset($_SESSION['error'])){
        echo "<div class='alert alert-danger'>".$_SESSION['error']."</div>";
        unset($_SESSION['error']);
    }
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Service Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="published" name="published">
            <label class="form-check-label" for="published">Published</label>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Service Image</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Service</button>
    </form>
</main>

<?php include('../../includes/footer.php'); ?>
