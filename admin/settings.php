<?php
include('../includes/db_connection.php');
include('../includes/header_admin.php');

// Fetch existing settings
$sql = "SELECT * FROM website_settings WHERE id = 1";
$result = $conn->query($sql);
$settings = $result->fetch_assoc();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $about_us = $_POST['about_us'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $facebook_url = $_POST['facebook_url'];
    $instagram_url = $_POST['instagram_url'];
    $twitter_url = $_POST['twitter_url'];

    if ($settings) {
        // Update existing settings
        $sql = "UPDATE website_settings SET
                    about_us = '$about_us',
                    address = '$address',
                    email = '$email',
                    phone = '$phone',
                    facebook_url = '$facebook_url',
                    instagram_url = '$instagram_url',
                    twitter_url = '$twitter_url'
                WHERE id = 1";
    } else {
        // Insert new settings
        $sql = "INSERT INTO website_settings (about_us, address, email, phone, facebook_url, instagram_url, twitter_url)
                VALUES ('$about_us', '$address', '$email', '$phone', '$facebook_url', '$instagram_url', '$twitter_url')";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Settings updated successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error updating settings: " . $conn->error . "</div>";
    }
}
?>

<main class="container mt-5">
    <h1>Website Settings</h1>
    <form method="POST">
        <div class="form-group">
            <label for="about_us">About Us</label>
            <textarea class="form-control" id="about_us" name="about_us" rows="5"><?php echo $settings['about_us']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo $settings['address']; ?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $settings['email']; ?>">
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $settings['phone']; ?>">
        </div>
        <div class="form-group">
            <label for="facebook_url">Facebook URL</label>
            <input type="url" class="form-control" id="facebook_url" name="facebook_url" value="<?php echo $settings['facebook_url']; ?>">
        </div>
        <div class="form-group">
            <label for="instagram_url">Instagram URL</label>
            <input type="url" class="form-control" id="instagram_url" name="instagram_url" value="<?php echo $settings['instagram_url']; ?>">
        </div>
        <div class="form-group">
            <label for="twitter_url">Twitter URL</label>
            <input type="url" class="form-control" id="twitter_url" name="twitter_url" value="<?php echo $settings['twitter_url']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Save Settings</button>
    </form>
</main>

<?php include('../includes/footer.php'); ?>
