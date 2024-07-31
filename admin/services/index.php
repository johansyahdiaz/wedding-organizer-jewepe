<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit();
}
include('../../includes/db_connection.php');
include('../../includes/header_admin.php');

// Fungsi untuk memotong deskripsi setelah sejumlah kalimat tertentu
function truncateSentences($text, $limit) {
    $sentences = preg_split('/(\.|!|\?)\s/', $text, -1, PREG_SPLIT_DELIM_CAPTURE);
    $output = '';
    $sentenceCount = 0;
    foreach ($sentences as $sentence) {
        $output .= $sentence;
        if (++$sentenceCount == $limit) break;
    }
    return $output . (count($sentences) > $limit * 2 ? '...' : '');
}

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
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
            <thead class="ltr:text-left rtl:text-right">
                <tr>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">ID</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Service Name</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Description</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Price</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Image</th>
                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Published</th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $truncatedDescription = truncateSentences($row['description'], 2); // Batasi hingga 2 kalimat
                        echo "<tr>
                            <td class='whitespace-nowrap px-4 py-2 font-medium text-gray-900'>{$row['id']}</td>
                            <td class='whitespace-nowrap px-4 py-2 text-gray-700'>{$row['name']}</td>
                            <td class='whitespace-nowrap px-4 py-2 text-gray-700'>{$truncatedDescription}</td>
                            <td class='whitespace-nowrap px-4 py-2 text-gray-700'>{$row['price']}</td>
                            <td class='whitespace-nowrap px-4 py-2 text-gray-700'><img src='../../uploads/service_images/{$row['image_url']}' alt='{$row['name']}' width='100'></td>
                            <td class='whitespace-nowrap px-4 py-2 text-gray-700'>" . ($row['is_published'] ? 'Yes' : 'No') . "</td>
                            <td class='whitespace-nowrap px-4 py-2'>
                                <a href='edit.php?id={$row['id']}' class='inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700'>
                                    Edit
                                </a>
                                <a href='delete.php?id={$row['id']}' class='inline-block rounded bg-red-600 px-4 py-2 text-xs font-medium text-white hover:bg-red-700' onclick='return confirm(\"Are you sure you want to delete this service?\")'>
                                    Delete
                                </a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>No services found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</main>

<?php include('../../includes/footer.php'); ?>
