<?php
// Database connection
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "compact_survey_system";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$survey_title = $_POST['survey_title'];
$survey_description = $_POST['survey_description'];
$questions = $_POST['questions'];

// Insert survey into the surveys table
$sql = "INSERT INTO surveys (survey_title, description) VALUES ('$survey_title', '$survey_description')";

if ($conn->query($sql) === TRUE) {
    $survey_id = $conn->insert_id;

    // Insert questions into the questions table
    foreach ($questions as $question) {
        $question_text = $conn->real_escape_string($question['text']);
        $question_type = $conn->real_escape_string($question['type']);

        $sql = "INSERT INTO questions (survey_id, question_text, question_type) VALUES ($survey_id, '$question_text', '$question_type')";
        
        if ($conn->query($sql) === TRUE) {
            $question_id = $conn->insert_id;

            // Insert options for multiple-choice and radio questions
            if ($question_type === "radio" || $question_type === "multiple") {
                foreach ($question['options'] as $option) {
                    $option_text = $conn->real_escape_string($option);
                    $sql = "INSERT INTO question_options (question_id, option_text) VALUES ($question_id, '$option_text')";
                    $conn->query($sql);
                }
            }
        }
    }

    echo "Survey created successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
