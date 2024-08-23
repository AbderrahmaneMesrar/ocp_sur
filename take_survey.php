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

// Ensure user_id is set
if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

$user_id = $_SESSION['user_id']; // User ID from session
$survey_id = $_GET['survey_id'];

// Fetch survey questions
$sql = "SELECT id, question_text, question_type FROM questions WHERE survey_id = $survey_id";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Survey</title>
    <style>
        .question { margin-bottom: 20px; }
        .question label { display: block; margin-bottom: 5px; }
        .question input, .question select { width: 100%; }
    </style>
</head>
<body>
    <h1>Survey</h1>
    <form action="submit_survey.php" method="POST">
        <input type="hidden" name="survey_id" value="<?php echo htmlspecialchars($survey_id); ?>">

        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="question">
                <label><?php echo htmlspecialchars($row['question_text']); ?></label>

                <?php if ($row['question_type'] == 'text'): ?>
                    <input type="text" name="answers[<?php echo htmlspecialchars($row['id']); ?>]" required>
                <?php else: ?>
                    <p>This question type (<?php echo htmlspecialchars($row['question_type']); ?>) requires options, which are not defined.</p>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>

        <button type="submit">Submit</button>
    </form>

    <?php
    $conn->close();
    ?>
</body>
</html>
