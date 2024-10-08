<?php
require_once("db_con.php");

// Get form data
$admin_id = $_POST['admin_id']; 
$survey_title = $_POST['survey_title'];
$survey_description = $_POST['survey_description'];
$questions = $_POST['questions'];

// Insert survey 
$sql = "INSERT INTO surveys (admin_id, survey_title, description) VALUES ('$admin_id', '$survey_title', '$survey_description')";

if ($conn->query($sql) === TRUE) {
    $survey_id = $conn->insert_id;

    // Insert questions 
    foreach ($questions as $question) {
        $question_text = $conn->real_escape_string($question['text']);
        $question_type = $conn->real_escape_string($question['type']);

        $sql = "INSERT INTO questions (survey_id, question_text, question_type) VALUES ($survey_id, '$question_text', '$question_type')";
        
        if ($conn->query($sql) === TRUE) {
            $question_id = $conn->insert_id;

            // Insert options 
            if ($question_type === "radio" || $question_type === "multiple") {
                foreach ($question['options'] as $option) {
                    $option_text = $conn->real_escape_string($option);
                    $sql = "INSERT INTO question_options (question_id, option_text) VALUES ($question_id, '$option_text')";
                    $conn->query($sql);
                }
            }
        }
    }
    header("Location: adminmainpage.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
