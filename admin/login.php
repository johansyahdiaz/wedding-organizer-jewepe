<?php
session_start();
include('../includes/db_connection.php');
include('../includes/header.php');
?>

<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mt-5">Admin Login</h2>
            <?php
            if(isset($_SESSION['error'])){
                echo "<div class='alert alert-danger'>".$_SESSION['error']."</div>";
                unset($_SESSION['error']);
            }
            ?>
            <form action="login_process.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

<?php 
include('../includes/footer.php');
?>