<?php
session_start();

if ( isset($_SESSION['user_id'])) {
    // Logout the user
    unset($_SESSION['user_id']);
    header("Location: index.php"); // Redirect to the user login or main page
    exit();



}
?>
