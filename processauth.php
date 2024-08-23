<?php
session_start();
require_once("db_con.php");



if(isset($_POST["signIn"])){

    echo("<h1>Sign In Form</h1>");
    echo("<pre>"); 
        print_r($_POST);
    echo("</pre>");

    
} else
echo('something went wrong');

if (isset($_POST['signUp'])) {
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL query
    $sql = "INSERT INTO users (firstName, lastName, email, password) VALUES ('$fName', '$lName', '$email', '$password')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
         
?>