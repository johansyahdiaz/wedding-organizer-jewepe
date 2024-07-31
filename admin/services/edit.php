<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit();
}
ob_start();
include('../../includes/db_connection.php');
include('../../includes/header.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM services WHERE id='$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $service = $result->fetch_assoc();
    } else {
        $_SESSION['error'] = "Service not found.";
        header("Location: index.php");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $published = isset($_POST['published']) ? 1 : 0;

    $image = $_FILES['image']['name'];
    $target = "../../uploads/service_images/" . basename($image);

    if (!empty($image)) {
        $sql = "UPDATE services SET name='$name', description='$description', price='$price', is_published='$published', image_url='$image' WHERE id='$id'";
    } else {
        $sql = "UPDATE services SET name='$name', description='$description', price='$price', is_published='$published' WHERE id='$id'";
    }

    if ($conn->query($sql) === TRUE) {
        if (!empty($image) && move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $_SESSION['success'] = "Service updated successfully.";
        } else if (empty($image)) {
            $_SESSION['success'] = "Service updated successfully.";
        } else {
            $_SESSION['error'] = "Failed to upload image.";
        }
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['error'] = "Error: " . $sql . "<br>" . $conn->error;
    }
}
ob_end_flush();
?>

<main>
    <h1>Edit Service</h1>
    <?php
    if(isset($_SESSION['error'])){
        echo "<div class='alert alert-danger'>".$_SESSION['error']."</div>";
        unset($_SESSION['error']);
    }
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $service['id']; ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Service Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $service['name']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required><?php echo $service['description']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="<?php echo $service['price']; ?>" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="published" name="published" <?php echo $service['is_published'] ? 'checked' : ''; ?>>
            <label class="form-check-label" for="published">Published</label>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Service Image</label>
            <input type="file" class="form-control" id="image" name="image">
            <img src="../../uploads/service_images/<?php echo $service['image_url']; ?>" alt="<?php echo $service['name']; ?>" width="100" class="mt-2">
        </div>
        <button type="submit" class="btn btn-primary">Update Service</button>
    </form>
</main>

<?php include('../../includes/footer.php'); ?>
