<?php
include('includes/db_connection.php');
include('includes/header.php');

// Fetch website settings
$sql = "SELECT * FROM website_settings WHERE id = 1";
$result = $conn->query($sql);
$settings = $result->fetch_assoc();
?>
<main class="h-screen flex-grow">
    <div class="h-20 bg-gray-200 flex items-center justify-center">
        <div class="p-4">
            <h1 class="text-center font-black text-3xl"> About Us</h1>
        </div>
    </div>
    <div class="bg-gray-100">
        <p class="text-xl text-justify p-6">
            <?php echo nl2br($settings['about_us']); ?>
        </p>
    </div>
    <div class="bg-white py-5">
        <div class="container">
            <h2 class="text-center font-black text-2xl mb-4">Contact Us</h2>
            <div class="row">
                <div class="col-md-4 text-center mb-4">
                    <h5>Address</h5>
                    <p><?php echo $settings['address']; ?></p>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <h5>Email & Phone</h5>
                    <p>Email: <?php echo $settings['email']; ?><br>Phone: <?php echo $settings['phone']; ?></p>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <h5>Follow Us</h5>
                    <a href="<?php echo $settings['facebook_url']; ?>" target="_blank" class="d-block mb-2">Facebook</a>
                    <a href="<?php echo $settings['instagram_url']; ?>" target="_blank" class="d-block mb-2">Instagram</a>
                    <a href="<?php echo $settings['twitter_url']; ?>" target="_blank" class="d-block">Twitter</a>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include('./includes/footer.php'); ?>
