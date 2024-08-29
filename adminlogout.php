<?php
session_start();



if ( isset($_SESSION['admin_id'])) {
    // Logout the admin
    unset($_SESSION['admin_id']);
    header("Location: admin register.php"); // Redirect to the admin login or main page
    exit();
}
?>
