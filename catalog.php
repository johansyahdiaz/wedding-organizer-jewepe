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
                echo '
<a href="catalog_detail.php?id=' . $row['id'] . '" class=" my-8 relative block rounded-tr-3xl border border-gray-100">
  <span
    class="absolute -right-px -top-px rounded-bl-3xl rounded-tr-3xl bg-rose-600 px-6 py-4 font-medium uppercase tracking-widest text-white"
  >
    Rp. ' . $row['price'] . '
  </span>

  <img
    src="uploads/service_images/' . $row['image_url'] . '"
    alt="' . $row['name'] . '"
    class="h-80 w-full rounded-tr-3xl object-cover"
  />

  <div class="p-4 text-center">
    <strong class="text-xl font-medium text-gray-900"> ' . $row['name'] . ' </strong>

    <p class="mt-2 text-pretty text-gray-700">
    ' . $row['description'] . '
    </p>

    <span
      class="mt-4 block rounded-md border border-indigo-900 bg-indigo-900 px-5 py-3 text-sm font-medium uppercase tracking-widest text-white transition-colors hover:bg-white hover:text-indigo-900"
    >
      Learn More
    </span>
  </div>
</a>
                      ';
            }
        } else {
            echo "<p>No services available.</p>";
        }
        ?>
    </div>
</main>

<?php include('includes/footer.php'); ?>
