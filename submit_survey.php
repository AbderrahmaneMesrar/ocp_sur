<?php
session_start(); 

require_once("db_con.php");


if (!isset($_SESSION['user_id'])) {
    die("User not logged in. Please log in first.");
}

$user_id = $_SESSION['user_id']; 
$survey_id = $_POST['survey_id'];
$answers = $_POST['answers'];


$stmt = $conn->prepare("INSERT INTO responses (survey_id, user_id, question_id, response) VALUES (?, ?, ?, ?)");

foreach ($answers as $question_id => $response) {
    // Check if the response is an array (for multiple-choice questions)
    if (is_array($response)) {
        foreach ($response as $option) {
            $stmt->bind_param("iiis", $survey_id, $user_id, $question_id, $option);
            $stmt->execute();
        }
    } else {
        // For text and radio responses
        $stmt->bind_param("iiis", $survey_id, $user_id, $question_id, $response);
        $stmt->execute();
    }
}

$stmt->close();
$conn->close();

header('Location: USERmainpage.php');
exit();
?>
