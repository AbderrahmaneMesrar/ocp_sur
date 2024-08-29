<?php
session_start(); // Ensure session is started

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "compact_survey_system";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get survey ID from the URL
$survey_id = $_GET['survey_id'];

// Sanitize the survey ID
$survey_id = intval($survey_id); // Convert to integer to prevent SQL injection

// Prepare and execute SQL query
$stmt = $conn->prepare("SELECT id, question_text, question_type FROM questions WHERE survey_id = ?");
$stmt->bind_param("i", $survey_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<form action="submit_survey.php" method="POST">';
    echo '<input type="hidden" name="survey_id" value="' . $survey_id . '">';
    
    while ($question = $result->fetch_assoc()) {
        echo '<div>';
        echo '<label>' . $question['question_text'] . '</label><br>';
        
        if ($question['question_type'] == 'text') {
            echo '<input type="text" name="answers[' . $question['id'] . ']" required><br><br>';
        } elseif ($question['question_type'] == 'radio') {
            // Fetch radio options
            $options_sql = "SELECT option_text FROM question_options WHERE question_id = " . $question['id'];
            $options_result = $conn->query($options_sql);
            
            while ($option = $options_result->fetch_assoc()) {
                echo '<input type="radio" name="answers[' . $question['id'] . ']" value="' . $option['option_text'] . '" required> ' . $option['option_text'] . '<br>';
            }
            echo '<br>';
        } elseif ($question['question_type'] == 'multiple') {
            // Fetch multiple-choice options
            $options_sql = "SELECT option_text FROM question_options WHERE question_id = " . $question['id'];
            $options_result = $conn->query($options_sql);
            
            while ($option = $options_result->fetch_assoc()) {
                echo '<input type="checkbox" name="answers[' . $question['id'] . '][]" value="' . $option['option_text'] . '"> ' . $option['option_text'] . '<br>';
            }
            echo '<br>';
        }
        
        echo '</div>';
    }
    
    echo '<input type="submit" value="Submit Survey">';
    echo '</form>';
} else {
    echo '<p>No questions found for this survey.</p>';
}

$stmt->close();
$conn->close();
?>
