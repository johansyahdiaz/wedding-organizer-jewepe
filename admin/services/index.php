<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit();
}
include('../../includes/db_connection.php');
include('../../includes/header_admin.php');

// Mengambil data layanan dari database
$sql = "SELECT * FROM services";
$result = $conn->query($sql);
?>

<main>
    <h1>Manage Services</h1>
    <?php
    if(isset($_SESSION['success'])){
        echo "<div class='alert alert-success'>".$_SESSION['success']."</div>";
        unset($_SESSION['success']);
    }
    if(isset($_SESSION['error'])){
        echo "<div class='alert alert-danger'>".$_SESSION['error']."</div>";
        unset($_SESSION['error']);
    }
    ?>

    <a href="create.php" class="btn btn-success mb-3">Add New Service</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Service Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Published</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['description']}</td>
                        <td>{$row['price']}</td>
                        <td>" . ($row['is_published'] ? 'Yes' : 'No') . "</td>
                        <td><img src='../../uploads/service_images/{$row['image_url']}' alt='{$row['name']}' width='100'></td>
                        <td>
                            <a href='edit.php?id={$row['id']}' class='btn btn-warning'>Edit</a>
                            <a href='delete.php?id={$row['id']}' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this service?\")'>Delete</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='7' class='text-center'>No services found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</main>

<?php include('../../includes/footer.php'); ?>
