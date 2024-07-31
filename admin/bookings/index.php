<?php
include('../../includes/db_connection.php');
include('../../includes/header_admin.php');

// Query untuk mengambil semua booking
$sql = "SELECT b.*, s.name as service_name FROM bookings b JOIN services s ON b.service_id = s.id";
$result = $conn->query($sql);
?>

<main class="container mt-5">
    <h1>Manage Bookings</h1>
    
    <div class="overflow-x-auto">
  <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
    <thead class="ltr:text-left rtl:text-right">
      <tr>
        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">ID</th>
        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Service</th>
        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Customer Name</th>
        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Customer Phone</th>
        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Customer Email</th>
        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Booking Date</th>
        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Status</th>
        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Booking Number</th>
        <th class="px-4 py-2"></th>
      </tr>
    </thead>

    <tbody class="divide-y divide-gray-200">
    <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"><?php echo $row['id']; ?></td>
        <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?php echo $row['service_name']; ?></td>
        <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?php echo $row['customer_name']; ?></td>
        <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?php echo $row['customer_phone']; ?></td>
        <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?php echo $row['customer_email']; ?></td>
        <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?php echo $row['booking_date']; ?></td>
        <td class="whitespace-nowrap px-4 py-2 text-gray-700"><?php echo $row['status']; ?></td>
        <td class="whitespace-nowrap px-4 py-2">
          <a
            href="update.php?id=<?php echo $row['id']; ?>"
            class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700"
          >
            Update
          </a>
          <a
            href="delete.php?id=<?php echo $row['id']; ?>"
            class="inline-block rounded bg-red-600 px-4 py-2 text-xs font-medium text-white hover:bg-red-700"
          >
            Delete
          </a>
        </td>

      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</main>

<?php include('../../includes/footer.php'); ?>
